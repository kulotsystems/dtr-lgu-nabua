<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finger extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_fingers';

    protected $fillable = [
        'id',
        'title'
    ];
}
