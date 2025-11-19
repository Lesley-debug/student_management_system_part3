<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'address',
    ];

    protected $table = 'students';

    public $timestamps = true;

    // Relationship: Student has many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    // Relationship: Student has many payments (through enrollments)
    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            Enrollment::class,
            'student_id',   // Foreign key on enrollments table
            'enrollment_id',// Foreign key on payments table
            'id',           // Local key on students table
            'id'            // Local key on enrollments table
        );
    }
}
