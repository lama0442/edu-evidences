<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إنجاز | لوحة التحكم</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Tajawal', sans-serif; 
            background: #0f172a; /* لون غامق فخم خلفية أساسية */
            margin: 0;
            padding: 0;
        }
        
        /* تأثيرات الزجاج الفخمة التي استخدمناها في تصميمك */
        .glass-nav {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* لضمان ظهور الخطوط العربية بشكل سليم في كل مكان */
        * { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="antialiased">

    @if(session('is_admin'))
        @include('layouts.navigation')
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="py-6 text-center text-slate-500 text-xs">
        &copy; 2026 منصة إنجاز - جميع الحقوق محفوظة
    </footer>

</body>
</html>