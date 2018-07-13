<?php
// start XCustom Application
define('XCUSTOM_APP', true);

// directory separator
((defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR))? false : define('DIRECTORY_SEPARATOR', (stristr(PHP_OS,'WIN')) ? '/' : '\\');

// set absolute directory
(defined('XCUSTOM_APP_ABSOLUTE_PATH')) ? false : define('XCUSTOM_APP_ABSOLUTE_PATH', realpath(realpath(dirname(__FILE__).'../')).DIRECTORY_SEPARATOR);

// includes path
define('XCUSTOM_APP_ROOT_PATH',			realpath(XCUSTOM_APP_ABSOLUTE_PATH . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_LIBRARY_PATH',		XCUSTOM_APP_ROOT_PATH . 'library' 		. DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_DATA_PATH',			XCUSTOM_APP_ROOT_PATH . 'data' 			. DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_COMPONENTS_PATH',	XCUSTOM_APP_ROOT_PATH . 'components' 	. DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_SETTINGS_PATH',		XCUSTOM_APP_ROOT_PATH . 'settings' 		. DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_CONFIGS_PATH',		XCUSTOM_APP_ROOT_PATH . 'configs' 		. DIRECTORY_SEPARATOR);
define('XCUSTOM_APP_RESOURCES_PATH',	XCUSTOM_APP_ROOT_PATH . 'resources' 	. DIRECTORY_SEPARATOR);

try{	
	// load constanst and config required
	require XCUSTOM_APP_SETTINGS_PATH.'core.php';
	
	// start the application
	$xcustom_application = new XCustomApplication();
	
	// boot & runtime
	$xcustom_application->boot();
	
	//echo '<pre>';print_r($_SERVER['REQUEST_URI'].PHP_EOL);print_r($application);exit;
	
	// start instructions
	$xcustom_application->dispatch();
}
catch(Exception $e){
	header("HTTP/1.1 500 Internal Server Error");
	XCustomHttp::addNoCacheHeaders();
	echo $e->getMessage();
}
