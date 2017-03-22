<?php 

	class Tool
	{

		protected static $token = 'lampbrother';
		/**
		 * 返回json格式的数据
		 */
		public static function toJson($data)
		{
			return json_encode($data);
		}

		/**
		 * 返回xml的数据
		 */
		public static function toXml($data, $item='xml')
		{
	    	$xml = "<".$item.">";
	    	foreach ($data as $key=>$val)
	    	{
	    		if (is_numeric($val)){
	    			$xml.="<".$key.">".$val."</".$key.">";
	    		}else{
	    			$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
	    		}
	        }
	        $xml.="</".$item.">";
	        return $xml; 
		}

		/**
		 * 返回二维数组的数据
		 */
		public static function toXmlT($data, $item='xml')
		{
			$xml = "<".$item.">";
			foreach ($data as $key => $value) {
				if(is_array($value)){
					$xml .= self::ToXml($value, 'item');
				}else{
	    			$xml.="<".$key."><![CDATA[".$value."]]></".$key.">";
				}
			}
			$xml .= "</".$item.">";
			return $xml;
		}

		/**
		 * 返回二维不规则数据
		 */
		public static function toXmlCom($data)
		{
			$xml = "<xml>";
			foreach ($data as $key => $value) {
				if(is_array($value)){
					$xml .= self::toXmlT($value, $key);
				}else{
					$xml.="<".$key."><![CDATA[".$value."]]></".$key.">";
				}
			}
			$xml .= "</xml>";
			return $xml;
		}

		/**
		 * 向客户端返回信息
		 * @$arr ['code'=>'nb000','msg'=>'ok','data'=>[]];
		 */
		public static function response($code, $msg, $data=[])
		{
			//判断格式
			$format = isset($_GET['format']) ? $_GET['format'] : 'json';
			//拼接数组
			$arr = ['code' => $code, 'msg'=>$msg, 'data'=>$data];
			//根据情况返回不同的结果
			if($format == 'xml'){
				echo self::toXmlCom($arr);die;
			}else{
				echo self::toJson($arr);
			}
			die;
		}

		/**
		 * 检测时间戳是否可用
		 */
		public static function checkTimestamp()
		{
			//如果时间戳为空
			if(empty($_GET['t'])){
				self::response('nb003', 'miss timestamp');
			}

			//如果传递的时间戳跟服务器时间相差大于20秒 证明请求有问题
			if(abs($_GET['t'] - time()) > 20) {
				self::response('nb004', 'timestamp expired');
			}
		}

		/**
		 * 检测签名是否合法
		 */
		public static function checkCommonSignValid()
		{
			//提取签名
			$sign = isset($_GET['sign']) ? $_GET['sign'] : '';
			//检测
			if(empty($sign)) {
				self::response('nb005','sign missing');
			}
			//删除sign参数
			unset($_GET['sign']);
			//
			ksort($_GET);
			$str = self::arrayToUrl($_GET);
			//加密
			$calSign = md5($str.self::$token);
			//
			if($sign !== $calSign) {
				self::response('nb006','sign error');
			}
		}

		/**
		 * 将数组拼接成url参数形式
		 */
		public static function arrayToUrl($arr)
		{
			$str = '';
			foreach ($arr as $key => $value) {
				$str .= $key.'='.$value.'&';
			}
			return trim($str,'&');
		}




	}



 ?>