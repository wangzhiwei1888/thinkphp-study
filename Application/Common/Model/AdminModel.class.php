<?php
namespace Common\Model;
use Think\Model;

class AdminModel extends Model{

	private $_db = '';

	public function __construct(){

		$this->_db = M('admin');
	}
	public function getAdminByUserName($username){

		$ret = $this->_db->where('username="'.$username.'"')->find();
		return $ret;

	}
}
