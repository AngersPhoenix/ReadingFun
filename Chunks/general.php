<?php

function persistanceLoader($class){
	if(php_sapi_name() === "cli"){
		$file = 'Persistance/'.$class.'.php';
		if(is_readable($file))
			require_once $file;
	}else{
		$file = $_SERVER ['DOCUMENT_ROOT'].'/phoenix/Project/Persistance/'.$class.'.php';
		if(is_readable($file))
			require_once $file;
	}
}

function modelLoader($class){
	if(php_sapi_name() === "cli"){
		$file = 'Model/'.$class.'.php';
		if(is_readable($file))
			require_once $file;
	}else{
		$file = $_SERVER ['DOCUMENT_ROOT'].'/phoenix/Project/Model/'.$class.'.php';
		if(is_readable($file))
			require_once $file;
	}
}

?>



