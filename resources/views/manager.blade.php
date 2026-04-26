<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المدير | إنجاز 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #0f172a; margin: 0; }
        .glass-header { background: rgba(30, 27, 75, 0.7); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .content-card { background: white; border-radius: 2.5rem; color: #1e293b; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
    </style>
</head>
<body class="antialiased pb-20">

    @include('layouts.navigation')

    <header class="glass-header py-10 px-6 mb-12 text-right">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-6">
                <a href="{{ url('/admin/logout') }}" class="bg-red-500/10 border border-red-500/30 text-red-400 px-5 py-2 rounded-2xl text-sm font-bold transition-all flex items-center gap-2">
                    <i class="fas fa-power-off"></i> خروج آمن
                </a>
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tight">لوحة المدير 🏛️</h1>
                    <p class="text-indigo-300 mt-2 font-bold text-lg">متابعة إنجازات المعلمين</p>
                </div>
            </div>
            
            <div class="bg-indigo-500/20 border border-indigo-400/30 px-8 py-4 rounded-3xl text-center">
                <span class="text-xs block text-indigo-200 font-bold mb-1 uppercase tracking-widest">إجمالي المعلمين</span>
                <span class="text-4xl font-black text-white leading-none">{{ $teachers->count() }}</span>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6">
        <div class="content-card">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="p-6 text-indigo-950 font-black">المعلم</th>
                        <th class="p-6 text-indigo-950 font-black text-center">المؤشرات المنجزة</th>
                        <th class="p-6 text-indigo-950 font-black text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($teachers as $teacher)
                        @php
                            // فك التشفير
                            $evidences = is_string($teacher->evidences_data) ? json_decode($teacher->evidences_data, true) : $teacher->evidences_data;
                            
                            // حساب المؤشرات الفريدة المنجزة فقط
                            $completedList = [];
                            if (is_array($evidences)) {
                                foreach ($evidences as $item) {
                                    $type = $item['indicator_type'] ?? $item['title'] ?? null;
                                    // نعتبره منجزاً فقط إذا كان هناك محتوى (ملف أو رابط أو ملاحظة)
                                    if ($type && (!empty($item['file']) || !empty($item['link']) || !empty($item['note']))) {
                                        $completedList[$type] = true;
                                    }
                                }
                            }
                            $doneCount = count($completedList);
                        @endphp
                    <tr class="hover:bg-indigo-50/50 transition-all">
                        <td class="p-6">
                            <div class="font-black text-xl text-indigo-900">{{ $teacher->teacher_name }}</div>
                            <div class="text-[10px] text-slate-400 mt-1 font-bold">{{ $teacher->subject }} | {{ $teacher->school }}</div>
                        </td>
                        
                        <td class="p-6 text-center">
                            <div class="inline-flex flex-col items-center">
                                <div class="bg-indigo-50 text-indigo-600 px-6 py-2 rounded-2xl border border-indigo-100 shadow-sm">
                                    <span class="text-2xl font-black">{{ $doneCount }}</span>
                                    <span class="text-xs font-bold mr-1">مؤشرات منجزة</span>
                                </div>
                                @if($doneCount > 0)
                                    <span class="text-[9px] text-emerald-500 font-bold mt-2 animate-pulse">
                                        <i class="fas fa-check-circle"></i> تم تحديث الإنجاز
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td class="p-6 text-center">
                            <a href="{{ url('/manager/teacher/'.$teacher->id) }}" 
                               class="bg-indigo-950 hover:bg-indigo-800 text-white px-6 py-3 rounded-2xl font-black text-xs transition-all flex items-center justify-center gap-2 max-w-[150px] mx-auto">
                                <i class="fas fa-eye"></i> عرض الملف
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-20 text-center text-slate-300 font-bold">لا يوجد بيانات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>