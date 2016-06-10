<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/blog/App/Home/View/Public/Css/common.css" />
	<script type="text/JavaScript" src='/blog/App/Home/View/Public/Js/jquery-1.7.2.min.js'></script>
    <script type="text/JavaScript" src='/blog/App/Home/View/Public/Js/common.js'></script>
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shCore.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushJScript.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushPhp.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushJava.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushCSharp.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushCpp.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushAS3.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushPython.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushVb.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushSql.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushXml.js"></script> 
    <script type="text/javascript" src="/blog/App/Home/View/Public/Js/syntaxhighlighter/scripts/shBrushPlain.js"></script> 
    <!--所使用的SyntaxHighlighter样式--> 
    <link type="text/css" rel="stylesheet" href="/blog/App/Home/View/Public/Js/syntaxhighlighter/styles/shCoreEclipse.css"/> 
    <!--初始化SyntaxHighlighter的必须代码，必须放在head中，引入文件之后--> 
    <script type="text/javascript">SyntaxHighlighter.all();</script> 
    <!--用于消除右上角的广告--> 
    <script type="text/javascript">SyntaxHighlighter.defaults['toolbar'] = false;</script> 
	<link rel="stylesheet" href="/blog/App/Home/View/Public/Css/show.css" />
</head>
<body>



	<div class='top-search-wrap' style="background-image:url('/blog/App/Home/View/Public/Images/logo.gif')">
		<div class='top-search' >
			<div class='search-wrap'>
				<form action="<?php echo U(MODULE_NAME.'/Search/search');?>" method='get'>
					<input type="text" name='keyword' class='search-content'/>
					<input type="submit" name='search' value='搜索'/>
				</form>
			</div>
		</div>
	</div>


	<div class='top-nav-wrap'>
		<ul class='nav-lv1'>
			<li class='nav-lv1-li'>
				<a href="/blog/" class='top-cate'>首页</a>
			</li>
			
			<?php if(is_array($nav_cate)): foreach($nav_cate as $key=>$v): ?><li class='nav-lv1-li'>
				<a href="<?php echo U('/list-'.$v['id']);?>" class='top-cate'><?php echo ($v["name"]); ?></a>
				<?php if($v['child']): ?><ul>
					<?php if(is_array($v["child"])): foreach($v["child"] as $key=>$val): ?><li><a href="<?php echo U('/list-'.$val['id']);?>"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul><?php endif; ?>
			</li><?php endforeach; endif; ?>
		</ul>
	</div>

<!--主体-->
	<div class='main'>
		<div class='main-left'>
			<div class='location'>
				<a href="/blog">首页</a>>
				<?php if(is_array($parent)): foreach($parent as $key=>$v): ?><a href="<?php echo U('/list-'.$v['id']);?>"><?php echo ($v["name"]); ?></a><?php if($key != $count): ?>&gt;<?php endif; endforeach; endif; ?>
			</div>
			<div class="title">
				<p><?php echo ($blog["title"]); ?></p>
				<div>
					<span class='fl'>发布于：<?php echo (date('Y年m月d日', $blog["time"])); ?></span>
					<span class='fr'>已被阅读<?php echo ($blog["click"]); ?>次</span>
					<!--
					<span class='fr' id="js_click" data-url="<?php echo U(MODULE_NAME.'/Show/click', array('id' => $blog['id']));?>">已被阅读<strong class="click_num"></strong>次</span>
					-->
				</div>
			</div>
			<div class='content'>
				<?php echo (htmlspecialchars_decode($blog["content"])); ?>
			</div>
		</div>
        <div class='comment'>
            <div class='comment_list'>
                <p><?php echo ($comment[0]['content']); ?></p>
            </div>
            <div class='comment_add'>
                <form action="" method='post'>
					<textarea rows="4" cols="50" name="comment_content">
请在此处输入评论...</textarea>
					<input type="submit" name='comment' value='评论'/>
				</form>
            </div>
        </div>
	<!--主体右侧-->
		<div class='main-right'>
			<dl>
				<dt>热门博文</dt>
				<?php if(is_array($hot_blog)): foreach($hot_blog as $key=>$v): ?><dd>
					<a href="<?php echo U('/show-'.$v['id']);?>"><?php echo ($v["title"]); ?></a>
					<span>(<?php echo ($v["click"]); ?>)</span>
				</dd><?php endforeach; endif; ?>
			</dl>

			<dl>
				<dt>最发布发</dt>
				<?php if(is_array($new_blog)): foreach($new_blog as $key=>$v): ?><dd>
					<a href="<?php echo U('/show-'.$v['id']);?>"><?php echo ($v["title"]); ?></a>
					<span>(<?php echo (date('m-d', $v["time"])); ?>)</span>
				</dd><?php endforeach; endif; ?>
			</dl>

			<dl>
				<dt>友情链接</dt>
				<?php if(is_array($links)): foreach($links as $key=>$v): ?><dd>
					<a href="<?php echo ($v["url"]); ?>" target="_blank"><?php echo ($v["name"]); ?></a>
				</dd><?php endforeach; endif; ?>
			</dl>
		</div>
	
	</div>


<!--�ײ�-->
<!--div class='bottom'-->
	<div>
		<div></div>
	</div>
</body>
</html>