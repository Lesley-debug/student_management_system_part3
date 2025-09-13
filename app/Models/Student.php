<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'mobile', 'address'];

    protected $table = 'students';

    public $timestamps = true;

    // Student has many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
