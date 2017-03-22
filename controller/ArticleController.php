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
			var_dump($res);
		}

	}


 ?>