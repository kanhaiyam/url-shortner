<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            header('HTTP/1.0 401 Unauthorized');
            header('Content-type: application/json');
            echo json_encode(["status"=>false, 'message' => 'authentication required']); exit(0);
        }
    }
}
