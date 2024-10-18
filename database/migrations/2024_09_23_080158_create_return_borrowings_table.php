note<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returnborrowings', function (Blueprint $table) {
            $table->id('return_id');
            $table->unsignedBigInteger('borrow_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('equipment_id');
            $table->string('serial_no');
            $table->string('equipment_name');
            $table->string('building_no');
            $table->string('room_no');
            $table->enum('status', ['รอ', 'คืน' ,'ยืนยันการคืน', 'คืนไมสำเร็จ'])->default('รอ');
            $table->string('note')->nullable();
            $table->date('returned_date')->nullable();
            $table->timestamp('created_at')->useCurrent();  // created_at with current_timestamp() as default
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returnborrowings');
    }
};
