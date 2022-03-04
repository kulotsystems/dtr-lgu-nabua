<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMode extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_log_modes';

    protected $fillable = [
        'id',
        'title',
        'description'
    ];
}
