@extends('admin.common.master')
@section('title','历史信息列表')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('admin.common.menu')
    <aside class="right-side">
        <section class="content-header">
            <h1>
                历史信息列表
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
                                        <div class="col-sm-6 search-form" style="width: 100%;">
                                            <form action="#" class="text-right">
                                                <div class="input-group" style="width: 100%;">
                                                    <input name="startdate" class="form-control input-sm Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php if(!empty($_GET['startdate'])) {echo $_GET['startdate'];}?>" style="width:20%;"/>
                                                    至
                                                    <input name="enddate" class="form-control input-sm Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php if(!empty($_GET['enddate'])) {echo $_GET['enddate'];}?>" style="width:20%;"/>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <select name="status" class="form-control" style="width: 10%;">
                                                        <option value="">所有</option>
                                                        <option <?php if(!empty($_GET['status'])) {if($_GET['status'] == 1){echo 'selected';};}  ?> value="1">已查看</option>
                                                        <option <?php if(!empty($_GET['status'])) {if($_GET['status'] == 2){echo 'selected';};}  ?> value="2">未查看</option>
                                                    </select>&nbsp;
                                                    <input type="text" name="keyword" class="form-control input-sm" placeholder="Search" value="<?php if(!empty($_GET['keyword'])) {echo $_GET['keyword'];}?>" style="width:30%;">
                                                    <div class="input-group-btn">
                                                        <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="mailbox row">
                                        <div class="col-xs-12">
                                            <div class="box box-solid">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-4" style="border: 1px solid #ddd;">
                                                            <div style="margin-top: 15px;" class="can">
                                                                <ul class="nav nav-pills nav-stacked">
                                                                    @foreach($data AS $data)
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                            @can('/admin/message/messageRoleHistoryRead')
                                                                            <li class="message" data-email-id="{{$data->email_id}}">
                                                                            <a  style="text-decoration:underline" href="javascript:void(0);">
                                                                                @if($data->step == 2) <i class="fa fa-envelope-o"></i>@endif
                                                                                {{$data->email_id}}、{{$data->title}}

                                                                            </a>
                                                                            </li>
                                                                            @endcan
                                                                        </td>
                                                                        </tr>
                                                                        @if(!empty($data->file_id))
                                                                        <tr>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <ul>
                                                                                            @foreach($data->file_id AS $file)
                                                                                                <li>{{$file['file_id']}}
                                                                                                    <a href="{{$file['url']}}">
                                                                                                        <i class="fa fa-paperclip"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                       </tr>
                                                                        @endif
                                                                    </table>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9 col-sm-8">
                                                            <div class="table-responsive" style="border: 1px solid #ddd;padding:10px;">
                                                                <table class="table table-mailbox">
                                                                    <tbody>
                                                                    <tr class="unread">
                                                                        <div id="message_body">
                                                                            <div class="message_body_ajax">
                                                                                @if(!empty($message->message_body))
                                                                                <p>{!! $message->message_body !!}</p>
                                                                                 @endif
                                                                            </div>
                                                                        </div>
                                                                    </tr>
                                                                    </tbody></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<script>
    $(document).on("click",".message",function(){
        var email_id = $(this).attr('data-email-id');
        //加载缓冲层
        var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
       $.ajax({
           type: "post",
           url: "/admin/message/messageRoleHistoryRead/"+email_id,
           data: {_token: "{{ csrf_token() }}"},
           dataType: 'json',
           success: function(data){
               //关闭所有加载层
               layer.closeAll();
               console.log(data);
               $(".message_body_ajax").remove();
               var html = "<div class='message_body_ajax'>"+data.info+"</div>";
               document.getElementById("message_body").innerHTML=html;
           }
       });
    });
</script>

@endsection
