<?php

	class Index
	{
		public function main(){
			$s = new Short;
			$s->redirect();
			Display::show('index.php');
		}
		
		public function make(){
			$url = $_POST['url'];
			$site = ltrim(_SITE_, 'http://');
			if(stripos($url, $site)===0){
				echo 'http://'.$url;
			}else if(stripos($url, 'http://'.$site)===0){
				echo $url;
			}else{
				$s = new Short;
				echo _SITE_.'/'.$s->insert($url);
			}
		}
	}
