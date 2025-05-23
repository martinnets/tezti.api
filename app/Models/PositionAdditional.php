<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionAdditional extends Model
{
    use HasFactory;
    protected $table = "position_additionals";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position_id',
        'additional_id'
    ];
}
