<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function home(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'size:174519',
        ]);

        $user = App\User::find(request('user_id'));
        $token = $user->createToken('Campus Personal Access Client')->accessToken;

        $client = new \GuzzleHttp\Client([
            'base_uri' => 'http://learnlaravel.com',
            'timeout' => 2.0,
        ]);

        $door_checks = $client->request('GET','/api/doorchecks',[
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer ".$token
            ]
        ]);

        return $door_checks;
    }
}
