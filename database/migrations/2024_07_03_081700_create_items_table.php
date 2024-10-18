<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *///
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id('equipment_id');
            $table->string('year');
            $table->string('equipment_group');
            $table->string('serial_no');
            $table->string('equipment_name');
            $table->decimal('cost', 12, 2)->nullable();
            $table->date('buy_date')->nullable();
            $table->string('department_name');
            $table->string('building_no');
            $table->string('room_no');
            $table->string('status');
            $table->string('status_borrow')->nullable();
            $table->dateTime('create_time')->nullable();
            $table->string('create_by');
            $table->dateTime('update_time')->nullable();
            $table->string(column: 'update_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
