<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class ContentController extends CommonController {

   
   public function index(){
    	$this->display();
    }

    public function add() {

    	if($_POST){

    		if(!isset($_POST['title']) || !$_POST['title'])
    		{
    			return show(0,'标题不存在');
    		}
    		if(!isset($_POST['small_title']) || !$_POST['small_title'])
    		{
    			return show(0,'短标题不存在');
    		}
    		if(!isset($_POST['catid']) || !$_POST['catid'])
    		{
    			return show(0,'文章栏目不存在');
    		}
    		if(!isset($_POST['keywords']) || !$_POST['keywords'])
    		{
    			return show(0,'关键字不存在');
    		}
    		if(!isset($_POST['content']) || !$_POST['content'])
    		{
    			return show(0,'content不存在');
    		}

    		$newsid = D('News')->insert($_POST);

    		if($newsid){

    			$newsContentData['content'] = $_POST['content'];
    			$newsContentData['news_id'] = $newsId;
    			
    		}

    	}
    	else{

    		$webSiteMenu = D('Menu')->getBarMenus();
	    	$titleFontColor = C('TITLE_FONT_COLOR');
	    	$copyFrom = C('COPY_FROM');

	    	$this->assign('webSiteMenu',$webSiteMenu);
	    	$this->assign('titleFontColor',$titleFontColor);
	    	$this->assign('copyFrom',$copyFrom);

	    	$this->display();
    	}

    	
    }


}