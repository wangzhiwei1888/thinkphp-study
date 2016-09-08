<?php
namespace Common\Model;
use Think\Model;

class NewsContentModel extends Model{

	private $_db = '';

	public function __construct(){

		$this->_db = M('news_content');
	}
	public function insert ($data=array()){

		if(!$data || !is_array($data)){

			return 0;
		}
		$data['create_time'] = time();
		return $this->_db->add($data);
	}

	public function find ($id){

		return $this->_db->where('news_id='.$id)->find();
		
	}
}
