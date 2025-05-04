<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionUserBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_user_id',
        'behavior_id',
        'is_present',
        'created_at',
        'updated_at',
    ];
}
