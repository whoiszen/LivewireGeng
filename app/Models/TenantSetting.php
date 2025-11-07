<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'allow_notifications',
        'theme_preference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
