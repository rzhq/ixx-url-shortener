<?php
/* Solidphp数据库类
 * @package		core_Db
 * @author		aurorax
 * @lastmodify	2013/08/31
 */
 	//TODO change to pdo
	class Db
	{
		//数据连接对象
		private static $db;
		
		//数据库对象获得方法
		public static function get(){
			if(!is_object(self::$db) || !self::$db->link()){
				$data = Config::get('DB');
				$db = $data['DB_TYPE'];
				self::$db = new $db($data['DB_HOST'],$data['DB_USER'],$data['DB_PASS'],$data['DB_NAME'],$data['DB_PCON'],$data['DB_CODE']);
			}
			return self::$db;
		}
		
		public static function pre(){
			return Config::get('DB_PREF');
		}
	}
?>