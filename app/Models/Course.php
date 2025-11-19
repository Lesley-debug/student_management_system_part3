<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'syllabus', 'duration', 'teacher_id'];

    public $timestamps = true;

    protected $table = 'courses';

    // Course has many batches
    public function batches()
    {
        return $this->hasMany(Batch::class, 'course_id');
    }

     public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }
     public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}

