<?php

namespace App\Exceptions;
namespace App\Http\Controllers;

use App\Exceptions\PasteExpiredException;
use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PasteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'file'    => 'nullable|file|max:102400',
            'expiry'  => 'nullable|string',
        ]);

        $filePath = null;
        $originalName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filePath = $file->store('uploads', 'public');
        }

        $paste = Paste::create([
            'unique_id'         => $this->generateUniqueSlug(),
            'title'             => $validated['title'] ?? 'Untitled Paste',
            'content'           => $validated['content'] ?? null,
            'file_path'         => $filePath,
            'original_filename' => $originalName,
            'expires_at'        => $this->calculateExpiry($request->input('expiry')),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'url'     => route('paste.show', $paste->unique_id),
            ]);
        }

        return redirect()->route('paste.show', $paste->unique_id);
    }

    public function show($unique_id)
    {
        $paste = Paste::where('unique_id', $unique_id)->firstOrFail();

        $this->ensureNotExpired($paste);

        return view('paste.show', compact('paste'));
    }

    public function download($unique_id)
    {
        $paste = Paste::where('unique_id', $unique_id)->firstOrFail();

        $this->ensureNotExpired($paste);

        if (!$paste->file_path || !Storage::disk('public')->exists($paste->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($paste->file_path, $paste->original_filename);
    }

    /**
     * Check paste expiration state and throw custom exception if expired.
     *
     * @throws PasteExpiredException
     */
    private function ensureNotExpired(Paste $paste): void
    {
        if ($paste->expires_at && $paste->expires_at->isPast()) {
            if ($paste->file_path && Storage::disk('public')->exists($paste->file_path)) {
                Storage::disk('public')->delete($paste->file_path);
            }
            $paste->delete();

            throw new PasteExpiredException();
        }
    }

    private function generateUniqueSlug(): string
    {
        do {
            $slug = Str::random(6);
        } while (Paste::where('unique_id', $slug)->exists());

        return $slug;
    }

    private function calculateExpiry(?string $expiry)
    {
        if (empty($expiry) || $expiry === 'never') {
            return null;
        }

        return match ($expiry) {
            '10m'   => now()->addMinutes(10),
            '1h'    => now()->addHour(),
            '1d'    => now()->addDay(),
            '1w'    => now()->addWeek(),
            default => is_numeric($expiry) && $expiry > 0 ? now()->addMinutes((int) $expiry) : null,
        };
    }
}
