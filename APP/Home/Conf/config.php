<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING' => array(
			'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/'.MODULE_NAME.'/View/Public'
	),
	
	
	// 开启路由
	'URL_MODEL' => 2,
	 'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES' => array(
			'/^list-(\d+)$/' => 'Home/List/index?id=:1',
			'/^show-(\d+)$/' => 'Home/Show/index?id=:1',
	),
		
	'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	'HTML_CACHE_RULES'  =>    array(  // 定义静态缓存规则
			'Show:index' => array('{:module}_{:action}_{id}', 0),
		)
	
);