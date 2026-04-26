<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| 1. المسارات العامة (متاحة للجميع)
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية للاختيار بين معلم ومدير
Route::get('/', function () {
    return view('welcome'); 
});

// صفحة دخول المعلم
Route::get('/teacher', function () { 
    return view('teacher'); 
})->name('teacher.form');

// حفظ بيانات المعلم
Route::post('/save-teacher', [TeacherController::class, 'store'])->name('teacher.store');

/*
|--------------------------------------------------------------------------
| 2. نظام حماية المدير (تسجيل الدخول والخروج)
|--------------------------------------------------------------------------
*/

// صفحة القفل (إدخال كلمة المرور)
Route::get('/admin/login', function () {
    return view('auth.login'); 
})->name('admin.login');

// التحقق من كلمة المرور
Route::post('/admin-verify', function (Request $request) {
    // التحقق من كلمة المرور (عدلي 1234 للكلمة التي تريدينها)
    if ($request->secret_code === 'xcv2390' || $request->password === env('ADMIN_PASSWORD')) { 
        session(['admin_authenticated' => true]); 
        return redirect('/admin-panel');
    }
    return back()->withErrors(['msg' => 'الرمز السري خطأ!']);
})->name('admin.verify');

// تسجيل الخروج وتدمير الجلسة
Route::get('/admin/logout', function() {
    session()->forget('admin_authenticated');
    session()->flush();
    return redirect()->route('admin.login');
});

/*
|--------------------------------------------------------------------------
| 3. منطقة المدير المحمية (الفولاذية)
|--------------------------------------------------------------------------
| هنا نستخدم Middleware للتأكد أن الشخص لن يرى أي شيء إلا بكلمة مرور
*/

Route::middleware([\App\Http\Middleware\AdminAuth::class])->group(function () {

    // لوحة تحكم المدير الرئيسية
    Route::get('/admin-panel', [TeacherController::class, 'managerDashboard'])->name('dashboard');

    // تفاصيل المعلم
    Route::get('/manager/teacher/{id}', [TeacherController::class, 'showTeacherDetails']);

    // تحويل تلقائي من /admin إلى /admin-panel
    Route::get('/admin', function() {
        return redirect('/admin-panel');
    });
});


// استبدلي السطر القديم بهذا:
