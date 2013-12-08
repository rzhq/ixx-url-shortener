<?php
/* Solidphp通用方法
 * @package		function
 * @author		aurorax
 * @lastmodify	2013/08/31
 */
	
	function C($name='',$value=''){
		Solid::__require(_PATH_.'/core/Config.php');
		if(empty($value) && !is_array($name))
			return Config::get($name);
		else
			return Config::set($name,$value);
	}
	
	/* 跳转方法
	 * 若$location不空则前往$location 否则转回首页
	 */
	function J($location=''){
		header('location: '._SITE_.$location);
		exit();
	}
	
	/* 国际化输出方法 */
	function e(){
		$e = func_get_args();
		echo $e[0];
	}
	
	