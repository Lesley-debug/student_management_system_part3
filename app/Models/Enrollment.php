<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'enroll_no',
    'student_id',
    'course_id',
    'batch_id',
    'join_date',
    'fee'
];


    protected $table = 'enrollments';

    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    // Enrollment has many payments
    public function payments()
    {
        return $this->hasMany(Payment::class, 'enrollment_id');
    }

}
