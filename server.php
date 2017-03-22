<?php
	
	//引入文件
	include './controller/ArticleController.php';
	include './db/db.php';

	$arc = new ArticleController;

	$arc->list();
