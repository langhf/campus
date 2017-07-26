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
        $carbon = Carbon::now();
        $date = $carbon->year."-".$carbon->month."-".$carbon->day;

        $infos = pay_info::where('user_id',$user_id)
                            ->where('pay_date',$date)
                            ->get();
        $result = [];

        foreach ($infos as $key => $value) {
            $result += [
                $key => [
                    'user_id' => $value->user_id,
                    'pay_date' => $value->pay_date,
                    'pay_time' => $value->pay_time,
                    'origin_price' => $value->origin_price,
                    'discounted_price' => $value->discounted_price,
                    'off' => $value->off
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
