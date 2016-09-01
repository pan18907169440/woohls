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
                @foreach($permission AS $permission)
                    <input type="checkbox"<?php if(in_array($permission->id,$permissionId)){echo 'checked';}?> class="checkbox{{$permission->id}}" id="checkbox{{$permission->id}}" name="roleId[]" onclick="checkbox({{$permission->id}})" value="{{$permission->id}}"
                    ><b>{{$permission->display_name}}</b>
                    <br /><br />
                    @if(!empty($permission->sub))
                        @foreach($permission->sub AS $sub)
                            <span style="padding-left:20px;">|—</span>
                            <input type="checkbox"<?php if(in_array($sub->id,$permissionId)){echo 'checked';}?> class="checkbox{{$sub->id}}" id="checkbox{{$sub->id}}" name="roleId[]" onclick="checkbox({{$sub->id}})" value="{{$sub->id}}"
                            ><b style="color:dodgerblue;font-weight: bold;">{{$sub->display_name}}</b>
                            <br /> <br />
                            @if(!empty($sub->sub2))
                                @foreach($sub->sub2 AS $sub2)
                                    <span style="padding-left:40px;">|—</span>
                                    <input type="checkbox"<?php if(in_array($sub2->id,$permissionId)){echo 'checked';}?> class="checkbox{{$sub2->id}}" id="checkbox{{$sub2->id}}" name="roleId[]" onclick="checkbox({{$sub2->id}})" value="{{$sub2->id}}"
                                    ><b style="color:blue;font-weight: bold;">{{$sub2->display_name}}</b>&nbsp;&nbsp;
                                @endforeach
                                <br /><br />
                            @endif
                        @endforeach
                            <br />
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal-footer clearfix">
        <button type="submit" class="btn btn-primary ajaxSubmit"><i class="fa fa-check"></i>保存</button>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>取消</button>
    </div>
</form>
@endsection
@section('my-js')
@endsection
