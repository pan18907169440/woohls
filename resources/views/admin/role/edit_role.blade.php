@extends('admin.common.master')
@section('title','编辑菜单')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="">
                <span class="input-group-addon">权限组</span><br />
                <select name="pid" id="">
                    <option value="0">顶级分组</option>
                    @foreach($role AS $role)
                        <option <?php if($data->parent_id == $role->id){echo 'selected';} ?> value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">权限组名称:</span>
                <input type="text" name="name" class="form-control" value="{{$data->name}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">权限组描述:</span>
                <input type="text" name="deccription" class="form-control" value="{{$data->deccription}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">排序:</span>
                <input type="text" name="sort" class="form-control" value="{{$data->sort}}"/>
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
                    deccription: {required: true},
                    sort: {required: true},
                },
                messages: {
                    name: {required: '请输入权限组名称',},
                    deccription: {required: '请输入权限组描述',},
                    sort: {required: '请输入排序',},
                },
                submitHandler: function (form) {
                    commonAjaxSubmit();
                    return false;
                }
            });
        });
    </script>
@endsection
