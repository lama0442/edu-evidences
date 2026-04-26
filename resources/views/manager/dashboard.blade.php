<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إنجاز | لوحة المدير الذكية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Tajawal', sans-serif; 
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            min-height: 100vh;
        }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .neo-card { background: white; border-radius: 2.5rem; box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
        .gradient-text { background: linear-gradient(90deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body class="antialiased text-slate-200 p-4 md:p-8">

    <div class="max-w-7xl mx-auto">
        <header class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="text-right">
                <h1 class="text-4xl md:text-5xl font-black mb-2 flex items-center gap-4">
                    <span class="bg-indigo-600 p-3 rounded-2xl animate-float">
                        <i class="fas fa-shield-halved text-white text-2xl"></i>
                    </span>
                    <span class="gradient-text">لوحة التحكم الإدارية</span>
                </h1>
                <p class="text-slate-400 font-medium mr-16">نظام متابعة الشواهد والمنجزات المهنية 2026</p>
            </div>

            <div class="flex gap-4">
                <div class="glass p-6 rounded-[2rem] text-center min-w-[160px]">
                    <span class="text-indigo-300 text-xs font-bold block mb-2 uppercase tracking-tighter">إجمالي الشواهد</span>
                    <span class="text-4xl font-black text-white leading-none">{{ $teachers->count() }}</span>
                </div>
            </div>
        </header>

        <div class="neo-card overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-slate-800">سجل الإنجازات المرفوعة</h2>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-sm uppercase border-b border-slate-100">
                            <th class="p-8 font-black text-indigo-900">المعلم والمعلومات</th>
                            <th class="p-8 font-black text-indigo-900">المقر/المادة</th>
                            <th class="p-8 font-black text-indigo-900 text-center">المؤشر</th>
                            <th class="p-8 font-black text-indigo-900 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($teachers as $teacher)
                        <tr class="hover:bg-indigo-50/40 transition-all duration-300 group">
                            <td class="p-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xl">
                                        {{ mb_substr($teacher->teacher_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-xl font-black text-slate-800">{{ $teacher->teacher_name }}</div>
                                        <div class="text-xs text-indigo-500 font-bold italic">{{ $teacher->rank }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-8">
                                <div class="flex flex-col">
                                    <span class="text-slate-700 font-black text-lg">{{ $teacher->subject }}</span>
                                    <span class="text-sm text-slate-400 font-bold italic">{{ $teacher->school }}</span>
                                </div>
                            </td>
                            <td class="p-8 text-center">
                                <span class="bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-bold">
                                    مؤشر {{ $teacher->indicator_index }}
                                </span>
                            </td>
                            <td class="p-8 text-center">
                                @if($teacher->file_path)
                                <a href="{{ asset('storage/' . $teacher->file_path) }}" target="_blank" 
                                   class="inline-flex items-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-sm transition-all shadow-xl">
                                    <i class="fas fa-download"></i> عرض الشاهد
                                </a>
                                @else
                                <span class="text-slate-400 italic">لا يوجد ملف</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-32 text-center">
                                <p class="text-2xl font-black text-slate-400">لا توجد بيانات مرفوعة حتى الآن</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>