<?php
namespace Admin\Controller;

use Classlib\Category;

/**
 * 后台首页控制器
 * @author Administrator
 *
 */
class CategoryController extends CommonController {
	//分类列表视图
    public function index(){
    	$cate = M('category')->order('sort ASC')->select();
    	$cate = Category::unlimitForLevel($cate, '--');
    	$this->assign('cate', $cate)->display();
    }
   
    //添加分类视图
    public function addCate(){
    	$pid = I('pid', 0, 'intval');
    	$this->assign('pid', $pid)->display();
    }
    
    //添加分类表单处理
    public function runAddCate(){
    	$name = trim(I('name'));
		if(empty($name)) {
			$this->error('名称不能为空！');
		}
    	
    	$db = M('category');
    	if($db->create()){
    		if($db->add()){
    			$this->success('添加成功！', U(MODULE_NAME.'/Category/index'));
    		} else {
    			$this->error('添加失败！');
    			
    		}
    		
    	}
    }
    
    //删除分类
    public function deleteCate(){
    	if(M('category')->where(array('id' => I('id')))->delete()){
    		$this->success('删除成功！', U(MODULE_NAME.'/Category/index'));
    	} else {
    		$this->error('删除失败！');	 
    	}
    }
    
    //修改排序
    public function runSortCate(){
    	$db = M('category');
    	foreach($_POST as $id => $sort){
    		$db->where(array('id' => $id))->setField('sort', $sort);
    	}
    	
    	$this->redirect(MODULE_NAME.'/Category/index');
    }
}