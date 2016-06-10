<?php
namespace Admin\Controller;

/**
 * 后台首页控制器
 * @author Administrator
 *
 */
class IndexController extends CommonController {
	//首页视图
    public function index(){
    	$this->display();
    }
    //退出登录
    public function logout(){
    	session(null);
    	$this->redirect(MODULE_NAME.'/Login/index');
    }
}