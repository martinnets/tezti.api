<?php

namespace App\Models;

use App\Enums\AdditionalIsActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['is_active_label'];

    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    /**
     * Summary of isActiveLabel
     *
     * @return string
     */
    public function getIsActiveLabelAttribute()
    {
        return AdditionalIsActive::getName($this->is_active);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
