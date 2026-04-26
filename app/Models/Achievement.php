<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    // بدون هذه الأسطر، لن تدخل أي بيانات لقاعدة البيانات
  protected $fillable = [
    'teacher_name', 'school', 'subject', 'rank', 
    'evidences_data', 'file_paths', 'strategies'
];

// هذا السطر يخبر لارافل بتحويل الـ JSON تلقائياً إلى مصفوفة PHP
protected $casts = [
    'evidences_data' => 'array',
    'file_paths'     => 'array',
    'strategies'     => 'array',
];
}

