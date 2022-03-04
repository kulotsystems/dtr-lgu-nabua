<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_employees';

    protected $fillable = [
        'id',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'name_suffix',
        'is_male',
        'date_of_birth',
        'avatar'
    ];


    /**
     * Get the Account associated with the Employee.
     */
    public function account()
    {
        return $this->hasOne(Account::class);
    }


    /**
     * Get the Designations associated with the Employee.
     */
    public function designations()
    {
        return $this->hasMany(Designation::class);
    }
}
