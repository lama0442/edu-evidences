<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إنجاز | البوابة الرئيسية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a; /* لون غامق عميق */
            overflow: hidden;
            position: relative;
        }

        /* دوائر متحركة في الخلفية لإعطاء عمق */
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            animation: move 20s infinite alternate;
        }
        .circle-1 { width: 400px; height: 400px; background: rgba(79, 70, 229, 0.3); top: -10%; left: -10%; }
        .circle-2 { width: 300px; height: 300px; background: rgba(192, 38, 211, 0.2); bottom: -5%; right: -5%; animation-delay: -5s; }

        @keyframes move {
            from { transform: translate(0, 0); }
            to { transform: translate(100px, 100px); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            z-index: 10;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .logo-box {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 45px;
            color: white;
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
            transform: rotate(-10deg);
        }

        .btn-entry {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-entry:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .btn-teacher {
            background: white;
            color: #1e293b;
        }

        .btn-admin {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-admin:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="login-card">
        <div class="logo-box">
            <i class="fas fa-rocket"></i>
        </div>

        <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">إنجاز الذكي</h1>
        <p class="text-slate-400 mb-12 text-sm uppercase tracking-widest">Digital Portfolio System</p>

        <div class="space-y-5">
            <a href="/teacher" class="btn-entry btn-teacher flex items-center justify-between p-5 rounded-2xl font-bold group">
                <span class="flex items-center gap-4 text-lg">
                    <i class="fas fa-chalkboard-teacher text-indigo-600"></i>
                    دخول المعلمين
                </span>
                <i class="fas fa-arrow-left opacity-0 group-hover:opacity-100 transition-all"></i>
            </a>

            <a href="/admin" class="btn-entry btn-admin flex items-center justify-between p-5 rounded-2xl font-bold group">
                <span class="flex items-center gap-4 text-lg">
                    <i class="fas fa-user-shield text-purple-400"></i>
                    بوابة الإدارة
                </span>
                <i class="fas fa-arrow-left opacity-0 group-hover:opacity-100 transition-all"></i>
            </a>
        </div>

        <div class="mt-12 pt-8 border-t border-white/5 flex justify-center gap-6">
            <div class="text-white/30 text-xs">سريع ⚡</div>
            <div class="text-white/30 text-xs">آمن 🔒</div>
            <div class="text-white/30 text-xs">سحابي ☁️</div>
        </div>
    </div>

</body>
</html>