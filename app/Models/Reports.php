<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $connection = 'mysql';

    protected $fillable = [
        'FirstName', 'LastName', 'Email', 'Title', 'Report', 'idno'
    ];

}