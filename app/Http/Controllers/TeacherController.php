<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    // 1. عرض صفحة المعلم (إرسال البيانات)
    public function index()
    {
        return view('teacher_page'); 
    }

    // 2. دالة الحفظ (نسخة واحدة شاملة لكل شيء)
    public function store(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject'      => 'required|string',
            'files.*'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', 
        ]);

        try {
            $filePaths = [];
            
            // معالجة رفع الملفات المتعددة
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $path = $file->store('achievements', 'public');
                    $filePaths[$index] = $path;
                }
            }

            // تجميع البيانات للحفظ بمرونة
            $name = $request->input('teacher_name') ?? $request->input('name');
            $indicator = $request->input('indicator_title') ?? $request->input('indicator');

            // حفظ البيانات في قاعدة البيانات
            Achievement::create([
                'teacher_name'   => $name,
                'school'         => $request->school,
                'subject'        => $request->subject,
                'indicator_title'=> $indicator,
                'evidences_data' => is_string($request->evidences_data) ? json_decode($request->evidences_data, true) : $request->evidences_data,
                'strategies'     => is_string($request->strategies) ? json_decode($request->strategies, true) : $request->strategies,
                'file_paths'     => $filePaths,
                'evidence_link'  => $request->input('evidence_link') ?? $request->input('link'),
            ]);

            return response()->json(['success' => true, 'message' => 'تم الإرسال بنجاح ووصل للمدير! 🎉']);

        } catch (\Exception $e) {
            Log::error("خطأ في الحفظ: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }

    // 3. عرض لوحة تحكم المدير
   public function managerDashboard()
{
    // جلب البيانات من جدول الإنجازات
    $teachers = Achievement::orderBy('created_at', 'desc')->get(); 
    
    // تأكدي أن اسم الملف هنا هو manager وليس dashboard
    return view('manager', compact('teachers'));
}
    // 4. عرض تفاصيل معلم واحد
    public function showTeacherDetails($id)
    {
        $teacher = Achievement::findOrFail($id);
        return view('teacher_details', compact('teacher'));
    }

    // 5. صفحات بسيطة أخرى
    public function welcome() {
        return view('welcome');
    }
}