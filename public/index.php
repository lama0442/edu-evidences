<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// التحقق من وضع الصيانة
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// 1. تسجيل المحمل التلقائي (تم تصحيح المسار إلى vendor)
require __DIR__.'/../vendor/autoload.php';

// 2. تشغيل الـ Bootstrap ومعالجة الطلب
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());