<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台登录
 * @author 
 *
 */
class LoginController extends Controller {
	//登录视图
    public function index(){
    	$this->display();
    }
    
    //生成验证码
    public function verify(){
    	$config = array(
    		'fontSize'    =>    '32',    // 验证码字体大小    
    		'length'      =>    '4',     // 验证码位数   
    	);
    	$Verify = new \Think\Verify($config);
    	$Verify->entry();
    }
    
    //登录
    public function login(){
    	if(!IS_POST) E('页面不存在');//不是post提交的 抛出错误
    	//判断验证码是否正确
    	$Verify = new \Think\Verify();
    	if(!$Verify->check(I('code'))) {
    		$this->error('验证码错误！');
    	}
    	//判断用户信息是否正确
    	$db = M('user');
    	$user = $db->where(array('name' => I('name')))->find();
    	if(!$user || $user['password'] != I('password', '', 'md5')){
    		$this->error('用户名或密码不正确！');
    	}
    	//用户信息正确后更新用户信息到数据库
    	$data = array(
    			'time' => time(),
    			'ip'   => get_client_ip(),
    			);
    	$db->save($data);
    	//写入session
    	session('uid', $user['id']);
    	session('username', $user['name']);
    	session('logintime',date('Y-m-d H:i:s', time()));
    	session('loginip', get_client_ip());
    	
    	//跳转到后台首页
    	redirect(__MODULE__);
    	
    }
}