<?php

	define('_PATH_',dirname(__FILE__).'/solidphp');
	
	//uncomment the line below if solidphp core is in another folder
	//define('_THIS_',dirname(__FILE__)); 
	
	require _PATH_.'/core/Solid.php';
	
	Solid::run();