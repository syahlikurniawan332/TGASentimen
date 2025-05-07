<?php

namespace App\Http;

class Kernel
{
    protected $middlewareGroups = [
        'web' => [
            // ... middleware lainnya
            \App\Http\Middleware\HandleThemePreference::class,
        ],
    ];
}
?>