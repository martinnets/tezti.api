<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionUserSkillResult extends Model
{
    use HasFactory;

    /**
     * Summary of skill
     *
     * @return BelongsTo
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
