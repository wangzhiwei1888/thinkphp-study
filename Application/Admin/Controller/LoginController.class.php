<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
    	if(session('adminUser')){

    		$this->redirect('/demo/index.php?m=admin&c=index');
    		// $this->redirect('/demo/admin.php?c=index');
    	}
    	
    	return $this->display();
    }

    public function check(){

    	// echo 'check_success';
    	// print_r($_POST);
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	if(!trim($username)){

    		// echo 'username为空'; exit;

    		return show(0,'用户名不能为空');
    	}

    	if(!trim($password)){

    		// echo 'username为空'; exit;

    		return show(0,'密码不能为空');
    	}

    	$ret = D('Admin')->getAdminByUserName($username);

    	if(!$ret){

    		return show(0,'用户名不存在');
    	}
    	// print_r($ret);


    	if($ret['password'] != getMd5Password($password))
    	{

    		return show(0,'密码错误');
    	}
    	session('adminUser',$ret);
    	return show(1,'登录成功',$ret);

    }

    public function loginout(){

    	session('adminUser',null);
    	$this->redirect('/demo/index.php?m=admin&c=login');
    	// $this->redirect('/demo/admin.php?c=login');
    }

}