<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'name',
        'location_id',
        'working_hour_starting_time',
        'working_hour_end_time',
    ];
}
