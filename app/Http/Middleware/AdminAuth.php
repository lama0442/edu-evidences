<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // 1. التحقق من وجود الجلسة
        if (!session()->has('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $response = $next($request);

        // 2. منع المتصفح من حفظ الصفحة (أمان إضافي عند الضغط على زر الرجوع)
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}