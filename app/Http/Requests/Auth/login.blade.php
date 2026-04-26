<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول | منصة إنجاز</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-900 flex items-center justify-center h-screen" style="font-family: 'Tajawal', sans-serif;">
    <div class="bg-white p-10 rounded-[2.5rem] shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-slate-800">مرحباً بكِ مجدداً</h2>
            <p class="text-slate-500 mt-2">سجلي دخولك للمتابعة</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-slate-700 font-bold mb-2 mr-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="lamam0442@gmail.com" required
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition text-left">
            </div>

            <div class="mb-6">
                <label class="block text-slate-700 font-bold mb-2 mr-2">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full p-4 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 transition text-left">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-4 rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg hover:scale-[1.02]">
                دخول النظام
            </button>
        </form>
    </div>
</body>
</html>