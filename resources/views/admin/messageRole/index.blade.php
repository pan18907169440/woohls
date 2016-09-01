@extends('admin.common.master')
@section('title','信息发送记录')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
    @include('admin.common.menu')
    <aside class="right-side">
        <section class="content-header">
            <h1>
                信息发送记录
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
                                                                    <table class='table table-mailbox'>
                                                                        <tbody>
                                                                    @foreach($data AS $data)

                                                                        <tr class="unread">
                                                                            <td>
                                                                            <li class="message" data-email-id="{{$data->email_id}}">
                                                                                @can('/admin/message/messageRole')
                                                                                    <a  style="text-decoration:underline" href="javascript:void(0);">
                                                                                        {{$data->email_id}}、{{$data->title}}
                                                                                    </a>
                                                                                @endcan
                                                                            </li>
                                                                            </td>
                                                                            <td>
                                                                                {{$data->created_at}}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9 col-sm-8">
                                                            <div class="table-responsive" style="border: 1px solid #ddd;padding:10px;">
                                                                <div id="message_body">
                                                                    <div class="message_body_ajax">
                                                                        <tr class="unread">
                                                                            <p>请选择信息！</p>
                                                                        </tr>
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
        $.ajax({
            type: "post",
            url: "/admin/message/messageRole/"+email_id,
            data: {_token: "{{ csrf_token() }}"},
            dataType: 'json',
            success: function(data){
                console.log(data);
                $(".message_body_ajax").remove()
                var obj = eval(data.info);
                var count = data.info.length;
                var html = '';
                html +="<div class='message_body_ajax'>";
                html +="<table class='table table-mailbox'><tbody>";
                html +="<tr class='unread'><td style='font-weight: 100'>用户</td><td style='font-weight: 100'>查看状态</td><td style='font-weight: 100'>查看时间</td></tr>";
                //"+obj[i].id+"'
                for(var i = 0;i<count;i++){

                    html +="<tr class='unread'>";
                    html +="<td>"+obj[i].nickname+"</td>";
                    if(obj[i].step == 1){
                        html +="<td style='color:green;'>已查看</td>";
                    }else{
                        html +="<td style='color:red;'>未查看</td>";
                    }
                    html +="<td>"+obj[i].updated_at+"</td>";
                    html +="</tr>";
                }
                html +="</tbody></table>";
                html +="</div>";


                document.getElementById("message_body").innerHTML=html;
            }
        });
    });
</script>
@endsection
