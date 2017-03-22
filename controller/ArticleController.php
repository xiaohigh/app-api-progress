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
			//返回结果
			if(empty($res)) {
				Tool::response('nb001', 'empty data', $res);
			}else{
				Tool::response('nb000', 'ok', $res);
			}
		}

		/**
		 * 获取文章的详情
		 */
		public function detail()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			//判断
			if(empty($id)) {
				Tool::response('nb002', 'miss id param');
			}
			//查询结果
			$res = DB::table('k36s')->first($id);
			//判断
			if(empty($res)){
				Tool::response('nb001', 'empty data', $res);
			}else{
				Tool::response('nb000', 'ok', $res);
			}
		}

	}


 ?>