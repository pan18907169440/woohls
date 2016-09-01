@extends('admin.common.master')
@section('title','编辑菜单')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="">
                <span class="input-group-addon">权限菜单</span><br />
                <select name="pid" id="">
                    <option value="0">顶级菜单</option>
                        @foreach($role AS $role)
                            <option <?php if($permission->parent_id == $role->id){echo 'selected';} ?> value="{{$role->id}}">{{$role->display_name}}</option>
                            @if(!empty($role->sub))
                                @foreach($role->sub AS $sub)
                                    <option <?php if($permission->parent_id == $sub->id){echo 'selected';} ?> value="{{$sub->id}}">&nbsp;&nbsp;|—&nbsp;&nbsp;{{$sub->display_name}}</option>
                                @endforeach
                            @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">菜单名称:</span>
                <input type="text" name="display_name" class="form-control" value="{{$permission->display_name}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">菜单URL:</span>
                <input type="text" name="name" class="form-control" value="{{$permission->name}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">图标样式:</span>
                <input type="text" name="icon" class="form-control" value="{{$permission->icon}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">排序:</span>
                <input type="text" name="sort" class="form-control" value="{{$permission->sort}}"/>
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
                display_name: {required: true,},
                name: {required: true},
                sort: {required: true},
            },
            messages: {
                display_name: {required: '请输入菜单名称',},
                name: {required: '请输入菜单URL',},
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
