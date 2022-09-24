<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

use Auth;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function getNoti()
    {
        if(Session::has('cc_id')){
            $data = Notification::where('receiver_id' , Auth::guard('user')->user()['id']
                                    )->where('is_read',0)->get();
            
                if(count($data) > 0 ){
                    foreach($data as $d)
                    {
                        $patient_data[] = ['id' => $d->id,'name' => $d->patient->name, 
                                'age' => $d->patient->age,'gender' => $d->patient->gender,
                                'patient_id' => $d->patient_id,'time' => $d->updated_at->diffForHumans()] ;
                    }
                    return Response::json($patient_data);
                }else{
                    return Response::json('no-data');
                }
        }else{
            return Response::json('no-session');
        }
       
    }

    public function readStatus(Request $request)
    {
        try{

            Notification::whereId($request->id)->update(['is_read' => $request->is_read]);
            echo "changed";

        }catch(QueryException $e){
            dd($e->getMessage());
            echo "false";
        }


    }


}
