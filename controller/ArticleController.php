<?php 

	class ArticleController
	{
		/**
		 * 获取文章列表
		 */
		public function list()
		{
			//根据参数进行处理
			$res = DB::table('k36s')->select('id, title, img')->limit(10)->get();
			//判断返回
			$format = isset($_GET['format']) ? $_GET['format'] : 'json';
			switch ($format) {
				case 'xml':
					echo Tool::toXmlT($res);					
					break;
				
				default:
					echo Tool::toJson($res);					
					break;
			}			
			die;
		}

	}


 ?>