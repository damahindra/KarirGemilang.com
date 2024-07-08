<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'http://127.0.0.1:8000/user/signup',
        'http://127.0.0.1:8000/user/login',
        'http://127.0.0.1:8000/employer/signup',
        'http://127.0.0.1:8000/employer/login',
        'http://127.0.0.1:8000/job/1/application'
    ];
}
