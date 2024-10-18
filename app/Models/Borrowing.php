<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{

    protected $table = 'borrowings'; // ชื่อของตาราง
    protected $primaryKey = 'borrow_id'; // ชื่อคอลัมน์ที่ใช้เป็น primary key


    use HasFactory;
    protected $fillable = [
        'user_id',
        'equipment_id',
        'serial_no',
        'equipment_name',
        'building_no',
        'room_no',
        'status',
        'status_borrow',
        'note',
        'borrowed_date',
        'returned_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function joinReturn()
    {
        return $this->belongsTo(Returnborrowing::class, 'borrow_id');
    }

    // ความสัมพันธ์กับ Model Equipment
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
    public function reports()
    {
        return $this->belongsTo(Equipment::class, 'report_id');
    }
}
