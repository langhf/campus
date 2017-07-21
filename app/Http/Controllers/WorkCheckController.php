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
        return work_check::where('user_id',$user_id)->get();
    }

    public function api_post(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required|exists:users,user_id',
        ]);

        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;
        $time = $carbon->hour.":".$carbon->minute.":".$carbon->second;

        $work = work_check::create([
           'user_id' =>  request('user_id'),
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