<?php
namespace Home\Controller;
use Classlib\Category;

class ShowController extends CommonController {
    public function index(){
    	$id = $_GET['id'];
    	$field = array('id', 'title', 'time', 'click', 'content', 'cid','children');
    	$blogDb = M('blog');
    	$this->blog = $blogDb->field($field)->find($id);
        //find类似于select，只是find只返回一条数据而且传参为主键过滤；
    	$blogDb->where(array('id' => $id))->setInc('click');
        
        $commentdb=M('blog');
        $this->comment=$commentdb->where(array('children'=>$id))->field('content,time')->select();
    	
    	$cid = $this->blog['cid'];
    	$cate = M('category')->order('sort')->select();
    	$this->parent = Category::getParents($cate, $cid);
    	$this->count = count($this->parent) - 1;
    	$this->display();
    }
    
    public function click(){
    	$id = $_GET['id'];
    	$blogDb = M('blog');
    	$blogDb->where(array('id' => $id))->setInc('click');
    	$click = $blogDb->where(array('id' => $id))->getField('click');
    	echo $click;
    }
}