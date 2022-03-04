<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'dtr_lgu_nabua_accounts';

    protected $fillable = [
        'id',
        'code'
    ];


    /**
     * Authenticate account using code
     * @param string $code - the Account code
     * @return array
     */
    public static function authenticateByCode($code) {
        $response = ['error' => '', 'success' => []];
        $account  = Account::where('code', strtoupper($code))->get();
        if($account->isEmpty())
            $response['error'] = 'INVALID ACCOUNT CODE';
        else
            $response['success'] = Employee::find($account[0]->employee_id);
        return $response;
    }
}
