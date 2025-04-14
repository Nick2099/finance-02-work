<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'main_user',
        'main_user_no',
        'custom_groups',
        'custom_groups_id',
        'level',
        'admin_level',
        'timezone',
        'language',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
