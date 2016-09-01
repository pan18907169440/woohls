@extends('admin.common.master')
@section('title','分类列表')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('admin.common.menu')
    <aside class="right-side">
        <section class="content-header">
            <h1>
                分类管理
            </h1>
        </section>
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
                                                @can('/admin/message/addMessageCategory')
                                                <button type="button" class="btn btn-primary editform" data-url="/admin/message/addMessageCategory" title="添加">添加
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
                                                <th>分类名称</th>
                                                <th>状态</th>
                                                <th>添加时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data AS $data)
                                                <tr class="unread">
                                                    <td class="small-col">{{$data->id}}</td>
                                                    <td class="small-col"><b>{{$data->name}}</b></td>
                                                    <td class="subject">
                                                        @if($data->status == 1)
                                                            <b style="color:green;">开启</b>
                                                        @else
                                                            <b style="color:red;">关闭</b>
                                                        @endif
                                                    </td>
                                                    <td class="time">{{$data->created_at}}</td>
                                                    <td class="operation">
                                                        @can('/admin/message/messageCategoryStatus')
                                                        @if($data->status == 1)
                                                            <a href="javascript:void(0);" data-url="/admin/message/messageCategoryStatus/{{$data->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
                                                        @else
                                                            <a href="javascript:void(0);" data-url="/admin/message/messageCategoryStatus/{{$data->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
                                                        @endif
                                                        @endcan

                                                        @can('/admin/message/editMessageCategory')
                                                        <a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/message/editMessageCategory/{{$data->id}}" title="编辑"></a>
                                                        @endcan

                                                        @can('/admin/message/deleteMessageCategory')
                                                        <a href="javascript:void(0);" data-url="/admin/message/deleteMessageCategory/{{$data->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @if(!empty($data->sub))
                                                @foreach($data->sub AS $sub)
                                                    <tr class="unread">
                                                        <td class="small-col">{{$sub->id}}</td>
                                                        <td class="small-col">&nbsp;&nbsp;|—&nbsp;&nbsp;<b>{{$sub->name}}</b></td>
                                                        <td class="subject">
                                                            @if($sub->status == 1)
                                                                <b style="color:green;">开启</b>
                                                            @else
                                                                <b style="color:red;">关闭</b>
                                                            @endif
                                                        </td>
                                                        <td class="time">{{$sub->created_at}}</td>
                                                        <td class="operation">
                                                            @can('/admin/message/messageCategoryStatus')
                                                                @if($sub->status == 1)
                                                                    <a href="javascript:void(0);" data-url="/admin/message/messageCategoryStatus/{{$sub->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
                                                                @else
                                                                    <a href="javascript:void(0);" data-url="/admin/message/messageCategoryStatus/{{$sub->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
                                                                @endif
                                                            @endcan

                                                            @can('/admin/message/editMessageCategory')
                                                                <a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/message/editMessageCategory/{{$sub->id}}" title="编辑"></a>
                                                            @endcan

                                                            @can('/admin/message/deleteMessageCategory')
                                                                <a href="javascript:void(0);" data-url="/admin/message/deleteMessageCategory/{{$sub->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
