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

    public function api_get($user_id,$query_date=Null)
    {
        if($query_date){
            $results = pay_info::where('user_id',$user_id)
                ->where('pay_date','>=',$query_date."-1")
                ->where('pay_date',"<=",$query_date."-31")
                ->select('user_id','pay_date','pay_time','origin_price','discounted_price','off','shop')
                ->get();

            return $results;
        }
        else{
            $carbon = Carbon::now();
            $now = $carbon->year."-".$carbon->month."-".$carbon->day;

            $results = pay_info::where('user_id',$user_id)
                ->where('pay_date','>=',$now)
                ->select('user_id','pay_date','pay_time','origin_price','discounted_price','off','shop')
                ->get();

            $total_origin = $total_discounted = $total_off = 0;

            foreach ($results as $temp){
                $total_origin += $temp->origin_price;
                $total_discounted += $temp->discounted_price;
                $total_off += $temp->off;
            }

            $total = [
                'total_origin' => $total_origin,
                'total_discounted' => $total_discounted,
                'total_off' => $total_off
            ];

            $result = [
                'total' => $total,
                'description' => $results
            ];

            return $result;
        }
    }

    public function api_post(Request $request)
    {
        $this->validate($request,[
           'user_id' => 'required|exists:users,user_id',
           'origin_price' => 'required|numeric',
            'shop' => 'required'
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
            'off' => 0.2*$origin_price,
            'shop' => request('shop')
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
