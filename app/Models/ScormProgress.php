<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScormProgress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'scorm_package_id',
        'location',
        'completion_status',
        'score',
        'suspend_data',
        'total_time',
        'last_accessed_at'
    ];
    
    protected $casts = [
        'last_accessed_at' => 'datetime',
    ];
    
    /**
     * Relación con el paquete SCORM
     */
    public function scormPackage()
    {
        return $this->belongsTo(ScormPackage::class);
    }
    
    /**
     * Relación con el usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Verifica si el paquete SCORM está completado
     */
    public function isCompleted()
    {
        return $this->completion_status === 'completed';
    }
}