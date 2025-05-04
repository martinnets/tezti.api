<?php

namespace App\Models;

use App\Enums\PositionUserStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionUser extends Model
{
    use HasFactory;

    protected $appends = ['status_label', 'progress', 'deadline_at', 'deadline_color'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Summary of position
     *
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id')->select(['id', 'name', 'hierarchical_level_id', 'status']);
    }

    /**
     * Summary of user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name', 'lastname', 'email', 'document_number', 'document_type', 'is_active']);
    }

    /**
     * Summary of additionals
     *
     * @return HasMany
     */
    public function additionals()
    {
        return $this->HasMany(PositionUserAdditional::class, 'position_user_id');
    }

    /**
     * Summary of statusLabel
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return PositionUserStatus::getName($this->status);
    }

    /**
     * Summary of progress
     *
     * @return array
     */
    public function getProgressAttribute(): float
    {
        $progress = 0;
        if ($this->status === 2) {
            $progress = 1;
        } else {
            $assignedSkills = PositionSkill::where('position_id', $this->position_id)->count();
            $solvedSkills = SkillBehavior::whereIn('behavior_id', PositionUserBehavior::where('position_user_id', $this->id)->pluck('behavior_id')->unique())->pluck('skill_id')->unique()->count() - 1;

            $progress = ($solvedSkills > 0 && $assignedSkills > 0) ? $solvedSkills / $assignedSkills : 0;
        }

        return $progress;
    }

    /**
     * Summary of deadlineAt
     *
     * @return array
     */
    public function getdeadlineAtAttribute(): string
    {
        if ($this->status === 0) {
            $invited_at = Carbon::parse($this->created_at);
            $deadline_at = $invited_at->addWeeks(3);

            $deadline_at = ($this->to < $deadline_at) ? Carbon::parse($this->to)->format('d/m/Y') : $invited_at->format('d/m/Y');
        } else {
            $deadline_at = "-";
        }
        return $deadline_at;
    }

    /**
     * Summary of deadlineColor
     *
     * @return array
     */
    public function getdeadlineColorAttribute(): string
    {
        if ($this->status === 0) {
            $deadline_at = Carbon::parse($this->deadline_at);

            $deadline_color = Carbon::now()->addDays(7)->greaterThanOrEqualTo($deadline_at) ? 'FF0000' : 'C0C0C0';
        } else {
            $deadline_color = "000000";
        }
        return $deadline_color;
    }
}
