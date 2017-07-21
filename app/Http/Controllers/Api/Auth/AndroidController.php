<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;


class AndroidController extends Controller
{
    private $client;

    function __construct()
    {
        $this->client = Client::find(2);
    }


    public function register( Request $request)
    {

        $this->validate($request,[
            'name' => 'bail|required|max:255',
            'user_id' => 'required|string|max:15|unique:users',
            'tel' => 'required|string|size:11|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
           'name' => request('name'),
            'user_id' => request('user_id'),
            'tel' => request('tel'),
            'email' => request('password')."@qq.com",
            'password' => bcrypt('password')
        ]);

        if($user){
            return response()->json(['result'=>'OK'],200);
        }else{
            return response()->json(['result'=>'NO'],400);
        }
    }

    public function login( Request $request)
    {

    //目前只有用私人授权方式才能发放令牌

        $this->validate($request,[
            'user_id' => 'required|exists:users,user_id',
            'password'=> 'required'
        ]);


        $user = User::find(request('user_id'));

        $email = request('password')."@qq.com";


        if($email == $user->email && $user->is_check==1){

            $token = $user->createToken('drealng')->accessToken;
            return $token;

        }
        else{
            return response()->json(['result'=>'NO'],400);
        }
    }

    public function home($user_id)
    {


        $user = User::find($user_id);

        $back_user = [
            'name' => $user->name,
            'user_id' => $user->user_id,
            'tel' => $user->tel,
        ];

        $work_checks = [];
        foreach ($user->work_checks as $key => $value){
            $work_checks += [
                $key => [
                    'user_id' => $value->user_id,
                    'record_date' => $value->record_date,
                    'start_time' => $value->start_time,
                    'end_time' => $value->end_time,
                    'total_time' => $value->total_time
                ],
            ];
        }

        $door_checks = [];
        foreach ($user->door_checks as $key => $value){
            $door_checks += [
                $key => [
                    'user_id' => $value->user_id,
                    'check_time' => $value->check_time,
                    'door_number' => $value->door_number
                ]
            ];
        }

        $pay_infos = [];
        foreach ($user->pay_infos as $key => $value){
            $pay_infos += [
                $key => [
                    'user_id' => $value->user_id,
                    'pay_date' => $value->pay_date,
                    'pay_time' => $value->pay_time,
                    'origin_price' => $value->origin_price,
                    'discounted_price' => $value->discounted_price,
                    'off' => $value->off
                ],
            ];
        }

        $home = [];
        $home['user'] = $back_user;
        $home['pay_infos'] = $pay_infos;
        $home['door_checks'] = $door_checks;
        $home['work_checks'] = $work_checks;
        return $home;

    }

    public function logout(Request $request)
    {
                $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update(['revoked'=>true]);
        $accessToken->revoke();

        return response()->json([],204);
    }
}



