@extends('admin.common.master')
@section('title','推送信息')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">信息标题:</span>
                <div class="form-control">{{$message->title}}</div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group" style="height: 300px;">
                <span class="input-group-addon">信息内容:</span>
                <div class="form-control" style="position:absolute;height:300px;width:90%;overflow:auto;">{!! $message->body !!}</div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">推送方式:</span>&nbsp;
                <input class="form-control" type="radio" name="push" value="1">&nbsp;邮件推送&nbsp;
                <input class="form-control"type="radio" name="push" value="2">&nbsp;消息推送&nbsp;
            </div>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-mailbox table-bordered table-striped">
            <thead>
            <tr>
                <th>选择</th>
                <th>ID</th>
                <th>用户姓名</th>
                <th>用户email</th>
                <th>推送状态</th>
                <th>推送时间</th>
                <th>查看状态</th>
                <th>查看时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data AS $data)
                <tr>
                    <td class="small-col"><input type="checkbox"
                                                 @if(!empty($data->message_status))
                                                         checked
                                                 @endif
                                                 name="user[]" value="{{$data->id}},{{$data->email}}"></td>
                    <td class="small-col">{{$data->id}}</td>
                    <td class="small-col">{{$data->nickname}}</td>
                    <td class="small-col">{{$data->email}}</td>
                    <td class="small-col">
                        @if($data->message_status == 1)
                            <b style="color:green;">已推送</b>
                        @else
                            <b style="color:red;">未推送</b>
                        @endif
                    </td>
                    <td class="small-col">{{$data->message_created_at}}</td>
                    <td class="small-col">
                        @if($data->message_step == 1)
                            <b style="color:green;">已查看</b>
                        @else
                            <b style="color:red;">未查看</b>
                        @endif
                    </td>
                    <td class="small-col">{{$data->message_updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer clearfix">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>保存</button>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>取消</button>
    </div>
</form>
@endsection
@section('my-js')

<script type="text/javascript">
    $(function(){
        $("#form").validate({
            debug: false,
            rules: {
                title: {required: true,},
                body: {required: true},
                push: {required: true},
            },
            messages: {
                title: {required: '请输入信息标题',},
                body: {required: '请输入信息内容',},
                push: {required: '选择',},
            },
            submitHandler: function (form) {
                commonAjaxSubmit();
                return false;
            }
        });
    });
</script>
@endsection
