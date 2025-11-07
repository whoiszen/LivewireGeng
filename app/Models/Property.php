<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_name',
        'address',
        'description',
        'monthly_rate',
        'status',
    ];

    /**
     * The user (landlord or owner) who owns the property.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Rooms that belong to this property.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
