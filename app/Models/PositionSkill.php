<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionSkill extends Model
{
    use HasFactory;
    protected $table = "position_skills";

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
        'skill_id'
    ];

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
