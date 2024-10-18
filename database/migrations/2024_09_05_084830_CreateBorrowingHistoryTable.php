<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id('borrow_id');  // Primary key, int(11)
        $table->unsignedBigInteger('user_id');  // Foreign key to users, int(20)
        $table->unsignedBigInteger('equipment_id');  // Foreign key to equipment, bigint(20) unsigned
        $table->string('serial_no', 255)->nullable();  // SerialNo, varchar(255)
        $table->string('equipment_name', 255)->nullable();  // NameEquipment, varchar(255)
        $table->string('building_no', 255)->nullable();  // cost, decimal(10,2), nullable
        $table->string('room_no', 255)->nullable();  // location, varchar(255), nullable
        $table->enum('status', ['รอ', 'ยืม','อนุมัติ','ดำเนินการคืน','คืนสำเร็จ'])->default('รอ');  // status, enum('รอ','ยืม'), default 'รอ'
        $table->string('note')->nullable();
        $table->date('borrowed_date')->nullable();  // borrowed_date, date, nullable
        $table->date('returned_date')->nullable();  // returned_date, date, nullable
        $table->date('created_at')->useCurrent();  // created_at with current_timestamp() as default
        $table->date('updated_at')->useCurrent()->useCurrentOnUpdate();  // updated_at with current_timestamp() and updates on change

        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_general_ci';
    });
    
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowing');
    }
};