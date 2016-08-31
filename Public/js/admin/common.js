
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