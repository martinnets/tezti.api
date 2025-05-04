<?php

namespace App\Models;

use App\Enums\PositionStatus;
use App\Enums\PositionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['type_label', 'status_label', 'progress'];

    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hierarchical_level_id',
        'name',
        'type',
        'from',
        'to',
        'status',
        'user_id',
        'organization_id',
    ];

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

    /**
     * Summary of hierarchical level
     *
     * @return BelongsTo
     */
    public function hierarchicalLevel()
    {
        return $this->belongsTo(HierarchicalLevel::class, 'hierarchical_level_id');
    }

    /**
     * Summary of organization
     *
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id')->select(['id', 'name'])->withDefault([
            'id' => 0,
            'name' => 'Tezti',
        ]);
    }

    /**
     * Summary of creator
     *
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name']);
    }

    /**
     * Summary of additional fields
     *
     * @return HasMany
     */
    public function additionals()
    {
        return $this->hasMany(PositionAdditional::class, 'position_id');
    }

    /**
     * Summary of skills
     *
     * @return HasMany
     */
    public function skills()
    {
        return $this->hasMany(PositionSkill::class);
    }

    /**
     * Summary of statusLabel
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return PositionStatus::getName($this->status);
    }

    /**
     * Summary of typeLabel
     *
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        return PositionType::getName($this->type);
    }

    /**
     * Summary of positionUsers
     *
     * @return HasMany
     */
    public function positionUsers()
    {
        return $this->hasMany(PositionUser::class);
    }

    /**
     * Summary of progress
     *
     * @return float
     */
    public function getProgressAttribute()
    {
        // Total de usuarios en estado 1 o 0
        $totalUsers = $this->positionUsers()
            ->whereIn('status', [0, 1])
            ->count();

        if ($totalUsers === 0) {
            return 0; // Evitar división por cero
        }

        // Usuarios con estado 2
        $completedUsers = $this->positionUsers()
            ->where('status', 2)
            ->count();

        // Calcular porcentaje
        return round(($completedUsers / $totalUsers), 4);
    }
}
