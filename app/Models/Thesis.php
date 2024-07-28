<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'summary', 'students', 'grade',
        'career_id', 'subject_id', 'date', 'document_path'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function professors()
    {
        return $this->belongsToMany(Professor::class);
    }
}
