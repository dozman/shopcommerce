<?php
/**
 * XCustom Application framework
 *
 * @author  Peter Ramokone
 * @package core system settings
 */
(defined('XCUSTOM_APP'))  or die('Access Denied. You are attempting to access a restricted file directly.');

# begin



//1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected
define('XCUSTOM_APP_STATUS_ACTIVE', 		1);
define('XCUSTOM_APP_STATUS_DEACTIVATED', 	2);
define('XCUSTOM_APP_STATUS_DELETED', 		3);
define('XCUSTOM_APP_STATUS_PENDING', 		4);
define('XCUSTOM_APP_STATUS_REJECTED', 		5);
define('XCUSTOM_APP_STATUS_NOT_VERIFIED', 	6);
define('XCUSTOM_APP_STATUS_SUSPENDED',  	7);
define('XCUSTOM_APP_STATUS_INACTIVE',  		8);

// @todo to be removed only multiple interface support has been implemented
define('XCUSTOM_DEAFULT_CLIENT_ROLE_ID',  	3);

// get the core bulk mailer classes
require XCUSTOM_APP_LIBRARY_PATH.'XCustomGeneric.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomFile.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomFormat.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomDB.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomHttp.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomSecurity.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomValidate.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomUi.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomForm.php';
require XCUSTOM_APP_LIBRARY_PATH.'XCustomApplication.php';
