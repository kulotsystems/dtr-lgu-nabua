<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_attendances';

    protected $fillable = [
        'id',
        'designation_id',
        'log_mode_id',
        'date_time'
    ];
}
