$(function(){

	/**
	 * 公用重定向跳转
	 */
	$(document).on('click','.redirect',function(){
		top.layer.closeAll();
		location.href = $(this).attr('data-url');
		return false;
	});
	/**
	 * 公用ajax post提交
	 */
	$(document).on('click','.ajaxSubmit',function(){
		// var objData = (obj == '') ? $('#formData') : $(obj);
		var url = (typeof($(this).attr('data-url')) == 'undefined') ? document.URL : $(this).attr('data-url');
		commonAjaxSubmit(url);
		return false;
	});
	
	/**
	 * 公用ajax get请求
	 */
	$(document).on('click','.ajaxRequest',function(){
		var url = $(this).attr('data-url');
		if (url=="" || url==undefined || url==null) {
			return false;
		}
		var title = $(this).attr('title');
		var message = '您确定要 '+title+' 吗？';
		commonAjaxRequest(url, message);
		return false;
	});

	//添加表单弹出层
	$(document).on('click', '.addform, .editform', function(){
		var webBodyWidth = ((window.screen.width) * 2) / 3 + 'px';	//屏幕分辨率的宽
		var webBodyHight = ((window.screen.height) * 2) / 3 + 'px';	//屏幕分辨率的高
		var url = $(this).attr('data-url'); 					//跳转链接
		var title = $(this).attr('title'); 						//弹出层标题
		top.layer.open({
			type: 2,
			title: title,
			shadeClose: true,
			maxmin: true, //开启最大化最小化按钮
			area: [webBodyWidth, webBodyHight],
			skin: 'layui-layer-rim',
			content: url,
		});
	});	
	//删除确认
	$(".delete").click(function(){
		var url = $(this).attr('data-url');
		commonAjaxRequest(url);
	});
	/*
   */
	var layer_param = '';
	// 选择素材
	$(document).on('click','.choose-image',function(){

		top.layer_param = $(this).attr('value');

		var webBodyWidth = (window.screen.availWidth ) / 2 + 'px';
		var webBodyHight = (window.screen.availHeight) / 2 + 'px';
		layer.open({
			type: 2,
			title: '素材列表',
			shadeClose: true,
			maxmin: true, //开启最大化最小化按钮
			area: [webBodyWidth, webBodyHight],
			skin: 'layui-layer-rim',
			content: "/index.php/Admin/Image/index.html",
		});
	});

	// 点击上传按钮时，打开相应的文件选择框
	$(document).on('click','.upload-image',function(){
		top.layer_param = $(this).attr('data-value');
		top.layer_param2 = $(this).attr('data-id');

		var webBodyWidth = (window.screen.availWidth ) / 2 + 'px';
		var webBodyHight = (window.screen.availHeight) / 2 + 'px';
		layer.open({
			type: 2,
			title: '上传素材',
			shadeClose: true,
			maxmin: true, //开启最大化最小化按钮
			area: [webBodyWidth, webBodyHight],
			skin: 'layui-layer-rim',
			content: "/service/file_index",
		});
	});
	// 预览图片
	$(document).on('click','.preview-image',function(){
		var url = $("input[name='"+$(this).attr('value')+"']").val();
		if (url=='' || url==null || url==undefined) {
			return false;
		}
		top.layer.open({
			type: 1, 
			area: 'auto',
			title:'',
			closeBtn: false,
			scrollbar:false,
			shadeClose:true,
			content: '<img src="'+url+'" width="100%" height="100%">',
		});
	});
	
	$(document).on('click','.checkbox-input',function(){
		var name = $(this).attr('name');
		var is_select = $("input[name='"+name+"']").is(':checked')
		if (!is_select) {
			$(".button").removeAttr("disabled","disabled");
			$(".checkbox-post").removeProp('checked').val("");
			$(".allbutton").attr("disabled","disabled");
		}else{
			getCheckAll($("#tab tbody input[type='checkbox']:checked"));
			$(".button").attr("disabled", true);
			$(".checkbox-post").prop("checked",true);
			$(".allbutton").removeAttr("disabled");
		}
	});
	$(".img-thumb").click(function(){
	    var url = $(this).attr('src');
	    if (url=='' || url==null || url==undefined) {
	        return false;
	    }
	    top.layer.open({
	        type: 1, 
	        area: 'auto',
	        title:'',
	        closeBtn: false,
	        scrollbar:false,
	        shadeClose:true,
	        content: '<img src="'+url+'" width="100%" height="100%">',
	    });
	});
});

//重写alert
function alertmsg(msg){
	layer.msg(msg);
}

/**
 * 通用AJAX提交
 * @param  {string} url    表单提交地址
 * @param  {string} formObj    待提交的表单对象或ID
 */
function commonAjaxSubmit(url,formObj){
	if(!formObj||formObj==''){
		var formObj = "form";
	}
	if(!url||url==''){
		var url=document.URL;
	}

	$(formObj).ajaxSubmit({
		url:url,
		type:"POST",
		beforeSubmit: function(){
			top.layer.load(); //loading层
		},
		success:function(data) {
			console.log(data)
			if(data.status==1){
			    top.layer.msg(data.info, {icon:1 , time: 2000 });
			}else{
			    top.layer.msg(data.info, {icon:2 , time: 2000 });
			}

			top.layer.closeAll('loading');
			if(data.url&&data.url!=''){
				setTimeout(function(){
					top.window.location.href=data.url;
				},2000);
			}
			if(data.status==1 && data.url==''){
				setTimeout(function(){
					top.window.location.reload();
				},1000);
			}
		},
		error : function() {
			top.layer.closeAll('loading');
			top.layer.msg("异常！");
		}
   });
   return false;
}

/**
 * 通用ajax请求接口
 * @param  {string} url    数据删除地址
 */
function commonAjaxRequest(url, message){
	if (message=='') { var message = "您确定要执行该操作吗？"};
	top.layer.confirm('是否执行?', {skin: 'layui-layer-lan',icon: 3, title:'温馨提示' ,content:message}, function(index){
		top.layer.close(index);
		$.ajax({
			type: 'GET',
			url: url ,
			dataType: 'json',
			beforeSend: function(){
				top.layer.load(); //loading层
			},
			success: function(data){
				console.log(data)
				
				if(data.status==1){
					top.layer.msg(data.info, {icon:1 , time: 2000 });
				}else{
					top.layer.msg(data.info, {icon:2 , time: 2000 });
				}
				if(data.url&&data.url!=''){
					setTimeout(function(){
						top.window.location.href=data.url;
					},2000);
				}
				if(data.status==1 && data.url==''){
					setTimeout(function(){
						top.window.location.reload();
					},1000);
				}
			},
			error : function() {
				top.layer.msg("异常！");
			},
			complete : function(){
				top.layer.closeAll('loading');
			}
		});
	});
	return false;
}

function checkAll(name){
	var el = document.getElementsByTagName('input');
	var len = el.length;
	for(var i=0; i<len; i++){
		if((el[i].type=="checkbox") && (el[i].name==name)){
			el[i].checked = true;
		}
	}
	getCheckAll($("#tab tbody input[type='checkbox']:checked"));
	$(".button").attr("disabled", true);
	$(".checkbox-post").prop("checked",true);
	$(".allbutton").removeAttr("disabled");
}

function clearAll(name){
	var el = document.getElementsByTagName('input');
	var len = el.length;
	for(var i=0; i<len; i++){
		if((el[i].type=="checkbox") && (el[i].name==name)){
			el[i].checked = false;
		}
	}
	$(".button").removeAttr("disabled","disabled");
	$(".checkbox-post").removeProp('checked').val("");
	$(".allbutton").attr("disabled","disabled");
}

function getCheckAll(elm){
	var checkedVal = "";
	elm.each(function(index, el) {
		checkedVal += $(this).val()+",";
	});
	$(".checkbox-post").val(checkedVal);
}

function bindShow(radio_bind, selectors){
	$(radio_bind).click(function(){
		$(selectors).toggleClass('hidden');
	})
}

/**
 * [newRemind 标题闪烁]
 * @param  {[type]} pageTitle  [原页面的标题]
 * @param  {[type]} showRemind [闪烁时显示的东东：如【新提醒】]
 * @param  {[type]} hideRemind [闪烁时隐藏的东东：如【　　　】]
 * @param  {[type]} time       [闪烁间隔的时间]
 */
function newRemind(pageTitle, showRemind, hideRemind, time) {
	if (newRemindFlag == 1) {
		document.title = showRemind + pageTitle;
		newRemindFlag = 2;
	} else {
		document.title = hideRemind + pageTitle;
		newRemindFlag = 1;
	}

	setTimeout("newRemind('" + pageTitle + "','" + showRemind + "','" + hideRemind + "'," + time + ")", time);
}

