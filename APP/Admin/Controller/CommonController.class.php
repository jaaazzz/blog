<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 判断登录状态
 * @author 
 *
 */
class CommonController extends Controller {
	public function _initialize(){
		//判断有无登录
		if(!isset($_SESSION['username'])){
			$this->redirect(MODULE_NAME.'/Login/index');
		}
	}
}