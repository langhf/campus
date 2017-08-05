@extends('back_admin.home')

@section('content')


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white user"></i><span class="break"></span>打卡信息</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>

            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">

                    <thead>
                    <tr>
                        {{--<th>用户名</th>--}}
                        <th>姓名</th>
                        <th>学(工)号</th>
                        <th>打卡地点</th>
                        <th>打卡日期</th>
                        <th>打卡时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($works as $work)
                        <tr>
{{--                            <td>{{ $work->user}}</td>--}}
                            <td class="center">{{ \App\User::where("user_id",$work->user_id)->get()[0]->name}}</td>
                            <td class="center">{{ $work->user_id }}</td>
                            <td class="center">{{ $work->address }}</td>
                            <td class="center">{{ $work->check_date }}</td>
                            <td class="center">{{ $work->check_time }}</td>
                            <td class="center">
                                {{--<a class="btn btn-success" href="#">--}}
                                    {{--<i class="halflings-icon white zoom-in"></i>--}}
                                {{--</a>--}}
                                {{--<a class="btn btn-info" href="#">--}}
                                    {{--<i class="halflings-icon white edit"></i>--}}
                                {{--</a>--}}
                                {{--<a class="btn btn-danger" href="#">--}}
                                    {{--<i class="halflings-icon white trash"></i>--}}
                                {{--</a>--}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection



