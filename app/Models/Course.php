<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'syllabus', 'duration'];

    public $timestamps = true;

    protected $table = 'courses';

    // Course has many batches
    public function batches()
    {
        return $this->hasMany(Batch::class, 'course_id');
    }
}

