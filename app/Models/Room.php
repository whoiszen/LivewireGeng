<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_number', 'capacity', 'price', 'renter_id'];

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function rentalTransactions()
    {
        return $this->hasMany(RentalTransaction::class);
    }
}
