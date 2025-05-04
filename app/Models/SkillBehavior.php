<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillBehavior extends Model
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

    /**
     * Summary of behavior
     *
     * @return BelongsTo
     */
    public function behavior()
    {
        return $this->belongsTo(Behavior::class, 'behavior_id');
    }
}
