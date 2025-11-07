<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function tenantSetting()
    {
        return $this->hasOne(TenantSetting::class);
    }

    public function rentalTransactions()
    {
        return $this->hasMany(RentalTransaction::class);
    }
}
