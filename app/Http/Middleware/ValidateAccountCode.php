<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Account;

class ValidateAccountCode
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'year'  => ['int', 'required', 'min:2021', 'max:2099'],
            'month' => ['int', 'required', 'min:1', 'max:12']
        ]);

        if(!session()->has('dtr-lgu-nabua-account-code')) {
            return response([
                'error' => 'PLEASE LOGIN FIRST'
            ]);
        }
        else {
            $login = Account::authenticateByCode(session('dtr-lgu-nabua-account-code'));
            if($login['error'])
                return response(['error' => $login['error']]);
            else {
                session(['dtr-lgu-nabua-employee' => $login['success']]);
            }
        }

        return $next($request);
    }
}
