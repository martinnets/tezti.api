<?php

namespace App\Models;

use App\Enums\DocumentType;
use App\Enums\RoleUser;
use App\Enums\UserIsActive;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $appends = ['is_active_label', 'document_type_label', 'role_label'];

    /**
     * The attributes that are mass assignable.
     *
     * For Role values are: S: Superadmin (Tezti), C: Admin cliente
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'role',
        'document_type',
        'document_number',
        'phone',
        'email',
        'password',
        'verification_code',
        'verification_code_at',
        'is_active',
        'email_verified_at',
        'organization_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'verification_code_at',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'verification_code' => 'hashed',
        ];
    }

    /**
     * Summary of organization
     *
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    /**
     * Summary of isActiveLabel
     *
     * @return string
     */
    public function getIsActiveLabelAttribute()
    {
        return UserIsActive::getName($this->is_active);
    }

    /**
     * Summary of documentTypeLabel
     *
     * @return string
     */
    public function getDocumentTypeLabelAttribute()
    {
        return DocumentType::getName($this->document_type);
    }

    /**
     * Summary of roleLabel
     *
     * @return string
     */
    public function getRoleLabelAttribute()
    {
        return RoleUser::getName($this->role);
    }

}
