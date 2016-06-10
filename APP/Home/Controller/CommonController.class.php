<?php
namespace Home\Controller;
use Think\Controller;
use Classlib\Category;

class CommonController extends Controller {
    public function _initialize(){
    	//头部nav
    	$cate = M('category')->order('sort')->select();
    	$this->nav_cate = Category::unlimitForLayer($cate);
    	
    	//右边栏
    	$blogDb = M('blog');
    	//最热
    	$this->hot_blog = $blogDb->where(array('del' => 0))->order('click DESC')->limit(10)->select();
    	//最新
    	$this->new_blog = $blogDb->where(array('del' => 0))->order('time DESC')->limit(10)->select();
    	//友情链接
    	$this->links = M('links')->field('name, url')->select();
    	
    	
    }
    
   
    
}