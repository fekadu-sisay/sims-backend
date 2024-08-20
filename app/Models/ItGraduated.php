<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItGraduated extends Model
{
    use HasFactory;
    protected $connection = 'mysql_third';

    protected $fillable = [
        'FirstName',
        'FatherName',
        'GFatherName',
        'Sex',
        'DegreeAwarded',
        'StudyDuration',
        'GraduationDate'
    ];

}