<?php 


	class UserController
	{
		/**
		 * 获取用户的信息
		 */
		public function info()
		{
			// 获取id参数
			$id = isset($_GET['uid']) ? $_GET['uid'] : 0;
			//
			if(empty($id)) {
				self::response('nb009','id missing');
			}

			//读取用户信息
			$res = DB::table('users')->first($id);

			//返回数据
			Tool::response('nb000','ok',$res);
		}
	}


 ?>