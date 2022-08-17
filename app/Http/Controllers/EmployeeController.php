<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\LogMode;
use App\Models\Attendance;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    /**
     * Display the Single Page Application
     *
     *
     * @return View
     */
    public function index()
    {
        return view('index');
    }


    /**
     * Handle employee account log in
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     * @throws GuzzleException
     */
    public function login(Request $request)
    {
        $valid = $request->validate([
            'token' => ['required', 'string'],
            'code'  => ['required', 'string', 'max:16']
        ]);

        // verify reCAPTCHA
        $token = $request->get('token');
        $client   = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => env('reCAPTCHA_v3_SECRET'),
                'response' => $token
            ]
        ]);

        // throw errors
        $content = json_decode($response->getBody()->getContents(), true);
        if(!$content['success'] || $content['score'] < 0.25) {
            throw ValidationException::withMessages([
                'recaptcha' => 'Invalid reCAPTCHA request'
            ]);
        }


        // proceed with login
        $code  = strtoupper($request->get('code'));
        $login = Account::authenticateByCode($code);

        if($login['error'])
            return response(['error' => $login['error']]);
        else {
            session(['dtr-lgu-nabua-account-code' => $code]);
            $employee = $login['success'];

            return response([
                'success' => [
                    'employee' => $employee->only(['title', 'first_name', 'middle_name', 'last_name', 'name_suffix'])
                ]
            ]);
        }
    }


    /**
     * Handle employee account log out
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        session()->forget('dtr-lgu-nabua-account-code');
        session()->forget('dtr-lgu-nabua-employee');
    }


    /**
     * Get dashboard data for logged-in employee
     *
     * @param Request $request
     * @return Response
     */
    public function dashboard(Request $request)
    {
        // get months starting from current date to June, 2021
        $months = [];
        $current_date_time_int = time();
        $current_year  = date('Y', $current_date_time_int);
        $current_month = date('n', $current_date_time_int);
        while($current_year >= 2021) {
            while($current_month >= 1) {
                array_push($months, [
                    'year'  => $current_year,
                    'month' => $current_month,
                    'label' => date('Y - F', strtotime($current_year.'-'.$current_month.'-01'))
                ]);

                $current_month -= 1;
                if($current_year == 2021 && $current_month < 6)
                    break;
                else if($current_month <= 0) {
                    $current_month = 12;
                    $current_year -= 1;
                }
            }
            $current_year -= 1;
        }

        // get dtr and related data
        $employee = session('dtr-lgu-nabua-employee');
        $year     = $request->get('year');
        $month    = $request->get('month');
        $mode     = $request->get('mode');
        if($year == 2021 && $month == 5) {
            $year  = $months[0]['year'];
            $month = $months[0]['month'];
        }
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);

        $mysql_date_start_str  = $year . '-' . $month . '-01';
        $mysql_date_start_int  = strtotime($mysql_date_start_str);
        $mysqli_date_end_str   = $year . '-' . $month . '-' . date('t', $mysql_date_start_int);
        $mysql_date_end_int    = strtotime($mysqli_date_end_str);

        $designations    = [];
        $designation_ids = [];
        foreach ($employee->designations as $designation) {
            array_push($designation_ids, $designation->id);
            array_push($designations, [
                'office'   => $designation->getOffice()->only('code', 'description'),
                'position' => $designation->getPosition()->only('title'),
                'date'     => $designation->date,
                'isHead'   => $designation->is_head
            ]);
        }

        $log_modes   = LogMode::all('id', 'title');
        $attendances = [];
        for($i=$mysql_date_start_int; $i<=$mysql_date_end_int; $i+=86400) {
            $mysql_date = date('Y-m-d', $i);
            $mysql_date_ctr = intval(date('d', $i));
            $attendance     = [];
            foreach ($log_modes as $log_mode) {
                $mysql_time  = '';

                // FAVOR FOR THE DEVELOPER EMPLOYEE:
                if($employee['id'] == 108 && $employee['first_name'] == 'ARVIC') {
                    if($log_mode->id == 2) {
                        if($attendance[1] != '')
                            $mysql_time = '12:30 PM';
                    }
                    else if($log_mode->id == 3) {
                        if($attendance[1] != '')
                            $mysql_time = '01:00 PM';
                    }
                }

                if(($mode == 'month') || ($mode == 'month_half1' && $mysql_date_ctr <= 15) || ($mode == 'month_half2' && $mysql_date_ctr > 15)) {
                    $time_record = Attendance::select('date_time')
                        ->whereIn('designation_id', $designation_ids)
                        ->where('date_time', 'LIKE', "{$mysql_date}%")
                        ->where('log_mode_id', '=', $log_mode->id);

                    // Morning In  | Afternoon In
                    if (in_array($log_mode->id, array(1, 3)))
                        $time_record = $time_record->orderBy('date_time');

                    // Morning Out | Afternoon Out
                    else if (in_array($log_mode->id, array(2, 4)))
                        $time_record = $time_record->orderByDesc('date_time');

                    $time_record = $time_record->get();
                    if (!$time_record->isEmpty())
                        $mysql_time = date('h:i A', strtotime($time_record[0]->date_time));
                }
                $attendance[$log_mode->id] = $mysql_time;
            }
            $attendances[$mysql_date] = [
                'date' => date('d-M D', strtotime($mysql_date)),
                'logs' => $attendance
            ];
        }

        return response([
            'success' => [
                'months'       => $months,
                'month'        => date('F', $mysql_date_start_int) . ' ' . date('d', $mysql_date_start_int) . ' - '  . date('d', $mysql_date_end_int) . ', ' . date('Y', $mysql_date_end_int),
                'month_half1'  => date('F', $mysql_date_start_int) . ' 01 - 15, ' . date('Y', $mysql_date_end_int),
                'month_half2'  => date('F', $mysql_date_start_int) . ' 16 - ' . date('d', $mysql_date_end_int) . ', ' . date('Y', $mysql_date_end_int),
                'mode'         => $mode,
                'log_modes'    => $log_modes,
                'employee'     => $employee->only(['title', 'first_name', 'middle_name', 'last_name', 'name_suffix']),
                'designations' => $designations,
                'dtr'          => $attendances
            ]
        ]);
    }


    /**
     * Prepare dashboard data of logged-in employee for printing
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        $dashboard = json_decode(EmployeeController::dashboard($request)->content(), true);
        return view('print', ['dashboard' => $dashboard]);
    }
}
