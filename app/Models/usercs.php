<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class usercs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

        protected $connection = 'mysql_fifth';
        protected $table = 'resultse';

            protected $fillable = [
                'Course',
                'Course_Title',
                'Credit',
                'Year',
                'Semester',
                'Grade'
            ];
}