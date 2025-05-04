<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionUserAdditional extends Model
{
    use HasFactory;

    /**
     * Summary of additional
     *
     * @return BelongsTo
     */
    public function additional()
    {
        return $this->belongsTo(Additional::class, 'additional_id')->select(['id', 'name']);
    }
}
