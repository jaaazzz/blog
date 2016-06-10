<?php
namespace Admin\Controller;

use Classlib\Category;

/**
 * 博文控制器
 * @author Administrator
 *
 */
class BlogController extends CommonController {
	//博文列表视图
	public function index(){
		//分页
		$count = M('blog')->where(array('del' => 0))->count();
		$page = new \Think\Page($count, 15);
		$limit = $page->firstRow.','.$page->listRows;
		$this->page = $page->show();
		
		$this->blog = D('blog')->where(array('del' => 0))->limit($limit)->relation(true)->select();
		
		$this->display();
	}
	
	//添加博文视图
	public function addBlog(){
		$cate = M('category')->order('sort ASC')->select();
		$this->cate = Category::unlimitForLevel($cate);
		$this->attr = M('attr')->select();
		$this->display();
	}
	
	//添加博文提交表单处理
	public function runAddBlog(){
		$data= array(
				'title' => $_POST['title'],
				'summary' => I('summary', '', 'strip_tags'),
				'content' => I('content'),
				'time' => time(),
				'click' => (int)$_POST['click'],
				'cid' => (int)$_POST['cid'],
				);
		if(isset($_POST['aid'])){
			foreach ($_POST['aid'] as $v){
				$data['attr'][] = $v;
			}
		}
		if(empty($data['summary'])){
			$data['summary'] = mb_substr(strip_tags($_POST['content']), 0, 200);
		}
		
		
		$blog = D('Blog');
		if($blog->relation(true)->add($data)){
			$this->success('添加成功！', U(MODULE_NAME.'/Blog/index'));
		} else {
			$this->error('添加失败！');
		}
	}
	
	//删除/还原到回收站
	public function toTrash(){
		$type = $_GET['type'];
		$msg = $type ? '删除' : '还原';
		if(M('blog')->where(array('id' => I('id')))->setField('del', $type)){
			$this->success($msg.'成功！');
		} else {
			$this->error($msg.'失败！');
		}
	}
	
	//彻底删除
	public function delete(){
		if(D('blog')->relation('attr')->delete($_GET['id'])){
			$this->success('彻底删除成功！');
		} else {
			$this->error('彻底删除失败！');
		}
	}
	
	//回收站视图
	public function trash(){
		$this->blog = D('blog')->where(array('del' => 1))->relation(true)->select();
		$this->display('index');
	}
	
	//清空回收站
	public function emptyTrash(){
		if(D('blog')->where(array('del' => 1))->relation('attr')->delete()){
			$this->success('清空回收站成功！');
		} else {
			$this->error('清空回收站失败！');
		}
		$this->display('index');
	}

}