<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    // عرض لوحة التحكم الرئيسية للمدير
    public function index()
    {
        $teachers = Teacher::all(); 
        return view('admin', compact('teachers'));
    }

    // عرض تفاصيل معلم محدد وشواهده
    public function show($id) {
    $teacher = Teacher::findOrFail($id);
    return view('manager.show', compact('teacher'));
}

    // دالة الحفظ الموحدة (لحفظ البيانات + الشواهد)
    public function saveTeacherData(Request $request) 
    {
        try {
            $info = $request->input('teacher_info');
            $indicators = $request->input('indicators', []); 

            // الحفظ أو التحديث بناءً على الاسم
            $teacher = Teacher::updateOrCreate(
                ['name' => $info['name']], 
                [
                    'school'           => $info['school'] ?? '',
                    'subject'          => $info['subject'] ?? '',
                    'rank'             => $info['rank'] ?? '',
                    'years_of_service' => $info['years_of_service'] ?? 0,
                    'phone'            => $info['phone'] ?? '',
                    'admin'            => $info['admin'] ?? '',
                    'manager'          => $info['manager'] ?? '',
                    // تخزين المصفوفة بصيغة JSON
                    'indicators'       => json_encode($indicators) 
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'تم حفظ البيانات والشواهد بنجاح'
            ], 200);

        } catch (\Exception $e) {
            Log::error("🚨 خطأ في الحفظ: " . $e->getMessage()); 
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}