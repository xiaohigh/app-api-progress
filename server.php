<?php
	
	//自动加载函数
	function __autoload($tableName) {
		if(file_exists('./controller/'.$tableName.'.php')) {
			include './controller/'.$tableName.'.php';
		}else if('./db/'.$tableName.'.php') {
			include './db/'.$tableName.'.php';
		}
	}

	//获取参数
	$c = isset($_GET['c']) ? $_GET['c'] : 'index';
	$a = isset($_GET['a']) ? $_GET['a'] : 'index';

	//拼接类名
	$cname = ucfirst($c).'Controller';

	//实例化对象
	$obj = new $cname;

	//调用方法
	$res = $obj->$a();
