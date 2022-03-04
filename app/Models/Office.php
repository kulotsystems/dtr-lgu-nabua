<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_offices';

    protected $fillable = [
        'id',
        'code',
        'description'
    ];
}
