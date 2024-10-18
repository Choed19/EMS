<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->bigIncrements('report_id'); // รหัสการแจ้งซ่อม
        $table->unsignedBigInteger('user_id'); // รหัสผู้ใช้งาน
        $table->unsignedBigInteger('equipment_id'); // รหัสอุปกรณ์ที่แจ้งซ่อม
        $table->text('description'); // รายละเอียดการแจ้งซ่อม
        $table->date('report_date'); // วันที่แจ้งซ่อม
        $table->enum('status', ['รอดำเนินการ', 'กำลังดำเนินการ', 'เสร็จสิ้น'])->default('รอดำเนินการ'); // สถานะการซ่อม
        $table->timestamps(); // created_at และ updated_at
    
        // Foreign key constraints
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->foreign('equipment_id')->references('equipment_id')->on('equipment')->onDelete('cascade');
    });
    
}

}
