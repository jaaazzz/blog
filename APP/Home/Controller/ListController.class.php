<?php
namespace Home\Controller;
use classlib\category;

class ListController extends CommonController {
    public function index(){
   		$id = (int)$_GET['id'];
         
   		$cate = M('category')->order('sort')->select();
   		$cids = Category::getChildsId($cate, $id);
   		$cids[] = $id;
   		$where = array('cid' => array('IN', $cids));
   		$count = M('blog')->where($where)->count();
   		$page = new \Think\Page($count, 10);
   		$limit = $page->firstRow.','.$page->listRows;
   		$this->page = $page->show();
   		$this->blog = D('BlogView')->getAll($where, $limit);
   		//p($this->blog);
   		$this->display();
    }
}