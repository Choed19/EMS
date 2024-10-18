<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairReport extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $primaryKey = 'report_id';
    protected $fillable = [
        'user_id',
        'equipment_id',
        'description',
        'report_date',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }


    public $timestamps = true; // ใช้ timestamps ตามที่คุณมีอยู่ (created_at, updated_at)
}
