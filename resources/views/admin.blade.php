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
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neo-card {
            background: white;
            border-radius: 2.5rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .gradient-text {
            background: linear-gradient(90deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
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
                    <span class="text-indigo-300 text-xs font-bold block mb-2 uppercase tracking-tighter">إجمالي الكادر</span>
                    <span class="text-4xl font-black text-white leading-none">{{ $teachers->count() }}</span>
                    <span class="text-[10px] block mt-2 text-slate-500 font-bold">معلم ومعلمة</span>
                </div>
            </div>
        </header>

        <div class="neo-card overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-slate-800">سجل المعلمين</h2>
                </div>
                <div class="relative w-full md:w-72">
                    <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="بحث سريع..." class="w-full pr-12 pl-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition outline-none text-slate-600 font-bold">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-sm uppercase tracking-widest border-b border-slate-100">
                            <th class="p-8 font-black text-indigo-900">المعلومات الأساسية</th>
                            <th class="p-8 font-black text-indigo-900">المقر العملي</th>
                            <th class="p-8 font-black text-indigo-900 text-center">التقدم</th>
                            <th class="p-8 font-black text-indigo-900 text-center">الملف المهني</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($teachers as $teacher)
                        <tr class="hover:bg-indigo-50/40 transition-all duration-300 group">
                            <td class="p-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xl group-hover:scale-110 transition">
                                        {{ mb_substr($teacher->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-xl font-black text-slate-800">{{ $teacher->name }}</div>
                                        <div class="text-xs text-indigo-500 font-bold mt-1 tracking-wide uppercase italic">عضو مسجل</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-8">
                                <div class="flex flex-col">
                                    <span class="text-slate-700 font-black flex items-center gap-2 text-lg">
                                        <i class="fas fa-book-bookmark text-indigo-400 text-sm"></i>
                                        {{ $teacher->subject }}
                                    </span>
                                    <span class="text-sm text-slate-400 font-bold mt-1">
                                        <i class="fas fa-location-dot ml-1"></i>
                                        {{ $teacher->school }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-8">
                                <div class="w-32 mx-auto">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-[10px] font-bold text-slate-400">الإنجاز</span>
                                        <span class="text-[10px] font-bold text-indigo-600">جاري..</span>
                                    </div>
                                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-indigo-500 rounded-full w-2/3 shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                                    </div>
                                </div>
                            </td>
                          <td class="p-8 text-center">
    <div class="flex items-center justify-center gap-3">
        
        {{-- زر عرض الملف المرفوع (PDF/صور/مستندات) --}}
        @if($teacher->file_path)
            <a href="{{ asset('storage/' . $teacher->file_path) }}" target="_blank" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white w-11 h-11 flex items-center justify-center rounded-2xl transition-all shadow-lg hover:scale-110 group/tooltip relative" 
               title="عرض المستند">
                <i class="fas fa-file-lines text-lg"></i>
            </a>
        @endif

        {{-- زر فتح الرابط الخارجي --}}
        @if($teacher->link)
            <a href="{{ $teacher->link }}" target="_blank" 
               class="bg-emerald-500 hover:bg-emerald-600 text-white w-11 h-11 flex items-center justify-center rounded-2xl transition-all shadow-lg hover:scale-110" 
               title="فتح الرابط المرفق">
                <i class="fas fa-link text-lg"></i>
            </a>
        @endif

        {{-- معاينة سريعة إذا كان المرفق صورة --}}
        @php 
            $extension = pathinfo($teacher->file_path, PATHINFO_EXTENSION);
            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
        @endphp
        
        @if($teacher->file_path && $isImage)
            <a href="{{ asset('storage/' . $teacher->file_path) }}" target="_blank" 
               class="w-11 h-11 rounded-2xl overflow-hidden border-2 border-slate-100 hover:border-indigo-500 transition-all shadow-md">
                <img src="{{ asset('storage/' . $teacher->file_path) }}" class="w-full h-full object-cover">
            </a>
        @endif

        {{-- في حال لم يرفع المعلم أي شيء --}}
        @if(!$teacher->file_path && !$teacher->link)
            <span class="text-slate-400 text-xs font-bold italic bg-slate-50 px-4 py-2 rounded-xl">
                <i class="fas fa-minus-circle ml-1"></i> لا توجد مرفقات
            </span>
        @endif

    </div>
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-32 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <i class="fas fa-folder-open text-8xl mb-6 text-slate-400"></i>
                                    <p class="text-3xl font-black text-slate-900">القاعدة خالية تماماً</p>
                                    <p class="text-slate-500 font-bold mt-2 text-lg italic">بانتظار تسجيل البيانات الأولى</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="bg-slate-50 p-6 text-center border-t border-slate-100">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.3em]">Smart Achievement System v2.0</p>
            </div>
        </div>
    </div>

</body>
</html>
