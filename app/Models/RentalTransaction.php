<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'renter_id',
        'room_id',
        'paymethod_id',
        'start_date',
        'end_date',
        'total_amount',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymethod_id');
    }

    public function rentalAddons()
    {
        return $this->hasMany(RentalAddon::class);
    }
}
