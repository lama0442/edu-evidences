<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('achievements', function (Blueprint $table) {
        $table->id();
        $table->string('teacher_name'); // اسم المعلم
        $table->string('school')->nullable(); // المدرسة
        $table->string('subject')->nullable(); // المادة
        $table->string('rank')->nullable();    // الرتبة
        
        // الحقول الجديدة لاستيعاب الشواهد المتعددة
        $table->text('evidences_data')->nullable(); // سيخزن الملاحظات والروابط كـ JSON
        $table->text('file_paths')->nullable();     // سيخزن مسارات الملفات المرفوعة كـ JSON
        $table->text('strategies')->nullable();     // سيخزن الاستراتيجيات المختارة
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
