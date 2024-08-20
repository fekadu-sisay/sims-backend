<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CE_Courses extends Model
{
    use HasFactory;
    protected $connection = 'mysql_Second';
    protected $fillable=[
        'Course',
        'CourseTitle',
        'Credit',
        'Year',
        'Semester',
        'CourseCategory'
    ];
}