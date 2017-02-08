<?php
/**
 * 实战 PHP 23种设计模式
 * @version ${Id}$
 * @author Shaowei Pu <pushaowei@sporte.cn>
 */
class DesignPattern
{
	/**
	 * [$_dir_array 私有数组便利全目录]
	 * @var [type]
	 */
	public $_dir_array;
	/**
	 * [__construct 初始化]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2017-02-07T14:57:16+0800
	 */
	public function __construct()
	{
		//$this->_dir_array = scandir(dirname(__FILE__));
	}
	/**
	 * [tree Dir ]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2017-02-07T14:10:17+0800
	 * @param                               [type] $directory [description]
	 * @return                              [type]            [description]
	 */
	public function tree( $directory ) 
	{ 
		$mydir = opendir($directory); 
		while( false !== ( $file = readdir($mydir) ) )
		{ 
			if( $file != '.' && $file != '..' ){
				if( is_dir("$directory/$file") )
				{
					$this->_dir_array[$directory][$file] = $file;
		 			$this->tree("$directory/$file"); 
				}
					$this->_dir_array[$directory][$file] = $file;
			}
		} 
		closedir($mydir); 
	} 

	public  function  classify()
	{
		return [
			'创建型' => [
					'info' 	 => 'Singleton',
					'intro'  => '单例模式',
					'action' => '?d=Singleton',
				],
			'结构型' => [
					'info' 	 => 'bridge',
					'intro'  => '桥接模式',
					'action' => 'c',
				],
			'行为型' => [
					'info'	 => 'template', 
					'intro'  => '模版模式',
					'action' => 'c',
			]

		];
	}
}
/**
 * 引导牌 
 */
$dir 	= isset($_GET['d']) ? $_GET['d'].'\\'.'index' : '';
$action = isset($_GET['a']) ? $_GET['a'] 	  : '';
if (!empty( $dir ) && !empty($action))
{
	/**
	 * SPL 自动装载
	 */
	spl_autoload_register( function( $class ) {
		include str_replace('\\', '/', $class).'.php';
	}); 
	/**
	 * 实例类
	 */
	$import = new $dir;
	$import->$action();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<head>
	<title> 完整实战PHP23种设计模式</title>
<style type="text/css">
.GitHub {background: url(//cdn.bootcss.com/logos/0.2.0/github-octocat.svg) no-repeat #fff; -webkit-background-size: 90%; -moz-background-size: 90%; background-size: 90%; background-position: 50% 100%; width: 37px; height: 37px; border-radius: 50%; margin: 0 2px 6px; vertical-align: middle; font-size: 24.42px; line-height: 37px; text-align: center; } </style>
</head>
<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
<body>
<div class="col-lg-4 col-lg-offset-4  col-sm-6 col-sm-offset-3 col-xs-8 " >
<div class="list-group">
    <b href="javascript:;" class="list-group-item active">
        <h2 class="list-group-item-heading">
            完整实战 PHP 23种设计模式
    	     <a class="badge pull-right GitHub" href="https://github.com/PuShaoWei" target="_blank" title="GitHub" > </a>
        </h2>
    </b>
  <?php foreach ((new DesignPattern)->classify() as $key => $value):?>
		    <a  href="javascript:;" class="list-group-item list">
		    	<span class="badge "><?=$key?></span>
			        <h4 class="list-group-item-heading" action=<?=$value['action']?>>
			            <?=$value['info'];?>
			        </h4>
			        <p class="list-group-item-text">
			            <?=$value['intro'];?>
			        </p>
		    </a>
	<?php endforeach;?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
/**
 * [点击驱动]
 * @author 		Shaowei Pu <pushaowei@sporte.cn>
 * @CreateTime	2017-02-07T18:52:54+0800
 * @param                               {[type]} ) {	var        cookie [description]
 * @return                              {[type]}   [description]
 */
$(document).ready(function()
{  
  $(".list-group .list").click(function(){  
  	$.ajax({
  		type: 'get',
  		url : '?d=Singleton&a=start',
  	})
 });
});
</script>














