<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $table = 'addons';
    protected $primaryKey = 'id';
    public $timestamps = false; // because migration has only 'created_at'

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'description',
        'status',
        'created_at',
    ];

    // 🔗 Relationships
    public function rentalAddons()
    {
        return $this->hasMany(RentalAddon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
