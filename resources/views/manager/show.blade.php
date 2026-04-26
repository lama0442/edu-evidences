<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل إنجاز المعلم | منصة إنجاز</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Tajawal', sans-serif; background-color: #f8fafc; }</style>
</head>
<body class="p-4 md:p-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-indigo-950">شواهد المعلم: {{ $teacher->name }}</h1>
                    <p class="text-slate-500 text-sm font-bold">{{ $teacher->subject }} - {{ $teacher->school }}</p>
                </div>
            </div>
            <a href="{{ url('/admin') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-2.5 rounded-xl font-black text-sm transition flex items-center gap-2">
                <i class="fas fa-arrow-right"></i> عودة للوحة المدير
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse($achievements as $item)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 flex flex-col md:flex-row gap-6 hover:border-indigo-300 transition-colors duration-300">
                    
                    <div class="flex-grow text-right order-2 md:order-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-indigo-600 text-white w-6 h-6 rounded-lg flex items-center justify-center text-[10px] font-black">
                                {{ $loop->iteration }}
                            </span>
                            <span class="text-xs font-black text-indigo-500 uppercase tracking-wider">البند المهني / المؤشر</span>
                        </div>
                        
                        <h3 class="text-xl font-black text-indigo-950 mb-4">{{ $item->indicator_title }}</h3>
                        
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 mb-5">
                            <p class="text-sm font-bold text-slate-700 leading-relaxed">
                                <span class="text-indigo-600 font-black"><i class="fas fa-comment-dots ml-1"></i> ملاحظة المعلم:</span> 
                                {{ $item->note ?: 'لا توجد ملاحظات مكتوبة.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-xs font-black hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                                    <i class="fas fa-external-link-alt"></i> فتح رابط الشاهد (Drive/YouTube)
                                </a>
                            @endif
                            
                            @if($item->file_path)
                                <a href="{{ Storage::url($item->file_path) }}" download class="inline-flex items-center gap-2 bg-slate-800 text-white px-5 py-2.5 rounded-xl text-xs font-black hover:bg-black transition shadow-lg shadow-slate-200">
                                    <i class="fas fa-download"></i> تحميل الملف
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-56 h-56 bg-slate-50 rounded-2xl overflow-hidden border-2 border-dashed border-slate-200 flex items-center justify-center relative group order-1 md:order-2">
                        @if($item->file_path)
                            @php $extension = pathinfo($item->file_path, PATHINFO_EXTENSION); @endphp
                            
                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ Storage::url($item->file_path) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300">
                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="text-white text-xs font-black bg-white/20 px-4 py-2 rounded-xl backdrop-blur-md border border-white/30 hover:bg-white/40">
                                        <i class="fas fa-search-plus ml-1"></i> عرض بحجم كامل
                                    </a>
                                </div>
                            @else
                                <div class="text-center p-4">
                                    <i class="fas fa-file-pdf text-red-500 text-5xl mb-2"></i>
                                    <p class="text-[10px] font-black text-slate-500 uppercase">{{ $extension }} مستند</p>
                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="mt-2 block text-indigo-600 font-bold text-xs underline">معاينة الملف</a>
                                </div>
                            @endif
                        @else
                            <div class="text-center opacity-40">
                                <i class="fas fa-link text-3xl mb-2"></i>
                                <p class="text-[10px] font-bold">شاهد برابط خارجي فقط</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white p-20 rounded-3xl border border-dashed border-slate-300 text-center">
                    <div class="text-6xl mb-4">📂</div>
                    <h3 class="text-xl font-black text-slate-400">لا توجد شواهد مرفوعة لهذا المعلم حالياً</h3>
                    <p class="text-slate-400 font-bold mt-2 text-sm">سيتم عرض الشواهد هنا بمجرد قيام المعلم بحفظها من لوحته</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>