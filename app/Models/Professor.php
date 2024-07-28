<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'university_degree'];

    public function theses()
    {
        return $this->belongsToMany(Thesis::class);
    }
}
