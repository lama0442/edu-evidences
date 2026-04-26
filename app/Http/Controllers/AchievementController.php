<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة المدير | منصة إنجاز</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Tajawal', sans-serif; background-color: #f8fafc; }</style>
</head>
<body>
    <header class="bg-indigo-950 text-white py-10 px-6 shadow-lg text-right">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black">لوحة تحكم المدير</h1>
                <p class="text-indigo-300">متابعة إنجازات المعلمين لعام 2026</p>
            </div>
            <div class="bg-indigo-900 p-4 rounded-2xl">
                <span class="text-xs block text-indigo-400">إجمالي المعلمين</span>
                <span class="text-xl font-black">{{ $teachers->count() }}</span>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 -mt-8">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-right">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 text-indigo-950 font-black">اسم المعلم</th>
                        <th class="px-6 py-4 text-indigo-950 font-black">المدرسة / المادة</th>
                        <th class="px-6 py-4 text-center text-indigo-950 font-black">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($teachers as $teacher)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $teacher->name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $teacher->school }} - {{ $teacher->subject }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ url('/teacher/'.$teacher->id) }}" class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-xs font-black hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                                <i class="fas fa-eye ml-1"></i> عرض الشواهد
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-20 text-center text-slate-400 font-bold">لا توجد بيانات معلمين حالياً</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>