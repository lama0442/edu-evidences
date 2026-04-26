<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | منصة إنجاز</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; background: #0f172a; }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-height-screen p-4 py-12">

    <div class="bg-white w-full max-w-md p-8 md:p-12 rounded-[3rem] shadow-2xl">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-800 mb-2">إنشاء حساب مدير</h1>
            <p class="text-slate-500 font-medium">قم بتعبئة البيانات للانضمام للمنصة</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-5">
                <label class="block text-slate-700 font-bold mb-2 mr-2">الاسم الكامل</label>
                <input type="text" name="name" required autofocus
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-sm">
            </div>

            <div class="mb-5">
                <label class="block text-slate-700 font-bold mb-2 mr-2">البريد الإلكتروني</label>
                <input type="email" name="email" required
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-sm text-left">
            </div>

            <div class="mb-5">
                <label class="block text-slate-700 font-bold mb-2 mr-2">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-sm text-left">
            </div>

            <div class="mb-8">
                <label class="block text-slate-700 font-bold mb-2 mr-2">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-sm text-left">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-4 rounded-2xl font-black text-lg hover:bg-indigo-700 transition-all shadow-lg hover:scale-[1.02] active:scale-95">
                تسجيل الحساب
            </button>

            <div class="text-center mt-8">
                <p class="text-slate-500">لديك حساب بالفعل؟ 
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">سجل دخولك هنا</a>
                </p>
            </div>
        </form>
    </div>

</body>
</html>