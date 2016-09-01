@extends('admin.common.master')
@section('title','权限组列表')
@section('content')
    <body class="skin-blue">
    @include('admin.common.login')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        @include('admin.common.menu')
        <aside class="right-side">
            <section class="content invoice">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary container">
                            <div class="box-body">
                                <div class="row">
                                    <div class="">
                                        <div class="row pad">
                                            <div class="col-sm-6">
                                                <div class="btn-group">
                                                    @can('/admin/role/addRole')
                                                    <button type="button" class="btn btn-primary editform" data-url="/admin/role/addRole" title="添加">添加
                                                    </button>
                                                    @endcan
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batchDelModal">删除
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 search-form">
                                                <form action="#" class="text-right">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" placeholder="Search">
                                                        <div class="input-group-btn">
                                                            <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-mailbox table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>权限组名称</th>
                                                    <th>权限组描述</th>
                                                    <th>状态</th>
                                                    <th>添加时间</th>
                                                    <th>排序</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data AS $data)
                                                    <tr class="unread" style="font-weight: 600;">
                                                        <td class="small-col">{{$data->id}}</td>
                                                        <td class="name">{{$data->name}}</td>
                                                        <td class="small-col">{{$data->deccription}}</td>
                                                        <td class="subject">
                                                            @if($data->status == 1)
                                                                <b style="color:green;">开启</b>
                                                            @else
                                                                <b style="color:red;">关闭</b>
                                                            @endif</td>
                                                        <td class="time">{{$data->created_at}}</td>
                                                        <td class="time">{{$data->sort}}</td>
                                                        <td class="operation">
                                                            @can('/admin/role/roleStatus')
                                                            @if($data->status == 1)
                                                                <a href="javascript:void(0);" data-url="/admin/role/roleStatus/{{$data->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
                                                            @else
                                                                <a href="javascript:void(0);" data-url="/admin/role/roleStatus/{{$data->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
                                                            @endif
                                                            @endcan

                                                            @can('/admin/role/editRole')
                                                            <a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/role/editRole/{{$data->id}}" title="编辑"></a>
                                                            @endcan

                                                            @can('/admin/role/deleteRole')
                                                            <a href="javascript:void(0);" data-url="/admin/role/deleteRole/{{$data->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                    @foreach($data->sub AS $sub)
                                                        <tr class="unread">
                                                            <td class="small-col">{{$sub->id}}</td>
                                                            <td class="name">&nbsp;&nbsp;&nbsp;|—&nbsp;&nbsp;{{$sub->name}}</td>
                                                            <td class="small-col">{{$sub->deccription}}</td>
                                                            <td class="subject">
                                                                @if($sub->status == 1)
                                                                    <b style="color:green;">开启</b>
                                                                @else
                                                                    <b style="color:red;">关闭</b>
                                                                @endif
                                                            </td>
                                                            <td class="time">{{$sub->created_at}}</td>
                                                            <td class="time">{{$sub->sort}}</td>
                                                            <td class="operation">
                                                                @can('/admin/role/roleStatus')
                                                                @if($sub->status == 1)
                                                                    <a href="javascript:void(0);" data-url="/admin/role/roleStatus/{{$sub->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
                                                                @else
                                                                    <a href="javascript:void(0);" data-url="/admin/role/roleStatus/{{$sub->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
                                                                @endif
                                                                @endcan

                                                                @can('/admin/role/editRole')
                                                                <a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/role/editRole/{{$sub->id}}" title="编辑"></a>
                                                                @endcan

                                                                @can('/admin/role/toPermission')
                                                                <a href="javascript:void(0);" class="fa fa-wrench editform" data-url="/admin/role/toPermission/{{$sub->id}}" title="授权"></a>
                                                                @endcan

                                                                @can('/admin/role/deleteRole')
                                                                <a href="javascript:void(0);" data-url="/admin/role/deleteRole/{{$sub->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <div class="pull-right">
                                    {{$page}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
@endsection
@section('my-js')

@endsection