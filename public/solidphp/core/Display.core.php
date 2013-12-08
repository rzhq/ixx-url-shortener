<?php
/* Solidphp模板类
 * @package		core_Display
 * @author		aurorax
 * @lastmodify	2013/08/31
 */
	class Display
	{
		/* 模板文件夹 */
		private $tpl;
		
		/* 模板引用路径 */
		private $url;
		
		private $src;
		
		private $varPool;
		
		private $config;
		
		private static $display;
		
		
		/* 构造方法 */
		public function __construct(){
				$this->config = Config::get('TPL');
				if(!is_dir($this->config['TPL_FOLDER'])){
					mkdir($this->config['TPL_FOLDER']);
				}
				$this->src = _THIS_.'/'.$this->config['TPL_FOLDER'];
				$this->tpl = _THIS_.'/public';
				$this->url = _SITE_.'/public';
		}
		
		private static function _static(){
			if(!is_object(self::$display))
				self::$display = new self;
		}
		
		public function convert($file){
			if($this->config['TPL_CONVERT']){
				$srcFile = str_replace(array('/','\\'),DIRECTORY_SEPARATOR,$this->src.$file);
				if(file_exists($srcFile)){
					$trgFile = str_replace(array('/','\\'),DIRECTORY_SEPARATOR,$this->tpl.$file);
					$source = fopen($srcFile,'rb');
					$target = fopen($trgFile,'wb');
					while(!feof($source)){
						$str = fgets($source);
						if(stripos($str,$this->config['TPL_START'])){
							$str = str_replace($this->config['TPL_START'],'<?php',$str);
							$str = str_replace($this->config['TPL_END'],'?>',$str);
						}
						fwrite($target,$str);
					}
				}
			}
		}
		
		//模板文件加载方法
		public function load($file){
			$this->convert($file);
			$file = $this->tpl.'/'.$file;
			$file = str_replace(array('/','\\'),DIRECTORY_SEPARATOR,$file);
			if(file_exists($file)){
				require $file;
			}else{
				exit('Cannot load '.$file.': file missing!');
			}
		}
		
		public static function show($file){
			self::_static();
			self::$display->load($file);
		}
		
		public static function assign($name,$value){
			self::_static();
			self::$display->varPool[$name] = $value;
		}
		
		/* 模型和变量加载方法 */
		public function __get($name){
			return isset($this->varPool[$name])?$this->varPool[$name]:NULL;
		}
	}