<?php
function __autoload($classname) {
	// separate the two forms:
	if (php_sapi_name () == "cli") {
		require_once '../'.$classname.'.php';
	} else {
		$root = $_SERVER ['DOCUMENT_ROOT'];
		require_once $root . '/phoenix/Project/' . $classname . '.php';
	}
}

?>