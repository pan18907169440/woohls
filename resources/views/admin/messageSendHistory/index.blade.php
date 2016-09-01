@extends('admin.common.master')
@section('title','邮件发送记录')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('admin.common.menu')
    <aside class="right-side">
        <section class="content-header">
            <h1>
                邮件发送记录
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
                                        <div class="col-sm-6 search-form">
                                            <form action="#" class="text-right">
                                                <div class="input-group">
                                                    <input name="startdate" class="form-control input-sm Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" value="<?php if(!empty($_GET['startdate'])) {echo $_GET['startdate'];}?>" style="width:30%;"/>
                                                    至
                                                    <input name="enddate" class="form-control input-sm Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" value="<?php if(!empty($_GET['enddate'])) {echo $_GET['enddate'];}?>" style="width:30%;"/>
                                                    &nbsp;
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
                                                <th>发送email</th>
                                                <th>邮件标题</th>
                                                <th>添加时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data AS $data)
                                                <tr class="unread">
                                                    <td class="small-col">{{$data->id}}</td>
                                                    <td class="small-col"><b>{{$data->user_email}}</b></td>
                                                    <td class="small-col"><b>
                                                    @can('/admin/message/messageInfo')
                                                        <a  style="text-decoration:underline" href="javascript:void(0);" data-url="/admin/message/messageInfo/{{$data->email_id}}" class="fa editform" title="{{$data->message_title}}">{{$data->message_title}}</a>
                                                    @endcan</b></td>
                                                    <td class="time">{{$data->created_at}}</td>
                                                    <td class="operation">
                                                        @can('/admin/message/deleteMessageSendHistory')
                                                        <a href="javascript:void(0);" data-url="/admin/message/deleteMessageSendHistory/{{$data->id}}" class="fa fa-trash-o ajaxRequest" title="删除"></a>
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
<script type="text/javascript" src="/admin/js/My97DatePicker/WdatePicker.js"></script>
@endsection
