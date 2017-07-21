@extends('layouts.app')

@section('content')
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"--}}
          {{--integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}

    <ul class="nav nav-list">
        <li class="nav-header">管理</li>
        <li class="active"><a href="#">用户信息</a></li>
        <li class="active"><a href="#">消费信息</a></li>
        <li class="active"><a href="#">打卡信息</a></li>
        <li class="active"><a href="#">门禁信息</a></li>

        <li class="nav-header">个人</li>
        <li class="active"><a href="#">个人信息</a></li>


    </ul>

@endsection
