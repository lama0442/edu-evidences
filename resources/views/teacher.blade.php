<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>منصة إنجاز 2026 | صفحة المعلم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f1f5f9; }
        .premium-card { background: white; border-radius: 1.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column; }
        .input-premium { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 0.8rem; padding: 10px 12px; width: 100%; font-weight: bold; font-size: 0.85rem; }
        .input-premium:focus { border-color: #1e1b4b; outline: none; background: white; }
        .indicator-header { background: linear-gradient(135deg, #1e1b4b, #312e81); padding: 1rem; border-radius: 1.5rem 1.5rem 0.5rem 0.5rem; color: white; font-weight: 900; display: flex; justify-content: space-between; align-items: center; }
        .btn-upload { background: #f1f5f9; color: #1e1b4b; padding: 6px 14px; border-radius: 10px; font-weight: 800; font-size: 0.75rem; cursor: pointer; border: 1px dashed #1e1b4b; display: inline-flex; align-items: center; gap: 5px; }
        .btn-upload:hover { background: #1e1b4b; color: white; }
        .modal { display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); }
        .modal-content { background: white; margin: 5% auto; padding: 2rem; border-radius: 2rem; width: 85%; max-height: 85vh; overflow-y: auto; text-align: right; }
        .strategy-item { border: 2px solid #f1f5f9; border-radius: 1rem; padding: 1rem; cursor: pointer; position: relative; }
        .strategy-item.selected { border-color: #1e1b4b; background: #eef2ff; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

    <div id="strategyModal" class="modal no-print">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-black text-indigo-950">🎯 اختيار استراتيجيات التدريس</h2>
                <button onclick="closeStrategies()" class="text-2xl">✕</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="strategiesList"></div>
            <div class="mt-8 flex justify-end">
                <button onclick="saveSelectedStrategies()" class="bg-indigo-950 text-white px-8 py-3 rounded-xl font-bold">حفظ الاستراتيجيات</button>
            </div>
        </div>
    </div>

    <header class="bg-indigo-950 pt-10 pb-28 px-6 no-print text-right text-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-black">نظام إنجَاز المهني | 2026</h1>
                <p class="text-indigo-300 font-bold">التوثيق الكامل لجميع المؤشرات</p>
            </div>
            <button id="mainSaveBtn" onclick="saveToManager()" class="bg-emerald-600 px-10 py-4 rounded-2xl font-black shadow-lg mt-6 hover:bg-emerald-700 transition-all">💾 حفظ وإرسال للمدير</button>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 -mt-16 relative z-10 text-right">
        <div class="premium-card p-8 mb-8 border-t-8 border-indigo-900">
            <h2 class="text-xl font-black text-indigo-900 mb-6">👨‍🏫 بيانات المعلم/ة <span class="text-sm font-bold text-indigo-400">تحرير ✏️</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div><label class="text-xs font-bold mb-2 block">👤 الاسم</label><input type="text" id="t_name" placeholder="أدخل اسمك الثلاثي" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">🏫 المدرسة</label><input type="text" id="t_school" placeholder="اسم المدرسة" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">🏛️ إدارة تعليم</label><input type="text" id="t_admin" placeholder="المنطقة" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">📚 مادة أو مواد التدريس</label><input type="text" id="t_subject" placeholder="التخصص" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">👨‍💼 مدير/ة المدرسة</label><input type="text" id="t_manager" placeholder="اسم المدير" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">🏆 رتبة المعلم</label>
                    <select id="t_rank" class="input-premium">
                        <option value="غير محدد">غير محدد</option>
                        <option value="معلم ممارس">معلم ممارس</option>
                        <option value="معلم متقدم">معلم متقدم</option>
                        <option value="معلم خبير">معلم خبير</option>
                    </select>
                </div>
                <div><label class="text-xs font-bold mb-2 block">⏰ سنوات الخدمة</label><input type="number" id="t_exp" placeholder="0" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-2 block">📞 وسيلة التواصل</label><input type="text" id="t_phone" placeholder="الجوال" class="input-premium"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="indicatorsBox"></div>
    </main>

    <script>
        const indicators = [
            "أداء الواجبات المهنية", "المجتمع المهني", "الشراكة مع أولياء الأمور", 
            "استراتيجيات التدريس", "تحسين نواتج التعلم", "إعداد وتنفيذ خطط التعلم",
            "توظيف تقنيات ووسائل التعلم", "بيئة التعلم المحفزة", "الإدارة الصفية",
            "تحليل نتائج المتعلمين", "تنوع أساليب التقويم", "الإبداع والابتكار"
        ];

        const stratsData = ["العصف الذهني", "التعلم التعاوني", "حل المشكلات", "الاستقصاء", "لعب الأدوار", "الخرائط الذهنية", "التعلم المقلوب"];
        let selectedStrats = [];

        const box = document.getElementById('indicatorsBox');

        indicators.forEach((title, i) => {
            const index = i + 1;
            let subs = [];
            
            if (index === 1) subs = ["سجل الدوام الرسمي", "المناوبات والإشراف", "سجل الانتظار", "متابعة المهام اليومية"];
            if (index === 2) subs = ["زيارة معلم", "درس تطبيقي", "شهادة حضور معلم", "تبادل خبرة مع زميل"];
            if (index === 3) subs = ["استدعاء ولي أمر", "لقاء مع أولياء الأمور", "سجل تواصل", "إثبات قروبات", "اجتماعات"];
            if (index === 4) subs = ["تقرير أو صورة", "من سجل التحضير", "تطبيق معمل"];
            if (index === 5) subs = ["لجنة التحصيل الدراسي", "نتائج قبلية وبعدية", "خطط الدعم"];
            if (index === 6) subs = ["نماذج إعداد الدروس", "خطة توزيع المنهج", "نماذج الاختبارات", "خطة تنفيذية"];
            if (index === 7) subs = ["صور الوسائل", "برنامج تقني", "منصات تعليمية", "تقييم الوسائل"];
            if (index === 8) subs = ["تنظيم البيئة الصفية", "سجل التحفيز", "مبادرات صفيّة"];
            if (index === 9) subs = ["كشوف المتابعة", "تطبيقات الإدارة", "القواعد الصفية", "سجل السلوك"];
            if (index === 10) subs = ["تقرير تحليل النتائج", "سجل الفاقد", "تحليل الفروق", "تتبع التحسن"];
            if (index === 11) subs = ["نماذج اختبارات", "ملفات إنجاز", "مهام أدائية", "مشاريع"];
            if (index === 12) subs = ["💡 مشاريع إبداعية", "🏆 جوائز وتكريم", "🎨 أعمال طلابية"];

            let content = '';
            if (index === 4) {
                content += `<div class="bg-indigo-50 p-4 rounded-xl border-2 border-indigo-100 mb-4 flex justify-between items-center">
                    <div><span class="text-xs font-black text-indigo-900 block">🎯 الاستراتيجيات</span><div id="selectedDisplay" class="text-[9px] text-slate-500">لم يتم الاختيار</div></div>
                    <button onclick="openStrategies()" class="text-[10px] bg-indigo-950 text-white px-2 py-1 rounded-lg">إدارة</button>
                </div>`;
            }

            subs.forEach((s, idx) => {
                content += `
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-3 indicator-item">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[11px] font-black text-indigo-950 leading-tight">${idx+1}. ${s}</span>
                        <label class="btn-upload">📎 إضافة شاهد <input type="file" class="hidden file-input" data-title="${s}" onchange="fileAttached(this, 'b_${index}_${idx}', ${index})"></label>
                    </div>
                    <div id="b_${index}_${idx}" class="text-[10px] text-emerald-600 font-bold mb-2 hidden"></div>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" placeholder="📝 ملاحظة" class="input-premium h-8 text-[10px] note-input">
                        <input type="url" placeholder="🔗 رابط" class="input-premium h-8 text-[10px] link-input">
                    </div>
                </div>`;
            });

            box.innerHTML += `
                <div class="premium-card overflow-hidden border-b-4 border-indigo-900">
                    <div class="indicator-header">
                        <div class="flex flex-col"><span class="text-sm font-black">${index}. ${title}</span><span class="text-[10px] text-indigo-200 mt-1" id="status_${index}">0 شاهد • غير مكتمل ⭕</span></div>
                        <i class="fas fa-print no-print cursor-pointer" onclick="window.print()"></i>
                    </div>
                    <div class="p-5 flex-grow">${content}</div>
                </div>`;
        });

        function openStrategies() {
            const list = document.getElementById('strategiesList');
            list.innerHTML = stratsData.map(s => `<div class="strategy-item ${selectedStrats.includes(s) ? 'selected' : ''}" onclick="toggleStrat(this, '${s}')"><h4 class="font-black text-sm">${s}</h4></div>`).join('');
            document.getElementById('strategyModal').style.display = 'block';
        }

        function toggleStrat(el, name) { 
            el.classList.toggle('selected'); 
            if (selectedStrats.includes(name)) selectedStrats = selectedStrats.filter(s => s !== name); 
            else selectedStrats.push(name); 
        }

        function saveSelectedStrategies() { 
            document.getElementById('selectedDisplay').innerHTML = selectedStrats.map(s => `#${s}`).join(' ') || "لم يتم الاختيار"; 
            closeStrategies(); 
        }

        function closeStrategies() { document.getElementById('strategyModal').style.display = 'none'; }
        
        function fileAttached(input, badgeId, idx) { 
            if (input.files.length > 0) { 
                const b = document.getElementById(badgeId); 
                b.style.display = 'block'; 
                b.innerHTML = `✅ جاهز للرفع: ${input.files[0].name.substring(0, 10)}...`; 
                document.getElementById(`status_${idx}`).innerHTML = `شاهد مرفوع ✅`; 
            } 
        }

        // الدالة الأساسية لإرسال البيانات
        async function saveToManager() {
            const btn = document.getElementById('mainSaveBtn');
            const nameField = document.getElementById('t_name');
            
            if (!nameField.value.trim()) {
                alert("⚠️ يرجى كتابة اسم المعلم/ة أولاً");
                nameField.focus();
                return;
            }

            btn.innerHTML = "⏳ جاري إرسال البيانات...";
            btn.disabled = true;

            try {
                let formData = new FormData();
                formData.append('teacher_name', nameField.value);
                formData.append('school', document.getElementById('t_school').value);
                formData.append('subject', document.getElementById('t_subject').value);

                let evidences = [];
                document.querySelectorAll('.indicator-item').forEach((item, index) => {
                    const fileInput = item.querySelector('.file-input');
                    const noteInput = item.querySelector('.note-input');
                    const linkInput = item.querySelector('.link-input');

                    if (fileInput.files[0] || noteInput.value || linkInput.value) {
                        if (fileInput.files[0]) formData.append(`files[${index}]`, fileInput.files[0]);
                        evidences.push({
                            title: fileInput.dataset.title,
                            note: noteInput.value,
                            link: linkInput.value
                        });
                    }
                });

                formData.append('evidences_data', JSON.stringify(evidences));
                formData.append('strategies', JSON.stringify(selectedStrats));

                const response = await fetch('/save-teacher', { 
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    alert('🎉 تم الإرسال للمدير بنجاح!');
                } else {
                    alert('❌ فشل الإرسال: ' + (result.message || 'خطأ غير معروف'));
                }
            } catch (error) {
                console.error("Fetch Error:", error);
                alert('❌ خطأ في الاتصال بالسيرفر.');
            } finally {
                btn.innerHTML = "💾 حفظ وإرسال للمدير";
                btn.disabled = false;
            }
        }
    </script>
</body>
</html>