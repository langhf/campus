<?php

namespace App\Http\Controllers;

use App\work_check;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkCheckController extends Controller
{
    public function all()
    {
        return work_check::all();
    }

    public function api_get($user_id,$query_date=Null)
    {
       if($query_date){
           $result = work_check::where('user_id',$user_id)
               ->where('check_date','>=',$query_date."-1")
               ->where('check_date','<=',$query_date."-31")
               ->select('user_id','address','check_date','check_time')
               ->get();
           return $result;
       }
       else{
           $carbon = Carbon::now();
           $now = $carbon->year."-".$carbon->month."-".$carbon->day;


           $result = work_check::where('user_id',$user_id)
               ->where('check_date','>=',$now)
               ->select('user_id','address','check_date','check_time')
               ->get();
           return $result;
       }

    }

    public function api_post(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required|exists:users,user_id',
            'address' => 'required'
        ]);

        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;
        $time = $carbon->hour.":".$carbon->minute.":".$carbon->second;

        $work = work_check::create([
           'user_id' =>  request('user_id'),
            'address' => request('address'),
            'check_date' => $date,
            'check_time' => $time
        ]);

        if($work) {
            return response()->json(['result' => 'OK'], 200);
        }else{
            return response()->json(['result' => 'NO'],400);
        }
    }
}
