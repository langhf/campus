<?php

namespace App\Http\Controllers;

use App\door_checks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoorChecksController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function all()
    {
        return door_checks::all();
    }

    public function web_get()
    {
        @$query = $_SERVER['QUERY_STRING'];
        @parse_str($query,$querys);
        @$user_id = $querys['user_id'];
        @$rand_num = $querys['rand_num'];
        @$door_number = $querys['door_number'];

        $door = door_checks::where('user_id',@$user_id)
                            ->where('rand_num',@$rand_num)
                            ->get();
        if(count($door)){

            door_checks::where('user_id',@$user_id)
                        ->where('rand_num',$rand_num)
                        ->update(['door_number' => @$door_number]);
            return 1;
        }else{
            return 0;
        }
    }


    public function api_get($user_id,$query_date=Null)
    {
        if($query_date){
            $doors = door_checks::where('user_id',"=",$user_id)
                                ->where('check_date',"<=",$query_date."-31")
                                ->where('check_date',">=",$query_date."-1")
                                ->get();

            $result = [];
            foreach ($doors as $key => $value){
                $result += [
                    $key => [
                        'user_id' => $value->user_id,
                        'check_time' => $value->check_date." ".$value->check_time,
                        'door_number' => $value->door_number
                    ]
                ];
            }

            return $result;
        }
        else{
            $carbon = Carbon::now();
            $date = $carbon->year."-".$carbon->month."-".$carbon->day;

            $doors =  door_checks::where('user_id',$user_id)
                ->where('check_date',$date)
                ->where('door_number','!=','')
                ->get();
            $result = [];

            foreach ($doors as $key => $value){
                $result += [
                    $key => [
                        'user_id' => $value->user_id,
                        'check_time' => $value->check_date." ".$value->check_time,
                        'door_number' => $value->door_number
                    ]
                ];
            }

            return $result;
        }
//        return json_encode((object)$result);
    }

    public function api_post(Request $request)
    {
        $check = new door_checks;

        $this->validate($request,[
           'user_id' => 'required|exists:users,user_id',
            'rand_num' => 'required',
        ]);

        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;
        $time = $carbon->hour.":".$carbon->minute.":".$carbon->second;


        $check->user_id = request('user_id');
        $check->check_date = $date;
        $check->check_time = $time;
        $check->rand_num = request('rand_num');

        if($check->save()){
            return response()->json(['result'=>'OK'],200);
        }else{
            return response()->json(['result'=>'NO'],400);
        }
    }
}
