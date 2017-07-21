<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_id', 'tel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $primaryKey = 'user_id';

    public function pay_infos()
    {
        return $this->hasMany('App\pay_info', 'user_id', 'user_id');
    }

    public function door_checks()
    {
        return $this->hasMany('App\door_checks','user_id','user_id');
    }

    public function work_checks(){
        return $this->hasMany('App\work_check','user_id','user_id');
    }
}
