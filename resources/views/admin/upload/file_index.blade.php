@extends('admin.common.master')
@section('title','文件上传')
@section('content')
    <div class="upload-mask">
    </div>
    <div class="panel panel-info upload-file">
        <div class="panel-body">
            <div id="validation-errors"></div>
            <form action="/service/get_fiel" method="post" id="imgForm" enctype="multipart/form-data">
                {!! csrf_field() !!}
            <div class="form-group">
                <input class="text_input" name="file" type="file">
            </div>
            </form>
        </div>
        <div class="panel-footer">
        </div>
    </div>
@endsection
@section('my-js')

    <!-- LayerUi库 -->
    <script type="text/javascript" src="/admin/js/layer/layer.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.confirm.js"></script>
    <!-- 后台JS -->
    <script type="text/javascript" src="/admin/js/layerUi.js"></script>
<script>
    $(function(){
        $('#imgForm input[name=file]').on('change', function(){
            $('form').ajaxSubmit({
                url: "/service/get_fiel",
                type:"POST",
                dataType: 'json',
                data: {_token: "{{ csrf_token() }}"},
                success:function(data) {
                    layer.closeAll('loading');
                    if(data.status==1){
                        var layer_param = top.layer_param;
                        var layer_param2 = top.layer_param2;
                        parent.$("input[name='"+layer_param+"']").val(data.url);
                        parent.$("input[name='"+layer_param2+"']").val(data.id);
                        layer.msg(data.info, {icon:1 , time: 1000 });
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }else{
                        layer.msg(data.info, {icon:2 , time: 1000 });
                    }
                },
            });
            return false;
        });

    });
</script>
@endsection