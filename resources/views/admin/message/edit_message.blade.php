@extends('admin.common.master')
@section('title','编辑信息')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="">
                <span class="input-group-addon">信息分类</span><br />
                <select name="cate_id" id="">
                        @foreach($cate AS $cate)
                            <option <?php if($message->cate_id == $cate->id){echo 'selected';} ?> value="{{$cate->id}}">|—&nbsp;&nbsp;{{$cate->name}}</option>
                            @if(!empty($cate->sub))
                                @foreach($cate->sub AS $sub)
                                    <option <?php if($message->cate_id == $sub->id){echo 'selected';} ?> value="{{$sub->id}}">&nbsp;&nbsp;|—&nbsp;&nbsp;{{$sub->name}}</option>
                                @endforeach
                            @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">信息标题:</span>
                <input type="text" name="title" class="form-control" value="{{$message->title}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">信息内容:</span>
                <textarea class="form-control" id="body" name="body" style="width:100%;height:300px;">{{$message->body}}</textarea>
            </div>
        </div>
        <input type="button" class="get_open" style="padding:4px 15px;" value="+">
        @foreach($message->file_url AS $key=>$file)
        <div class="form-group">
            <div class="input-group" style="width:100%;">
                <input type="text" class="form-control text_input" name="file_url[{{$key}}]" style="width:50%;" value="{{$file['url']}}">&nbsp;
                <input type="text" class="form-control text_input" name="file_id[{{$key}}]" value="{{$file['file_id']}}" style="width:40%;">
                <input type="button" class="upload-image" data-value="file_url[{{$key}}]" data-id="file_id[{{$key}}]" style="padding:4px 15px;" value="上传">
                <input type="button" class="get_close" style="padding:4px 15px;" value="Ｘ" data-close="{{$key}}">
                <p class="help-block">最大50M</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="modal-footer clearfix">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>保存</button>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>取消</button>
    </div>
</form>
@endsection
@section('my-js')
    <!-- 百度编辑器 -->
    <link rel="stylesheet" type="text/css" href="/admin/js/plugins/ueditor/themes/default/css/ueditor.css">
    <script type="text/javascript" src="/admin/js/plugins/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/js/plugins/ueditor/ueditor.all.js"></script>
    <script type="text/javascript">
        //实例化编辑器
        UE.getEditor('body');
    </script>
    <!-- 百度编辑器 -->
<script type="text/javascript">
    $(function(){
        $("#form").validate({
            debug: false,
            rules: {
                title: {required: true,},
                body: {required: true},
            },
            messages: {
                title: {required: '请输入信息标题',},
                body: {required: '请输入信息内容',},
            },
            submitHandler: function (form) {
                commonAjaxSubmit();
                return false;
            }
        });
        var num = $('.modal-body .form-group').length - 4;
        console.log(num);
        $(".get_open").click(function(){
            var indexNum = ++num;
            var html = "<div class='form-group'>"+
                    "<div class='input-group' style='width:100%;'>"+
                    "<input type='text' class='form-control text_input' name='file_url["+indexNum+"]' style='width:50%;'>&nbsp;"+
                    "<input type='text' class='form-control text_input' name='file_id["+indexNum+"]' style='width:40%;'>"+
                    "<input type='button' class='upload-image' data-value='file_url["+indexNum+"]' data-id='file_id["+indexNum+"]' style='padding:4px 15px;' value='上传'>"+
                    "<input type='button' class='get_close' style='padding:4px 15px;' value='Ｘ' data-close='"+indexNum+"'>"+
                    "<p class='help-block'>最大50M</p></div></div>";

            $(html).appendTo(".modal-body");
        });


        $(document).on('click','.get_close',function(){
            var close_num =parseInt($(this).attr('data-close')) + 3;
            console.log(close_num);
            $(".modal-body .form-group:eq("+close_num+")").remove();
        });
    });
</script>
@endsection
