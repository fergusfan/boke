<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    //将post请求的路由放到此处，避免post请求时加上中间件
    protected $except = [
        'admin/checkPass',
        'admin/upload',
        'admin/article/upload',
        'check'
    ];
}
