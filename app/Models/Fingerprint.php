<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_fingerprints';

    protected $fillable = [
        'id',
        'employee_id',
        'finger_id',
        'fingerprint'
    ];
}
