<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class ContentController extends CommonController {

   
   public function index(){
        
        $title = $_GET['title'];
        $conds = array();
        if($title){

            $conds['title'] = $title;
        }

        if($_GET['catid']){

            $conds['catid'] = intval($_GET['catid']);
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 1;

        

        $news = D('News')->getNews($conds,$page,$pageSize);
        $count = D('News')->getNewsCount($conds);

        $res = new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);
        $this->assign('news',$news);


        $webSiteMenu = D('Menu')->getBarMenus();
        $this->assign('webSiteMenu',$webSiteMenu);
        

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

    		$newsId = D('News')->insert($_POST);

    		if($newsId){

    			$newsContentData['content'] = $_POST['content'];
    			$newsContentData['news_id'] = $newsId;
    			
                $cId = D('NewsContent')->insert($newsContentData);

                if($cId){

                    return show(1,'新增成功');
                }
                else{

                    return show(1,'主表插入成功,辅表插入失败');

                }
    		}else{

                return show(0,'新增失败');
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

    public function edit(){

        $newsId = $_GET['id'];
        if(!$newsId){

            $this->redirect('/demo/admin.php?c=content');
        }
        $news = D('News')->find($newsId);

        if(!$news){

            $this->redirect('/demo/admin.php?c=content');
        }

        $newsContent = D('NewsContent')->find($newsId);
        if($newsContent){

            $news['content'] = $newsContent['content'];
        }

        $webSiteMenu = D('Menu')->getBarMenus();
        $this->assign('webSiteMenu',$webSiteMenu);
        $this->assign('titleFontColor',C('TITLE_FONT_COLOR'));
        $this->assign('copyFrom',C('COPY_FROM'));

        $this->assign('news',$news);
        print_r($news);
        $this->display();
    }




}