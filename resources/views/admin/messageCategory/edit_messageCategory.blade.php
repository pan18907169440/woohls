@extends('admin.common.master')
@section('title','编辑分类')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="">
                <span class="input-group-addon">顶级分类</span><br />
                <select name="cate_id" id="">
                    <option value="0">顶级分类</option>
                        @foreach($cate AS $cate)
                            <option <?php if($message_cate->pid == $cate->id){echo 'selected';} ?> value="{{$cate->id}}">|—&nbsp;&nbsp;{{$cate->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">分类名称:</span>
                <input type="text" name="name" class="form-control" value="{{$message_cate->name}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">排序:</span>
                <input type="text" name="sort" class="form-control" value="{{$message_cate->sort}}"/>
            </div>
        </div>

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
                name: {required: true,},
                srot: {required: true},
            },
            messages: {
                name: {required: '请输入分类名称',},
                srot: {required: '请输入排序',},
            },
            submitHandler: function (form) {
                commonAjaxSubmit();
                return false;
            }
        });
    });
</script>
@endsection
