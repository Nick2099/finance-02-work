<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class, // Ensure this is present
            \App\Http\Middleware\SetLocale::class, // Add this line after StartSession
        ],
    ];

    // Add this to debug
    public function __construct()
    {
        Log::info('Kernel: Middleware registered');
        parent::__construct();
    }
}
