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
        // Exclude CSRF for user-related endpoints
        'user/*',
        
        // Exclude CSRF for employer-related endpoints
        'employer/*',
        
        // Exclude CSRF for specific job-related endpoints
        'job/*/application',
        'job/*'
    ];
}
