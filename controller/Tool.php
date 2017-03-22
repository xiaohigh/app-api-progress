<?php 

	class Tool
	{
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
		public static function toXmlT($data)
		{
			$xml = "<xml>";
			foreach ($data as $key => $value) {
				$xml .= self::ToXml($value, 'item');
			}
			$xml .= "</xml>";
			return $xml;
		}


	}



 ?>