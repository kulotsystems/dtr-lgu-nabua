<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_login_logs';

    protected $fillable = [
        'id',
        'employee_id',
        'ip',
        'location',
        'network',
        'browser',
        'os'
    ];
}
