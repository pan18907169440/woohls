@extends('admin.common.master')
@section('title','信息列表')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('admin.common.menu')
    <aside class="right-side">
        <section class="content-header">
            <h1>
                信息管理
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
                                                @can('/admin/message/addMessage')
                                                <button type="button" class="btn btn-primary editform" data-url="/admin/message/addMessage" title="添加">添加
                                                </button>
                                                @endcan
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batchDelModal">删除
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 search-form">
                                            <form action="#" class="text-right">
                                                <div class="input-group">
                                                    分类：
                                                    <select name="cate_id" class="form-control" style="width: 40%;">
                                                        <option value="0">顶级分类</option>
                                                        @foreach($cate AS $cate)
                                                            <option <?php if(!empty($_GET['cate_id'])) {if($_GET['cate_id'] == $cate->id){echo 'selected';};}  ?> value="{{$cate->id}}">|—&nbsp;&nbsp;{{$cate->name}}</option>
                                                            @foreach($cate->sub AS $sub)
                                                                <option <?php if(!empty($_GET['cate_id'])) {if($_GET['cate_id'] == $sub->id){echo 'selected';};}  ?> value="{{$sub->id}}">&nbsp;&nbsp;|———&nbsp;&nbsp;{{$sub->name}}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>&nbsp;
                                                    <input type="text" name="keyword" class="form-control input-sm" placeholder="Search" value="<?php if(!empty($_GET['keyword'])) {echo $_GET['keyword'];}?>" style="width:30%;">
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
                                                <th>信息名称</th>
                                                <th>信息分类</th>
                                                <th>状态</th>
                                                <th>添加时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data AS $data)
                                                <tr class="unread">
                                                    <td class="small-col">{{$data->id}}</td>
                                                    <td class="small-col"><b>{{$data->title}}</b></td>
                                                    <td class="small-col">{{$data->cate_name}}</td>
                                                    <td class="subject">
                                                        @if($data->status == 1)
                                                            <b style="color:green;">开启</b>
                                                        @else
                                                            <b style="color:red;">关闭</b>
                                                        @endif
                                                    </td>
                                                    <td class="time">{{$data->created_at}}</td>
                                                    <td class="operation">
                                                        @can('/admin/message/messageStatus')
                                                        @if($data->status == 1)
                                                            <a href="javascript:void(0);" data-url="/admin/message/messageStatus/{{$data->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
                                                        @else
                                                            <a href="javascript:void(0);" data-url="/admin/message/messageStatus/{{$data->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
                                                        @endif
                                                        @endcan

                                                        @can('/admin/message/editMessage')
                                                        <a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/message/editMessage/{{$data->id}}" title="编辑"></a>
                                                        @endcan

                                                        @can('/admin/message/deleteMessage')
                                                        <a href="javascript:void(0);" data-url="/admin/message/deleteMessage/{{$data->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
                                                        @endcan

                                                        @can('/admin/message/ToUser')
                                                        <a href="javascript:void(0);" data-url="/admin/message/ToUser/{{$data->id}}" class="fa editform" title="推送">推送</a>
                                                        @endcan
                                                    </td>
                                                </tr>
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
