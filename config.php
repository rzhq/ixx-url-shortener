<?php
/* Solidphp数据库配置
 * @package		core_Config
 * @author		aurorax
 * @lastmodify	2013/08/31
 */
	
/*? 多数据库? */

$config['APP_DEBUG'] = false;	//调试开关
$config['APP_MODULE_EMPTY'] = 'Index';
$config['APP_ACTION_EMPTY'] = 'main';
	
$config['DB_TYPE'] = 'Mysql';		//数据库类型
$config['DB_PREF'] = 'sp_';			//数据库前缀
$config['DB_HOST'] = 'localhost';	//数据库地址
$config['DB_USER'] = 'root';		//账户
$config['DB_PASS'] = 'rootpass';	//密码
$config['DB_NAME'] = 'ixx';	//数据库名称
$config['DB_PCON'] = false;			//false:非持续连接 true:持续连接
$config['DB_CODE'] = 'utf8';		//数据编码

$config['TPL_CONVERT'] = false;		//模板转换开关