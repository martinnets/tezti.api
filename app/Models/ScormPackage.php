<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScormPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'folder_name',
        'entry_point',
        'version',
        'order',
        'is_active'
    ];
    
    /**
     * Relación con los progresos de los usuarios
     */
    public function progress()
    {
        return $this->hasMany(ScormProgress::class);
    }
    
    /**
     * Obtiene el progreso de un usuario específico
     */
    public function getUserProgress($userId)
    {
        return $this->progress()->where('user_id', $userId)->first();
    }
    
    /**
     * Construye la URL para el punto de entrada del SCORM
     */
    public function getEntryUrl()
    {
        return route('scorm.serve_file', [
            'id' => $this->id,
            'filePath' => $this->entry_point
        ]);
    }
}