<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAddon extends Model
{
    use HasFactory;

    protected $fillable = ['rental_transaction_id', 'addon_id', 'quantity', 'subtotal'];

    public function rentalTransaction()
    {
        return $this->belongsTo(RentalTransaction::class);
    }

    public function addon()
    {
        return $this->belongsTo(Addon::class);
    }
}
