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

    public function api_get($user_id)
    {
        return door_checks::where('user_id',$user_id)->get();
    }

    public function api_post(Request $request)
    {
        $check = new door_checks;

        $this->validate($request,[
           'user_id' => 'required|exists:users,user_id',
            'door_number' => 'required',
        ]);

        $check->user_id = request('user_id');
        $check->check_time = Carbon::now();
        $check->door_number = request('door_number');

        if($check->save()){
            return response()->json(['result'=>'OK'],200);
        }else{
            return response()->json(['result'=>'NO'],400);
        }
    }
}
