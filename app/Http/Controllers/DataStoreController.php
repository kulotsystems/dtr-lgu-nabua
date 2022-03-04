<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\LogMode;
use App\Models\Finger;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Office;
use App\Models\Position;
use App\Models\Designation;
use App\Models\Attendance;
use Illuminate\Http\Response;

class DataStoreController extends Controller
{
    /**
     * Store data forwarded by the DTR Fingerprint Client
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $valid_auth = env('APP_KEY');
        $response   = [
            'rows'  => [],
            'error' => ''
        ];

        if(!isset($request['auth']))
            $response['error'] = 'NO \'auth\' PARAMETER SUPPLIED.';
        else {
            if(!password_verify($valid_auth, $request['auth']))
                $response['error'] = 'INVALID \'auth\' PARAMETER.';
            else if(!isset($request['rows']))
                $response['error'] = 'NO \'rows\' PARAMETER SUPPLIED.';
            else if(!is_array($request['rows']))
                $response['error'] = 'INVALID \'rows\' PARAMETER.';
            else {
                $rows_total = sizeof($request['rows']);
                for($i=0; $i<$rows_total; $i++) {
                    $row = $request['rows'][$i];
                    if(isset($row['model']) && isset($row['record'])) {
                        $model  = $row['model'];
                        $record = $row['record'];

                        if(isset($record['id'])) {
                            $id        = intval($record['id']);
                            $db_record = false;
                            $affected  = false;

                            // perform update() or create() operation
                            switch($model) {
                                case 'Attendance' :
                                    $db_record = Attendance::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Attendance::create($record);
                                    break;
                                case 'Designation' :
                                    $db_record = Designation::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Designation::create($record);
                                    break;
                                case 'Position' :
                                    $db_record = Position::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Position::create($record);
                                    break;
                                case 'Office' :
                                    $db_record = Office::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Office::create($record);
                                    break;
                                case 'Fingerprint' :
                                    $db_record = Fingerprint::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Fingerprint::create($record);
                                    break;
                                case 'Employee' :
                                    $db_record = Employee::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Employee::create($record);
                                    break;
                                case 'Finger' :
                                    $db_record = Finger::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : Finger::create($record);
                                    break;
                                case 'LogMode':
                                    $db_record = LogMode::find($id);
                                    $affected  = $db_record ? $db_record->update($record) : LogMode::create($record);
                                    break;
                            }

                            // push $affected data to $response['rows']
                            if($affected) {
                                array_push($response['rows'], [
                                    'model' => $model,
                                    'id'    => $record['id']
                                ]);
                            }
                        }
                    }
                }
            }
        }
        return response($response);
    }
}
