
$('#button-add').on('click',function(){


	var url = SCOPE.add_url;

	window.location.href = url;
})


$("#singcms-button-submit").on('click',function(){

	var data = $("#singcms-form").serializeArray();
	var postData = {};
	$(data).each(function(i){

		postData[this.name] = this.value;

	})

	console.log(data);

	var url = SCOPE.save_url;
	var jump_url = SCOPE.jump_url;
	$.post(url,postData,function(resp){

		if(resp.status == 1){

			//成功
			return dialog.success(resp.message,jump_url);
		}
		else{

			//失败
			return dialog.error(resp.message);
		}


	},'JSON')
})


$('.singcms-delete').on('click',function(){

	var id = $(this).attr('attr-id');
	// var a = $(this).attr('attr-a');
	var message = $(this).attr('attr-message');

	var url = SCOPE.set_status_url;

	var data = {};

	data['id'] = id;
	data['status'] = -1;

	layer.open({
		type:0,
		title:'是否提交？',
		btn:['yes','no'],
		icon:3,
		closeBtn:2,
		content:'是否确定'+ message,
		scrollbar:true,
		yes:function(){

			todelete(url,data);
		}

	})

	function todelete(url,data){

		$.post(url,data,function(s){

			if(s.status == 1){

				return dialog.success(s.message,'');

			}else{

				return dialog.error(s.message);
			}
		},"JSON")
	}
})

$('.singcms-edit').on('click',function(){

	var id = $(this).attr('attr-id');
	var url = SCOPE.edit_url+'&id='+id;

	window.location.href = url;


})



$("#button-listorder").on('click',function(){

	var data = $("#singcms-listorder").serializeArray();
	var postData = {};
	$(data).each(function(i){

		postData[this.name] = this.value;

	})

	console.log(data);

	var url = SCOPE.listorder_url;
	// var jump_url = SCOPE.jump_url;
	$.post(url,postData,function(resp){

		if(resp.status == 1){

			//成功
			return dialog.success(resp.message,resp['data']['jump_url']);
		}
		else{

			//失败
			return dialog.error(resp.message,resp['data']['jump_url']);
		}


	},'JSON')
})


$('.singcms-on-off').on('click',function(){

	var id = $(this).attr('attr-id');
	var status = $(this).attr('attr-status');
	var url = SCOPE.set_status_url;

	var data ={};
	data['id'] = id;
	data['status'] = status;

	layer.open({
		type:0,
		title:'是否提交？',
		btn:['yes','no'],
		icon:3,
		closeBtn:2,
		content:'是否确定更改状态',
		scrollbar:true,
		yes:function(){

			todelete(url,data);
		}

	})

	function todelete(url,data){

		$.post(url,data,function(s){

			if(s.status == 1){

				return dialog.success(s.message,'');

			}else{

				return dialog.error(s.message);
			}
		},"JSON")
	}
})




