<?php

	class Short
	{
		private $db;
		private $table = 'short';
		
		function __construct(){
			$this->db = Db::get();
			$this->table = Db::pre().$this->table;
			$this->install();
		}
		
		public function install($f=false){
			$this->db->createTable($this->table,'uid int PRIMARY KEY AUTO_INCREMENT,short varchar(32) COLLATE utf8_bin,url text,click int',$f);
		}
		
		public function get(){
			$str = $_SERVER['REQUEST_URI'];
			$s = 0;
			$j = 0;
			while($s !== false){
				$s = strpos($str,'/',$s+1);
				if($s !== false){
					$j = $s;
				}
			}
			return substr($str, $j+1);
		}
		
		public function insert($content, $short=''){
			if((strpos($content,'http://') !== 0) && (strpos($content,'https://') !== 0)){
				$content = 'http://'.$content;
			}
			$s = $this->inserted($content);
			if(!empty($s)){
				return $s;
			}
			if(empty($short)){
				do{
				$short = $this->random();
				}while(!$this->unused($short));
			}
			if($this->db->insert($this->table,'',$short,$content,0)){
				return $short;
			}
		}
		
		public function update($short, $content){
			if((strpos($content,'http://') !== 0) && (strpos($content,'https://') !== 0)){
				$content = 'http://'.$content;
			}
			return $this->db->update($this->table,'url',$content,'short=\''.$short.'\'');
		}
		
		public function redirect(){
			$short = $this->get();
			if(!empty($short)){
				$temp = $this->db->select('url,click',$this->table,'short=\''.$short.'\'');
				if(!empty($temp['url'])){
					if(stripos($temp['url'],_SITE_)===0){
						$temp['url'] = _SITE_;
					}else if(stripos($temp['url'],_SITE_)===0){
						$temp['url'] = _SITE_;
					}
					$this->db->update($this->table,'click',$temp['click']+1,'short=\''.$short.'\'');
					header('location: '.$temp['url']);
				}else{
					J();
				}
			}
		}
		
		public function inserted($url){
			$short = $this->db->select('short',$this->table,'url=\''.$url.'\'');
			if(empty($short)){
				return false;
			}else{
				return $short;
			}
		}
		
		public function unused($short){
			$url = $this->db->select('url',$this->table,'short=\''.$short.'\'');
			if(empty($url)){
				return true;
			}else{
				return false;
			}
		}
		
		public function random(){
			static $r = array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
				'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
				'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
				'y', 'z', '0', '1', '2', '3', '4', '5',
				'6', '7', '8', '9', 'A', 'B', 'C', 'D',
				'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
				'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
				'U', 'V', 'W', 'X', 'Y', 'Z');
			return $r[rand(0,61)].$r[rand(0,61)].$r[rand(0,61)].$r[rand(0,61)];
		}
	}