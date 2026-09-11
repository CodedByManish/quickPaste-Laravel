<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasteExpiredException extends Exception
{
    protected $message = 'This paste has expired or is no longer available.';

    /**
     * @throws HttpResponseException
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function render(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'error'   => $this->getMessage(),
            ], 410);
        }

        abort(404, $this->getMessage());
    }
}
