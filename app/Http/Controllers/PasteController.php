<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PasteController extends Controller
{
    public function index()
    {
        return view('paste.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
            'expiry' => 'nullable|integer', 
        ]);

        do {
            $uniqueId = Str::random(6);
        } while (Paste::where('unique_id', $uniqueId)->exists());

        $filePath = null;
        $originalName = null;


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            $filePath = $file->store('uploads'); 
        }

        $expiresAt = null;
        if ($request->filled('expiry') && $request->expiry > 0) {
            $expiresAt = now()->addMinutes($request->expiry);
        }

        $paste = Paste::create([
            'unique_id' => $uniqueId,
            'title' => $request->title ?? 'Untitled Paste',
            'content' => $request->content,
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'expires_at' => $expiresAt,
        ]);

        return redirect()->route('paste.show', $paste->unique_id);
    }

    public function show($unique_id)
    {
        $paste = Paste::where('unique_id', $unique_id)->firstOrFail();

        if ($paste->expires_at && $paste->expires_at->isPast()) {
            if ($paste->file_path) {
                Storage::delete($paste->file_path);
            }
            $paste->delete();
            abort(404, 'This paste has expired.');
        }

        return view('paste.show', compact('paste'));
    }

    public function download($unique_id)
    {
        $paste = Paste::where('unique_id', $unique_id)->firstOrFail();

        if ($paste->expires_at && $paste->expires_at->isPast()) {
            abort(404);
        }

        if (!$paste->file_path || !Storage::exists($paste->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::download($paste->file_path, $paste->original_filename);
    }
}