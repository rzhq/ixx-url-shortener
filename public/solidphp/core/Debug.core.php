<?php
/* Solidphp调试类
 * @package		core_Debug
 * @author		aurorax
 * @lastmodify	2013/10/25
 */

	class Debug
	{
		private static $time;
		private static $ram;
		private static $info = array();
		
		public static function stop(){
			//终止运行时间
			$GLOBALS['endTime'] = microtime();
			//内存终止使用
			if(function_exists('memory_get_usage'))
				$GLOBALS['endRam'] = memory_get_usage();
		}
		
		public static function show(){
			self::calc();
			echo '<br /><br />';
			echo 'Current Page: '.self::$info['page'].'<br />';
			echo 'Session ID: '.session_id().'<br />';
			echo 'Time Using: '.self::$time.'s<br />';
			echo 'Ram Using: '.self::$ram.' byte<br />';
			if(function_exists('memory_get_peak_usage'))
				echo 'Ram Peak: '.memory_get_peak_usage().' byte<br />';
			if(!empty(self::$info['DBLINK'])){
				echo 'Database Link: '.self::$info['DBLINK'].' <br />';
			}
			if(!empty(self::$info['_GET'])){
				echo '$_GET: <br />';
				foreach(self::$info['_GET'] as $n=>$v){
					echo '&nbsp;&nbsp;'.$n.' => '.$v.'<br />';
				}
			}
			if(!empty(self::$info['_COOKIE'])){
				echo '$_COOKIE: <br />';
				foreach(self::$info['_COOKIE'] as $n=>$v){
					echo '&nbsp;&nbsp;'.$n.' => '.$v.'<br />';
				}
			}
			if(!empty(self::$info['require'])){
				echo 'Requires: <br />';
				foreach(self::$info['require'] as $n=>$v){
					echo '&nbsp;&nbsp;'.$n.'<br />';
				}
			}
			if(!empty(self::$info['var'])){
				echo 'vars: <br />';
				foreach(self::$info['var'] as $n=>$v){
					echo '&nbsp;&nbsp;'.$n.' => '.$v.'l<br />';
				}
			}
		}
		
		public static function v($name='',$value=''){
			if(empty($name)){
				return self::$info;
			}else if(is_string($name)){
				if(strpos($name,'->')){
					$names = explode('->',$name);
					if(empty($value))
						return isset(self::$info[$names[0]][$names[1]])?self::$info[$names[0]][$names[1]]:NULL;
					else
						self::$info[$names[0]][$names[1]] = $value;
				}else{
					if(empty($value))
						return isset(self::$info[$name])?self::$info[$name]:NULL;
					else
						self::$info[$name] = $value;
				}
			}
		}
		
		public static function calc(){
			self::$time = self::_parsetime($GLOBALS['endTime']) - self::_parsetime($GLOBALS['startTime']);
			self::$ram = function_exists('memory_get_usage')?intval($GLOBALS['endRam']) - intval($GLOBALS['startRam']):'function not exist';
		}
		
		private static function _parsetime($microtime){
			$arr = explode(' ',$microtime);
			return (floatval($arr[0])+floatval($arr[1]));
		}
	}