<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorm extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'path',
        'original_filename',
        'order'
    ];

    public function progresses()
    {
        return $this->hasMany(ScormProgress::class);
    }

    public function getEntryPoint()
    {
        return Storage::url('scorms/' . $this->path . '/index.html');
    }
}