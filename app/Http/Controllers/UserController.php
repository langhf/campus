<?php
namespace App\Http\Controllers;

use App\User;

Class UserController extends Controller
{
    public function api_get($user_id)
    {
        $user = User::where('user_id',$user_id)
                    ->select('name','user_id','tel','created_at')
                    ->get();
        return $user;

    }
}