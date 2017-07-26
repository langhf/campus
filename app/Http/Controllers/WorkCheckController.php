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

    public function api_get($user_id)
    {
        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;

        $works = work_check::where('user_id',$user_id)
                            ->where('check_date',$date)
                            ->get();
        $result = [];
        foreach ($works as $key => $value){
            $result += [
                $key => [
                   'user_id' => $value->user_id,
                    'address' => $value->address,
                    'check_date' => $value->check_date,
                    'check_time' => $value->check_time
                ]
            ];
        }

        return $result;
//        return json_encode((object)$result);
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
