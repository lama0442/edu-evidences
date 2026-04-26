<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('school')->nullable();
        $table->string('subject')->nullable();
        $table->string('rank')->nullable();
        $table->integer('years_of_service')->default(0);
        
        // 👈 أضف هذه السطور إذا كانت ناقصة
        $table->string('phone')->nullable();   
        $table->string('admin')->nullable();   
        $table->string('manager')->nullable(); 
        
        $table->text('indicators')->nullable(); 
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};