<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_positions';

    protected $fillable = [
        'id',
        'title',
        'description'
    ];
}
