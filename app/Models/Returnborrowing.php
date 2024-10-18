<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnborrowing extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'returnborrowings'; // Update to match your table name

    // Specify the primary key
    protected $primaryKey = 'return_id';

    // If your primary key is not an auto-incrementing integer, set this to false
    public $incrementing = true;

    // Specify the data types of your attributes
    protected $casts = [
        'returned_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Allow mass assignment for these attributes
    protected $fillable = [
        'borrow_id',
        'user_id',
        'equipment_id',
        'serial_no',
        'equipment_name',
        'building_no',
        'room_no',
        'status',
        'status_borrow',
        'note',
        'returned_date',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrow_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}

    

