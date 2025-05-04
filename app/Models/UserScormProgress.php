<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScormProgress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'scorm_package_id',
        'status',
        'score',
        'suspend_data',
        'started_at',
        'completed_at'
    ];
    
    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scormPackage()
    {
        return $this->belongsTo(ScormPackage::class);
    }
}