<?php 

	class LoginController 
	{
		public function login()
		{
			//获取用户名和密码
			$username = $_GET['username'];
			$password = $_GET['password'];

			//读取数据库
			$res = DB::table('users')->where("username = '$username' and password='$password'")->get();

			//判断
			if(empty($res)){
				Tool::response('nb007','username or password wrong!');
			}

			//生成token
			$token = md5($username.time().rand(10000,99999));

			//准备数据
			$data = ['id'=>$res[0]['id'], 'token'=>$token,'updated_at'=>date('Y-m-d H:i:s')];

			//写入数据库
			if(DB::table('users')->update($data)){
				Tool::response('nb000','ok',['token'=>$token,'id'=>$res[0]['id']]);
			}else{
				Tool::response('nb008','fail to update user`s  token');
			}
		}

	}



