<?php
namespace Home\Controller;
use Classlib\Category;

class IndexController extends CommonController {
    public function index(){
    	if(!$list =S('index_list')){
    		$cateDb = M('category');
    		$list = $cateDb->where(array('pid' => 0))->order('sort')->select();
    		 
    		$cate = $cateDb->order('sort')->select();
    		
    		$blogDb = M('blog');
    		$field = array('id', 'title', 'time');
    		foreach($list as $k => $v){
    			$cids = Category::getChildsId($cate, $v['id']);
    			$cids[] = $v['id'];
    			$where = array('cid' => array('IN', $cids));
    			$list[$k]['blog'] = $blogDb->field($field)->where($where)->order('time DESC')->limit(10)->select();
    		}
    		S('index_list', $list, 10);
    	}
    	
    	$this->cate = $list;
    	$this->display();
    }
}