<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الإنجاز | {{ $teacher->teacher_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #0f172a; margin: 0; }
        .glass-header { background: rgba(30, 27, 75, 0.7); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .content-card { background: white; border-radius: 2.5rem; color: #1e293b; overflow: hidden; shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .evidence-item { transition: all 0.3s ease; border: 1px solid #f1f5f9; }
        .evidence-item:hover { transform: scale(1.02); border-color: #6366f1; }
    </style>
</head>
<body class="antialiased pb-20">

    {{-- المنطق البرمجي لحساب النسبة --}}
    @php
        $evidences = is_string($teacher->evidences_data) ? json_decode($teacher->evidences_data, true) : $teacher->evidences_data;
        $files = is_string($teacher->file_paths) ? json_decode($teacher->file_paths, true) : $teacher->file_paths;
        $uploadedCount = is_array($evidences) ? count($evidences) : 0;
        $targetCount = 12; // المعيار المطلوب
        $percent = ($uploadedCount > 0) ? round(($uploadedCount / $targetCount) * 100) : 0;
        if($percent > 100) $percent = 100;
    @endphp

    <header class="glass-header py-10 px-6 mb-12 text-right">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ url('/admin-panel') }}" class="bg-white/10 hover:bg-white/20 text-white p-4 rounded-2xl transition-all">
                    <i class="fas fa-arrow-right"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">{{ $teacher->teacher_name }}</h1>
                    <p class="text-indigo-300 font-bold">{{ $teacher->school }} | {{ $teacher->subject }}</p>
                </div>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-indigo-500/20 border border-indigo-400/30 px-6 py-3 rounded-2xl text-center">
                    <span class="text-[10px] block text-indigo-200 font-bold mb-1">نسبة الإكمال</span>
                    <span class="text-2xl font-black text-white leading-none">{{ $percent }}%</span>
                </div>
                <div class="bg-emerald-500/20 border border-emerald-400/30 px-6 py-3 rounded-2xl text-center">
                    <span class="text-[10px] block text-emerald-200 font-bold mb-1">الشواهد</span>
                    <span class="text-2xl font-black text-white leading-none">{{ $uploadedCount }}</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="content-card p-8">
                    <h3 class="text-lg font-black text-indigo-950 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-500"></i> بيانات الملف
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-400 font-bold">تاريخ البدء</span>
                            <span class="font-black text-slate-700">{{ $teacher->created_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-400 font-bold">الرتبة</span>
                            <span class="font-black text-slate-700">{{ $teacher->rank ?? 'معلم ممارس' }}</span>
                        </div>
                    </div>

                    <h3 class="text-lg font-black text-indigo-950 mt-10 mb-4 flex items-center gap-2">
                        <i class="fas fa-magic text-indigo-500"></i> الاستراتيجيات المنفذة
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($teacher->strategies ?? [] as $strat)
                            <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg font-black text-xs border border-indigo-100">
                                {{ $strat }}
                            </span>
                        @empty
                            <p class="text-slate-400 text-sm">لا توجد استراتيجيات محددة</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="content-card p-8">
                    <h3 class="text-2xl font-black text-indigo-950 mb-8 flex items-center gap-3 border-b pb-4">
                        <i class="fas fa-tasks text-indigo-600"></i> سجل الشواهد والوثائق
                    </h3>

                    <div class="space-y-4">
                        @forelse($evidences ?? [] as $index => $evidence)
                            <div class="evidence-item p-6 rounded-3xl bg-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-6">
                                    <div class="w-12 h-12 bg-indigo-950 text-white rounded-2xl flex items-center justify-center font-black shadow-lg">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h4 class="font-black text-indigo-900 text-lg">{{ $evidence['title'] ?? 'بدون عنوان' }}</h4>
                                        <p class="text-slate-500 text-sm font-bold">{{ $evidence['note'] ?? 'لا يوجد ملاحظات' }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    @if(!empty($evidence['link']))
                                        <a href="{{ $evidence['link'] }}" target="_blank" class="bg-white border border-slate-200 text-indigo-600 p-3 rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-link"></i>
                                        </a>
                                    @endif
                                    
                                    @if(isset($files[$index]))
                                        <a href="{{ asset('storage/' . $files[$index]) }}" target="_blank" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-black text-xs flex items-center gap-2 hover:bg-indigo-800 transition-all shadow-md">
                                            <i class="fas fa-download"></i> معاينة الملف
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20 opacity-30">
                                <i class="fas fa-folder-open text-6xl mb-4"></i>
                                <p class="text-xl font-black italic italic">لم يتم رفع أي شواهد بعد</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>