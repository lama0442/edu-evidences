<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>منصة إنجاز 2026 | التوثيق المهني</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f1f5f9; }
        .premium-card { background: white; border-radius: 1.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; transition: all 0.3s ease; }
        .input-premium { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 0.8rem; padding: 10px; width: 100%; font-weight: bold; color: #1e1b4b; font-size: 0.85rem; }
        .input-premium:focus { border-color: #1e1b4b; outline: none; background: white; }
        .indicator-header { background: linear-gradient(135deg, #1e1b4b, #312e81); padding: 1rem; border-radius: 1.5rem 1.5rem 0.5rem 0.5rem; color: white; font-weight: 900; display: flex; justify-content: space-between; align-items: center; }
        .file-badge { background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; display: none; margin-top: 8px; border: 1px solid #10b981; font-weight: bold; }
        .btn-upload { background: #f1f5f9; color: #1e1b4b; padding: 8px; border-radius: 10px; font-weight: 800; font-size: 0.75rem; cursor: pointer; border: 1px dashed #1e1b4b; text-align: center; display: block; width: 100%; }
        .btn-upload:hover { background: #1e1b4b; color: white; }
    </style>
</head>
<body>

    <header class="bg-indigo-950 pt-10 pb-28 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-white">
            <div class="text-right">
                <h1 class="text-3xl font-black italic text-emerald-400">نظام إنجَاز المهني | 2026</h1>
                <p class="text-indigo-300 font-bold mt-1">منصة توثيق الشواهد الرقمية الموحدة</p>
            </div>
            <div class="flex gap-3 mt-6">
                <button id="saveAllBtn" onclick="saveToManager(event)" class="bg-emerald-600 hover:bg-emerald-700 px-8 py-3 rounded-xl font-black shadow-lg transition duration-300 transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-cloud-upload-alt"></i> حفظ وإرسال الملف بالكامل
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 -mt-16 relative z-10">
        <div class="premium-card p-8 mb-8 border-t-8 border-indigo-900">
            <h2 class="text-indigo-900 font-black mb-4 flex items-center gap-2 text-lg">
                <i class="fas fa-id-card"></i> المعلومات الأساسية
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div><label class="text-xs font-bold mb-1 block text-slate-500 text-right">الاسم الكامل</label><input type="text" id="name" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-1 block text-slate-500 text-right">المدرسة</label><input type="text" id="school" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-1 block text-slate-500 text-right">المادة</label><input type="text" id="subject" class="input-premium"></div>
                <div><label class="text-xs font-bold mb-1 block text-slate-500 text-right">الرتبة</label>
                    <select id="rank" class="input-premium">
                        <option>معلم ممارس</option>
                        <option>معلم متقدم</option>
                        <option>معلم خبير</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10" id="indicatorsBox"></div>
    </main>

    <script>
        const titles = [
            "أداء الواجبات المهنية", "المجتمع المهني", "الشراكة المجتمعية", 
            "استراتيجيات التدريس", "نواتج التعلم", "التخطيط المطور للدروس",
            "توظيف التقنية", "بيئة التعلم", "الإدارة الصفية", 
            "تحليل النتائج", "أدوات التقويم", "الإبداع والابتكار"
        ];
        
        const box = document.getElementById('indicatorsBox');
        
        titles.forEach((title, i) => {
            const index = i + 1;
            box.innerHTML += `
                <div class="premium-card overflow-hidden transition hover:shadow-xl group" id="card_${index}">
                    <div class="indicator-header">
                        <span class="text-sm font-black">${index}. ${title}</span>
                        <i class="fas fa-file-pdf opacity-30 group-hover:opacity-100 transition"></i>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200">
                            <label class="btn-upload">
                                <i class="fas fa-paperclip"></i> رفع (صورة / PDF)
                                <input type="file" class="hidden file-input" data-index="${index}" accept="image/*,.pdf" onchange="showBadge(this, 'b_${index}')">
                            </label>
                            <div id="b_${index}" class="file-badge text-center"></div>
                        </div>

                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200">
                            <input type="url" class="input-premium text-[10px] link-input" data-index="${index}" placeholder="ضع رابط الشاهد (Drive/YouTube)">
                        </div>

                        <button type="button" onclick="saveSingleIndicator(${index}, this, event)" class="w-full bg-indigo-900 text-white py-2 rounded-xl text-[10px] font-black hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> حفظ هذا المؤشر فقط
                        </button>
                    </div>
                </div>`;
        });

        function showBadge(input, badgeId) {
            if(input.files.length > 0) {
                const b = document.getElementById(badgeId);
                b.style.display = 'block';
                b.innerText = "✅ جاهز: " + input.files[0].name;
            }
        }

    async function saveSingleIndicator(index, btn, event) {
    if(event) event.preventDefault();
    
    const name = document.getElementById('name').value;
    if(!name) { alert("⚠️ يرجى كتابة اسم المعلم أولاً!"); return; }

    const formData = new FormData();
    // تغيير الأسماء هنا لتطابق الكنترولر وقاعدة البيانات
    formData.append('teacher_name', name);
    formData.append('school', document.getElementById('school').value);
    formData.append('subject', document.getElementById('subject').value);
    formData.append('rank', document.getElementById('rank').value);
    formData.append('indicator_index', index);

    const fileInput = document.querySelector(`.file-input[data-index="${index}"]`);
    const linkInput = document.querySelector(`.link-input[data-index="${index}"]`);

    // هنا السر: استخدمنا file_path و link بدلاً من الأسماء القديمة
    if (fileInput.files.length > 0) formData.append('file_path', fileInput.files[0]);
    if (linkInput.value.trim() !== "") formData.append('link', linkInput.value);

    btn.disabled = true;
    const originalText = btn.innerHTML;
    btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...`;

    try {
        const response = await fetch('/save-teacher', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        });

        if (response.ok) {
            btn.innerHTML = `<i class="fas fa-check-circle"></i> تم الحفظ`;
            btn.classList.replace('bg-indigo-900', 'bg-emerald-600');
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.replace('bg-emerald-600', 'bg-indigo-900');
                btn.disabled = false;
            }, 2000);
        }
    } catch (error) {
        btn.innerHTML = `<i class="fas fa-times-circle"></i> خطأ`;
        btn.disabled = false;
    }
}
        }

        // 2. دالة الحفظ الكلي (لإرسال كل المؤشرات دفعة واحدة)
        async function saveToManager(event) {
            if(event) event.preventDefault();

            const name = document.getElementById('name').value;
            if(!name) { alert("⚠️ أدخل اسم المعلم أولاً!"); return; }

            const saveAllBtn = document.getElementById('saveAllBtn');
            saveAllBtn.disabled = true;
            saveAllBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> جاري إرسال الملف بالكامل...`;

            const formData = new FormData();
            formData.append('teacher_name', name);
            formData.append('school', document.getElementById('school').value);
            formData.append('subject', document.getElementById('subject').value);
            formData.append('rank', document.getElementById('rank').value);

            // تجميع كافة الروابط والملفات
            document.querySelectorAll('.file-input').forEach(input => {
                if(input.files.length > 0) {
                    formData.append(`files[${input.dataset.index}]`, input.files[0]);
                }
            });

            document.querySelectorAll('.link-input').forEach(input => {
                if(input.value.trim() !== "") {
                    formData.append(`links[${input.dataset.index}]`, input.value);
                }
            });

            try {
                const response = await fetch('/save-teacher', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: formData
                });

                if (response.ok) {
                    alert("✅ تم إرسال ملف الإنجاز بالكامل للمدير بنجاح!");
                    location.reload();
                } else {
                    alert("❌ حدث خطأ في الخادم أثناء الحفظ الكلي.");
                }
            } catch (error) {
                alert("❌ فشل الاتصال بالسيرفر.");
            } finally {
                saveAllBtn.disabled = false;
                saveAllBtn.innerHTML = `<i class="fas fa-cloud-upload-alt"></i> حفظ وإرسال الملف بالكامل`;
            }
        }
    </script>
</body>
</html>