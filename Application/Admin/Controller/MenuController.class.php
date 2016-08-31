<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class MenuController extends CommonController {

    public function index(){
    	
        $data = array();

        if(isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0,1))){

            $data['type'] = intval($_REQUEST['type']);

            $this->assign('type',$data['type']);
        }
        else{
            $this->assign('type',-1);   
        }

        
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;

        $menus = D('Menu')->getMenus($data,$page,$pageSize);
        // print_r($menus);
        $menusCount = D('Menu')->getMenusCount($data);

        $res = new \Think\Page($menusCount,$pageSize);
        $pageRes = $res->show();
        $this->assign('pageRes',$pageRes);
        $this->assign('menus',$menus);


    	return $this->display();
    }

    public function add(){

        // print_r($_POST);
        
        if($_POST){

            if(!isset($_POST['name']) || !$_POST['name']){

                return show(0,'菜单名称不能为空');
            }
            if(!isset($_POST['m']) || !$_POST['m']){

                return show(0,'模块名称不能为空');
            }
            if(!isset($_POST['f']) || !$_POST['f']){

                return show(0,'方法名称不能为空');
            }
            
            $menuId = D('Menu')->insert($_POST);

            if($menuId){

                return show(1,'新增成功',$menuId);
            }
            
            return show(0,'新增失败',$menuId);

            // print_r($_POST);

        }else{

            return $this->display();    
        }
        
    }    

}