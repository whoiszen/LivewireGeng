<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'contact'];

    public function tenantSettings()
    {
        return $this->hasOne(TenantSetting::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function rentalTransactions()
    {
        return $this->hasMany(RentalTransaction::class);
    }
}
