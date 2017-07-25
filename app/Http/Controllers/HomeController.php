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
        return view('back_admin.home');
//        return view('home');
    }

    public function unchecked()
    {
        $users = App\User::where('is_check', '0')
            ->orderBy('created_at', 'desc')
            ->paginate(1000);
        return view('back_admin.uncheckedusers', ['users' => $users]);
    }

    public function checked()
    {
        $users = App\User::where('is_check', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(1000);
        return view('back_admin.checkedusers', ['users' => $users]);
    }

    public function delete_user()
    {
        App\User::where('user_id', request('user_id'))->delete();
        return redirect(route('uncheckedusers'));
    }

    public function check_user()
    {
        App\User::where('user_id',request('user_id'))->update(['is_check' => '1']);
        return redirect(route('uncheckedusers'));
    }

    public function workchecks()
    {
        $works = App\work_check::where('user_id','174519')
                                ->orderBy('check_date','desc')
                                ->orderBy('check_time','desc')
                                ->paginate(1000);
        return view('back_admin.workchecks',['works' => $works]);
    }

    public function doorchecks()
    {
        $doors = App\door_checks::where('user_id','174519')
                                ->orderBy('check_time','desc')
                                ->paginate(1000);
        return view('back_admin.doorchecks',['doors' => $doors]);
    }

    public function payinfos()
    {
        $payinfos = App\pay_info::where('user_id','174519')
                                ->orderBy('pay_date','desc')
                                ->orderBy('pay_time','desc')
                                ->paginate(1000);
        return view('back_admin.payinfos',['payinfos' => $payinfos]);
    }

//    public function home(Request $request)
//    {
//        $this->validate($request,[
//            'user_id' => 'size:174519',
//        ]);
//
//        $user = App\User::find(request('user_id'));
//        $token = $user->createToken('Campus Personal Access Client')->accessToken;
//
//        $client = new \GuzzleHttp\Client([
//            'base_uri' => 'http://learnlaravel.com',
//            'timeout' => 2.0,
//        ]);
//
//        $door_checks = $client->request('GET','/api/doorchecks',[
//            'headers' => [
//                'Accept' => 'application/json',
//                'Authorization' => "Bearer ".$token
//            ]
//        ]);
//
//        return $door_checks;
//    }
}
