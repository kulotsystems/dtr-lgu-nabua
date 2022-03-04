<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_designations';

    protected $fillable = [
        'id',
        'office_id',
        'position_id',
        'employee_id',
        'date',
        'is_head',
        'type'
    ];


    /**
     * Get the Office associated with the Designation.
     * @return Office
     */
    public function getOffice()
    {
        return Office::find($this->office_id);
    }


    /**
     * Get the Position associated with the Designation.
     * @return Position
     */
    public function getPosition()
    {
        return Position::find($this->position_id);
    }
}
