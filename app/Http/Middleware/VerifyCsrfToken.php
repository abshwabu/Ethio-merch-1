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
        '/admin/update-category-status',
        '/admin/update-section-status',
        '/admin/update-product-status',
        '/admin/update-template-status',
        '/admin/update-attribute-status',
        '/admin/update-image-status',
        '/admin/update-product-is_featured',
        '/admin/append-categories-level',
        '/admin/append-product-categories',
        '/creator/update-category-status',
        '/creator/update-section-status',
        '/creator/update-product-status',
        '/creator/update-template-status',
        '/creator/update-attribute-status',
        '/creator/update-image-status',
        '/creator/update-product-is_featured',
        '/creator/append-categories-level',
        '/creator/append-product-categories',
    ];
}
