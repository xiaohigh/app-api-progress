<?php
	
	//引入文件
	include './db/db.php';

	//自动加载函数
	function __autoload($tableName) {
		if(file_exists('./controller/'.$tableName.'.php')) {
			include './controller/'.$tableName.'.php';
		}
	}

	$arc = new ArticleController;

	$arc->list();
