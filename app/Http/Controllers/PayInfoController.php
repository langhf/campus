<?php

namespace App\Http\Controllers;

use App\pay_info;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayInfoController extends Controller
{
    public function all()
    {
        return pay_info::all();
    }

    public function api_get($user_id)
    {
        return  pay_info::where('user_id',$user_id)->get();
    }

    public function api_post(Request $request)
    {
        $this->validate($request,[
           'user_id' => 'required|exists:users,user_id',
           'origin_price' => 'required|numeric'
        ]);

        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;
        $time = $carbon->hour.":".$carbon->minute.":".$carbon->second;

        $origin_price = request('origin_price');

        $result = pay_info::create([
           'user_id' => request('user_id'),
           'pay_date' => $date,
           'pay_time' => $time,
           'origin_price' => $origin_price,
            'discounted_price' => 0.8*$origin_price,
            'off' => 0.2*$origin_price
        ]);

        if($result){
            return  response()->json([
                'result' => 'OK'
            ],200);
        }else{
            return  response()->json([
                'result' => 'NO'
            ],400);
        }
    }
}
