<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    // 1. تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name', 
        'school', 
        'admin', 
        'subject', 
        'manager', 
        'rank', 
        'years_of_service', 
        'phone', 
        'indicators'
    ];

    // 2. ضمان تحويل الشواهد لمصفوفة تلقائياً عند التعامل معها
    protected $casts = [
        'indicators' => 'array',
    ];
} // تأكد أن هذا القوس موجود في نهاية الملف