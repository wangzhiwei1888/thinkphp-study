var login = {

	check:function(){

		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		// alert(username);

		// if(!username){

		// 	dialog.error('用户名不能为空')
		// }

		// if(!password){

		// 	dialog.error('密码不能为空')
		// }

		var url = '/demo/index.php?m=admin&c=login&a=check';
		// var url = '/demo/admin.php?c=login&a=check';
		var data = {'username':username,'password':password};
		$.post(url,data,function(resp){
			console.log(resp)
			// alert(resp.status)
			if(resp.status == 0){

				return dialog.error(resp.message);
			}
			else{

				// return dialog.success('登录成功','/demo/admin.php?c=index');
				return dialog.success('登录成功','/demo/index.php?m=admin&c=index');
			}
			// console.log(data);

		},'json')

	}
}