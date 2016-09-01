@extends('admin.common.master')
@section('title','添加分类')
@section('content')
<body class="skin-blue">
    <form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="modal-body">
            <div class="form-group">
                <div class="">
                    <span class="input-group-addon">父级分类</span><br />
                    <select name="pid" id="">
                        <option value="0">顶级分类</option>
                        @foreach($cate AS $cate)
                            <option value="{{$cate->id}}">|—&nbsp;&nbsp;{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">分类名称:</span>
                    <input type="text" name="name" class="form-control"  />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">排序:</span>
                    <input type="text" name="sort" class="form-control"  />
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