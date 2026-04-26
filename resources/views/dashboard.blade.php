<x-app-layout>
    {{-- نضع تصميمك الفخم هنا بدلاً من الكود الافتراضي --}}
    <div class="antialiased text-slate-200 p-4 md:p-8" style="background: radial-gradient(circle at top right, #1e293b, #0f172a); min-height: 100vh; direction: rtl;">
        
        <div class="max-w-7xl mx-auto">
            {{-- الهيدر الخاص بك --}}
            <header class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <div class="text-right">
                    <h1 class="text-4xl md:text-5xl font-black mb-2 flex items-center gap-4">
                        <span class="bg-indigo-600 p-3 rounded-2xl">
                            <i class="fas fa-shield-halved text-white text-2xl"></i>
                        </span>
                        <span style="background: linear-gradient(90deg, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            لوحة التحكم الإدارية
                        </span>
                    </h1>
                    <p class="text-slate-400 font-medium mr-16">أهلاً بكِ يا لما في نظام متابعة الشواهد 2026</p>
                </div>

                <div class="flex gap-4">
                    <div class="bg-white/5 backdrop-blur-md p-6 rounded-[2rem] text-center min-w-[160px] border border-white/10">
                        <span class="text-indigo-300 text-xs font-bold block mb-2 uppercase tracking-tighter">إجمالي المعلمين</span>
                        <span class="text-4xl font-black text-white leading-none">{{ $teachers->count() ?? '0' }}</span>
                    </div>
                </div>
            </header>

            {{-- البطاقة الرئيسية (الجدول) --}}
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                        <h2 class="text-2xl font-black text-slate-800">سجل المعلمين والمنجزات</h2>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    {{-- ضعي هنا جدول المعلمين (الـ Table) الذي أرسلتيه في الرسالة السابقة --}}
                    <table class="w-full text-right">
                        {{-- ... محتوى الجدول الخاص بك ... --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
