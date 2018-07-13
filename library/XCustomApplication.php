<?php
/**
 * XCustom Application
 *
 * @author  Peter Ramokone
 * @package Application
 * @dependency XCustomSecurity package 
 */
class XCustomApplication
{ 
	/**ui_layout_content
		ui_view_content
     * version number
     */
    const FRAMEWORK_VERSION = '1.0.0';
    
	/*
	 * @var object database engine instance
	 */
	public 	$connection;
	
	/*
	 * @var string component
	 */
	public	$component 		= null;
	
	/*
	 * @var string module
	 */
	public	$module 		= null;
	
	/*
	 * @var string option
	 */
	public 	$option 		= null;
	
	/**
	 * 
	 * @var array parameters
	 */
	public 	$params 		= null;
	
	// configurations
	public $config_application	= null;
	public $config_tokens		= null;
	public $config_database		= null;
	public $config_package		= null;
	public $user_permissions		= [];
	public $dir_separator 	 	= '/';
	public $runtime;
	public $ui;
	public $site_dir;
	public $access_context;
	public $notice_message;
	
	
	
	public static function instance(){
		return isset($GLOBALS['xcustom_application']) ? $GLOBALS['xcustom_application'] : new XCustomApplication();
	}
	
	public function __construct(){
		
		$this->ui 	= new XCustomUi();
		
		$this->dir_separator = DIRECTORY_SEPARATOR;
		
		// check for application configuration
		if(XCustomFile::exists(XCUSTOM_APP_CONFIGS_PATH . 'application.ini')){
			// parse ini file for application configurations 
			$this->config_application = (object)parse_ini_file(XCUSTOM_APP_CONFIGS_PATH . 'application.ini', $process_sections = false);
		}
		
		// check for package configuration
		if(XCustomFile::exists(XCUSTOM_APP_CONFIGS_PATH . 'package.ini')){
			// parse ini file for package configurations
			$this->config_package = (object)parse_ini_file(XCUSTOM_APP_CONFIGS_PATH . 'package.ini', $process_sections = false);
		}
		
		// check for tokens configuration
		if(XCustomFile::exists(XCUSTOM_APP_CONFIGS_PATH . 'tokens.ini')){
			// parse ini file for tokens configurations 
			$this->config_tokens = (object)parse_ini_file(XCUSTOM_APP_CONFIGS_PATH . 'tokens.ini', $process_sections = false);
		}
		
		// check for database configuration
		if(XCustomFile::exists(XCUSTOM_APP_CONFIGS_PATH . 'database.ini')){
			// parse ini file for application configurations
			$this->config_database = (object)parse_ini_file(XCUSTOM_APP_CONFIGS_PATH . 'database.ini', $process_sections = false);
		}
	}
	
	/**
	 * get component
	 *
	 * @return string
	 */
	public function getComponent()
	{
		return $this->component;
	}
	
	/**
	 * get module
	 *
	 * @return string
	 */
	public function getModule()
	{
		return $this->module;
	}
	
	/**
	 * get option
	 *
	 * @return string
	 */
	public function getOption()
	{
		return $this->option;
	}
	
	/**
	 * get params from request
	 * 
	 * @return array
	 */
	public function getParams()
	{		
		return $this->params;
	}
	
	/**
	 * get param from request
	 * 
	 * 
	 * @param string $name
	 * @return string
	 */
	public function getParam($name)
	{		
		return $this->params[$name];
	}
	
	/**
	 * get param from request
	 * 
	 * 
	 * @param string $name
	 * @return string
	 */
	public function isParam($name)
	{		
		return is_array($this->params) && array_key_exists($name, $this->params);
	}
	
	/**
	 * strat the core application bootstrap
	 *
	 * @return void
	 */
	public function boot()
	{		
		// normal session
		session_start();
		
		// check for application configuration
		if(!$this->config_application || !$this->config_tokens || !$this->config_database || !$this->config_package){
			throw new Exception('Application not configured correctly. Check readme for details of how to configure the application');
		}
		
		// set timezone
		date_default_timezone_set($this->config_application->system_default_timezone);
		
		// set locale
		setlocale(LC_ALL, $this->config_application->system_default_locale);
		
		// system will automatically pickup the request
		$this->setupRouting();
		
		// make sure that that the database has been configuration
		if(!$this->config_database){
			throw new Exception('Database configurations not set');
		}
				
		// load connection
		$this->connection 	= new XCustomDB("{$this->config_database->type}:host={$this->config_database->host};port={$this->config_database->port};dbname={$this->config_database->schema}", $this->config_database->username, $this->config_database->password);
		$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		// set error mode to exception
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// load default permission
		$this->loadPermissions();
		
	}
	
	protected function loadPermissions(){
		// logged in user role
		if(XCustomSecurity::loggedIn()){
			// guest user for the current interface
			$objDBConn = $this->connection->prepare('SELECT * FROM security_role WHERE id = :id AND status_id = :active AND guest = :guest');
			$objDBConn->execute(array(':id' => XCustomSecurity::getUser()->security_role_id,':active' => XCUSTOM_APP_STATUS_ACTIVE,':guest' => 0));
			
			$objRole = $objDBConn->fetchObject();

			// get list of guest permissions
			$objDBConn = $this->connection->prepare('SELECT 
															up.permissions AS given_permissions,
															comp.permissions AS unrestricted_permissions,
															comp.block_direct_linkage,
														 	comp.name,
														 	comp.title
					
													 FROM security_role_permission AS up 
													 INNER JOIN security_component AS comp ON comp.id = up.security_component_id
													 WHERE up.status_id = :active AND up.security_role_id = :role
													 ');
			$objDBConn->execute(array(':active' => XCUSTOM_APP_STATUS_ACTIVE,':role' => $objRole->id));
			
			
			$arrFoundPermissions = $objDBConn->fetchAll(PDO::FETCH_ASSOC);
			
			
			foreach($arrFoundPermissions as $permission_details){
				$arrGivenPermissions		= explode(',', $permission_details['given_permissions']);
				$arrRestrictedPermissions 	= explode(',', $permission_details['unrestricted_permissions']);
				$arrBlockDirectLinkage		= explode(',', $permission_details['block_direct_linkage']);
				
				// permission
				$this->user_permissions[$permission_details['name']] = array('title' => $permission_details['title'],'hidden_perms' => [],'direct_perms' => []);
								
				// permission given to the user must still be unrestricted within the component
				foreach($arrGivenPermissions as $perm){
					
					if(in_array($perm, $arrRestrictedPermissions)){
						if(in_array($perm, $arrBlockDirectLinkage)){
							$this->user_permissions[$permission_details['name']]['hidden_perms'][$perm] = $perm;
						}
						else{
							$this->user_permissions[$permission_details['name']]['direct_perms'][$perm] = $perm;
						}
					}
				}
			}
			
		}
		else{
			// guest user for the current interface
			$objDBConn = $this->connection->prepare('SELECT * FROM security_role WHERE status_id = :active AND guest = :guest AND interface_code = :interface');
			$objDBConn->execute(array(':active' => XCUSTOM_APP_STATUS_ACTIVE,':guest' => 1, 'interface' => $this->access_context));
			
			$objRole = $objDBConn->fetchObject();

			// get list of guest permissions
			$objDBConn = $this->connection->prepare('SELECT 
															up.permissions AS given_permissions,
															comp.permissions AS unrestricted_permissions,
															comp.block_direct_linkage,
														 	comp.name,
														 	comp.title
					
													 FROM security_role_permission AS up 
													 INNER JOIN security_component AS comp ON comp.id = up.security_component_id
													 WHERE up.status_id = :active AND up.security_role_id = :role
													 ');
			$objDBConn->execute(array(':active' => XCUSTOM_APP_STATUS_ACTIVE,':role' => $objRole->id));
			
			
			$arrFoundPermissions = $objDBConn->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($arrFoundPermissions as $permission_details){
				$arrGivenPermissions		= explode(',', $permission_details['given_permissions']);
				$arrRestrictedPermissions 	= explode(',', $permission_details['unrestricted_permissions']);
				$arrBlockDirectLinkage		= explode(',', $permission_details['block_direct_linkage']);
				
				// permission
				$this->user_permissions[$permission_details['name']] = array('title' => $permission_details['title'],'hidden_perms' => [],'direct_perms' => []);
				
				
				// permission given to the user must still be unrestricted within the component
				foreach($arrGivenPermissions as $perm){
					if(in_array($perm, $arrRestrictedPermissions)){
						if(in_array($perm, $arrBlockDirectLinkage)){
							$this->user_permissions[$permission_details['name']]['hidden_perms'][$perm] = $perm;
						}
						else{
							$this->user_permissions[$permission_details['name']]['direct_perms'][$perm] = $perm;
						}
					}
				}
			}
		}
	}
	
	/**
	 * setup routing for freindly urls
	 * 
	 * @return void
	 */
	protected function setupRouting()
	{		
		// uri 
		$uri = str_replace('//', '/', XCustomHttp::getUri());
		
		// remove the public from the uri 
		$public_directory_length 	= strlen($this->config_application->public_directory);
		
		// make sure public directory is not considered as part of the URL path  when building components
		if(substr($uri, 0, $public_directory_length) == $this->config_application->public_directory){
			$uri = $this->config_application->base_uri . substr($uri, $public_directory_length);
		}
		
		// normal formating of the site directory
		$this->site_dir = $this->config_application->base_uri;
				
		// remove site directory from paths
		if(substr($uri, 0, strlen($this->site_dir)) == $this->site_dir){
			$uri = substr($uri, strlen($this->site_dir)-1);	
		}
		
		// path cleanups
		$path_cleanups = explode('/', $uri);
		
		// set default interface(access context) if not set correctly. i.e. user has specified the access context
		$supported_interfaces = explode(',', $this->config_application->supported_interfaces);;
		if(in_array($path_cleanups[1], $supported_interfaces)){
		
			//set the current interface
			$this->access_context = $path_cleanups[1];
			
			// remove the current interface from uri
			if(substr($uri, 0,1) == '/'){
				$uri = substr($uri, 1+strlen($this->access_context));
			}
		}
		else{
			//set the access_context / interface
			$this->access_context = $this->config_application->default_interface;
		}
		
		$this->access_context = strtolower($this->access_context);
		
		// some browsers like chrome & firefox add ?_= to the url when doing json/ajax calls
		$uri_ajax_cookie = explode('?', $uri);
		
		// remove extra forward slash
		$uri = trim($uri_ajax_cookie[0],'/'); 
		
		$this->uri = $uri;
		
		// check if we still have uri
		if($uri){
			// set parameters list based on slashes
			$params = explode('/', $uri);
				
			// ignore double or more slahes
			$params = array_filter($params, function($value) {return ($value !== null && $value !== false && $value !== '');});
						
			// total params after filters
			$total_params = count($params);
			
			// create sequencial keys are set valus
			$final_params = array_combine(range(0, $total_params-1), array_values($params));
			
			// total params after filters
			$total_params = count($final_params);
			
			// manipulate params to add component
			if($total_params == 1){
				// set component
				$this->component = $params[0];
			}
			// manipulate params to add component, module
			else if($total_params == 2){
				// set component
				$this->component = $params[0];
				
				// set module
				$this->module = $params[1];
			}
			// manipulate params to add component, options, module
			else if($total_params == 3){
				// set component
				$this->component 	= $params[0];
				
				// set module
				$this->module 		= $params[1];
				
				// set option
				$this->option 		= $params[2];				
			}
			// manipulate params to add component, options, module, params
			else {
				
				// set component
				$this->component 	= $params[0];
				
				// set module
				$this->module 		= $params[1];
				
				// check if this is an odd params
				if($total_params % 2 == 0){
					
					// skip rule to help with param setup
					$skip_rule = false;		
					for($param_count = 2; $param_count <= $total_params; $param_count++){
						// param has value
						if( isset($final_params[$param_count+1]) ){
							
							// check if we need to skip the rule
							if($skip_rule){
								// do not skip the next one
								$skip_rule = false;
							}
							else{
								$this->params[$final_params[$param_count]] = $final_params[$param_count+1];
								$skip_rule = true;
							}
						}
					}
				}
				else{
					// set option
					$this->option 		= $params[2];
					
					// skip rule to help with param setup
					$skip_rule = false;	
				
					for($param_count = 3; $param_count < $total_params; $param_count++){
						// param has value
						if( isset($final_params[$param_count+1]) ){
							
							// check if we need to skip the rule
							if($skip_rule){
								// do not skip the next one
								$skip_rule = false;
							}
							else{
								$this->params[$final_params[$param_count]] = $final_params[$param_count+1];
								$skip_rule = true;
							}
						}
					}
				}
			}
		}
	}
	
	/**
	 * render template / layout 
	 * @param string $template
	 * @param array $tags options
	 * @param string $opening_tag optional default {
	 * @param string $closing_tag optional default }
	 * 
	 * @return mixed json / text / html
	 */
	public function render($template, $tags = [], $opening_tag = '{', $closing_tag = '}'){
		return XCustomGeneric::replaceTags(XCustomFile::getContent($template), $tags, $opening_tag, $closing_tag);
	}
	
	/**
	 * check if user has permission to module & component
	 * @param string $module
	 * @param string $component optional
	 * 
	 * @return boolean
	 */
	public function hasPermission($module, $component = null){
		$component = $component ? $component : $this->component;
		
		return (array_key_exists($component, $this->user_permissions) && ( array_key_exists($module, $this->user_permissions[$component]['direct_perms']) || array_key_exists($module, $this->user_permissions[$component]['hidden_perms']) ) ) ? true : false;
		
	}	
	
	/**
	 * render render component view
	 * 
	 * @param array $params options
	 * @param string $opening_tag optional default {
	 * @param string $closing_tag optional default }
	 * 
	 * @note the view script/template will automatically be detected, user may provide custom template with full system path under $template
	 *
	 * @return mixed json / text / html
	 */
	public function renderViewer($params, $opening_tag = '{', $closing_tag = '}', $template = null){
		$strFileFullname = $template ? $template : XCUSTOM_APP_COMPONENTS_PATH . "{$this->getComponent()}{$this->dir_separator}{$this->access_context}{$this->dir_separator}view{$this->dir_separator}{$this->getModule()}.tpl";
		
		if(XCustomFile::exists($strFileFullname)){
			$params = array_merge($params, [
											'request'			=> XCustomHttp::getUri(),
											'site_dir'			=> $this->site_dir,
											'interface'			=> $this->access_context,
											'application_name' 	=> $this->config_application->name
											]);
			return XCustomGeneric::replaceTags(XCustomFile::getContent($strFileFullname), $params, $opening_tag, $closing_tag);
			
			//echo $this->ui->get('layout_content');exit;
		}
		else{
			throw new Exception("Failed to render {$this->getModule()} viewer for {$this->getComponent()} within the {$this->access_context} interface. {$strFileFullname}");
			
		}
	}
	
	/**
	 * dispatch the request 
	 * 
	 * @throws SoapFault
	 */
	public function dispatch(){
		// resource 
		if($this->component == 'assets' && XCustomFile::isExtension($this->uri, ['js','png','gif','jpg','ico','css','eot','svg','ttf','woff','woff2'])){
			//echo XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/{$this->uri}";
			// check if resource exists
			if(XCustomFile::exists(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/{$this->uri}")){
				
				header("X-Content-Type-Options: nosniff");
				header('Access-Control-Allow-Methods: GET');
				XCustomHttp::addNoCacheHeaders();
				
				
				// all images
				if(XCustomFile::isImage($this->uri)){
					header("Content-Type: ." . XCustomFile::getMime($this->uri), true);
					header("Content-Length: " . XCustomFile::size(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/{$this->uri}"));
				}
				else if(XCustomFile::isExtension($this->uri, array('eot','svg','ttf','woff','woff2'))){
					header("Content-Type: text/plain");
				}
				else if(XCustomFile::isExtension($this->uri, array('css'))){
					header("Content-Type: text/css");
				}
				else if(XCustomFile::isExtension($this->uri, array('js'))){
					header("Content-Type: application/x-javascript");
				}
				else{
					header("Content-Type: ." . XCustomFile::getMime($this->uri));
				}				
				readfile(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/{$this->uri}");
			}
			// exit
			exit;
		}
		
		
		// grab error from ErrorDocument
		if(in_array(XCustomHttp::getStatus(), array(400,401,402,403,405,406,407,408,409,410,411,412,417,414,415,416,417,422,423,424,426,500,501,502,503,504,505))){
			// set error code
			$error_code = XCustomHttp::getStatus();
				
			// if web service throw soap fault
			if(XCustomHttp::isAjax()){
				// send back the header
				header("Access-Control-Allow-Origin: *");
				header("Access-Control-Allow-Methods: *");
				header("Content-Type: application/json");
				header("HTTP/1.1 {$error_code}");
				header("Status: {$error_code}");
				
				// send back json response
				echo  json_encode(['error' => "Error while trying to dispatch request, Error Code: {$error_code}", 'status' => $error_code]);
				
				// stop propagation
				exit;
			}
			else{
				// send error header
				header("Status: {$error_code}");
				
				$strMainMenuItems = require XCUSTOM_APP_SETTINGS_PATH .'main-menu.php';
				$strSideMenuItems = require XCUSTOM_APP_SETTINGS_PATH .'side-menu.php';
								
				$this->publishBroadcastedMessage();
				echo $this->render(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/layout.tpl",
					[	'title'				=> 'Oops! Error loding page with code: '.$error_code,
							'notice_message'	=> $this->notice_message,
							'request'			=> XCustomHttp::getUri(),
							'mainmenu'			=> $strMainMenuItems,
							'sidemenu'			=> $strSideMenuItems,
							'site_dir'			=> $this->site_dir,
							'interface'			=> $this->access_context,
							'application_name' 	=> $this->config_application->name,
							'callcentre_number' => $this->config_application->callcentre_number,
							'content'	=> 'An error occured while executing request'
					]
				);
			}
		}
		else{
			// check if users must access using https
			if($this->config_application->force_interfaces_over_ssl && !XCustomHttp::isSecure()){
				
				// current url requested
				$full_url = XCustomHttp::getFullUrl($full = true);
					
				// change the port and protocol, but keep the url
				header('Location: '. str_replace('http://', 'https://', $full_url));
					
				// stop propagation
				exit;
			}
			else{
				$strMainMenuItems = require XCUSTOM_APP_SETTINGS_PATH .'main-menu.php';
				$strSideMenuItems = require XCUSTOM_APP_SETTINGS_PATH .'side-menu.php';
				
				
				// check if we have component
				if($this->getComponent()){
					// check for module
					if($this->getModule()){
						// check for a valid component/module with permission
						if($this->hasPermission($this->getModule(), $this->getComponent())){
							
							
							require XCUSTOM_APP_COMPONENTS_PATH . "{$this->getComponent()}{$this->dir_separator}" . XCustomFormat::getClassName($this->getComponent()).'Manager.php';
							$strComponentManager = XCustomFormat::getClassName($this->getComponent()).'Manager';
							$this->runtime = new $strComponentManager;
							
							require XCUSTOM_APP_COMPONENTS_PATH . "{$this->getComponent()}{$this->dir_separator}{$this->access_context}{$this->dir_separator}model{$this->dir_separator}{$this->getModule()}.php";
							
							// check a valid file
							if( file_exists(XCUSTOM_APP_COMPONENTS_PATH . "{$this->getComponent()}{$this->dir_separator}{$this->access_context}{$this->dir_separator}model{$this->dir_separator}{$this->getModule()}.php")){
								// dispatch content page
								$strContent =  require XCUSTOM_APP_COMPONENTS_PATH . "{$this->getComponent()}{$this->dir_separator}{$this->access_context}{$this->dir_separator}model{$this->dir_separator}{$this->getModule()}.php";
								
								// render normal page
								$this->publishBroadcastedMessage();
								echo $this->render(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/layout.tpl", [	'title'				=> ucwords(str_replace('-', ' ', "{$this->component} / {$this->module}")),
																							'code'				=> 'NP001',
																							'request'			=> XCustomHttp::getUri(),
																							'notice_message'	=> $this->notice_message,
																								'mainmenu'			=> $strMainMenuItems,
																							'sidemenu'			=> $strSideMenuItems,
																							'content'			=> $strContent,
																							'site_dir'			=> $this->site_dir,
																							'interface'			=> $this->access_context,
																							'application_name' 	=> $this->config_application->name,
																								'callcentre_number' => $this->config_application->callcentre_number
																						]
										);
							}
							else{
								// render error - no component module
								$this->publishBroadcastedMessage();
								echo $this->render(XCUSTOM_APP_TEMPLATES_PATH .'layout.error.tpl', [	'title'			=> 'Request not known',
																								'code'			=> 'NP002',
																								'request'		=> XCustomHttp::getUri(),
																								'notice_message'	=> $this->notice_message,
																								'mainmenu'		=> $strMainMenuItems,
																								'sidemenu'		=> $strSideMenuItems,
																								'content'		=> 'Invalid request specified.',
																								'site_dir'		=> $this->site_dir,
																								'interface'		=> $this->access_context,
																								'application_name' => $this->config_application->name,
																								'callcentre_number' => $this->config_application->callcentre_number
																							]
																						);
							}
						}
						else{
							// render error - no permission
							$this->publishBroadcastedMessage();
							echo $this->render(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/layout.tpl", [	'title'			=> 'No Permission to Access',
																							'code'			=> 'NP003',
																							'request'		=> XCustomHttp::getUri(),
																							'notice_message'	=> $this->notice_message,
																								'mainmenu'		=> $strMainMenuItems,
																							'sidemenu'		=> $strSideMenuItems,
																							'content'		=> 'You do not have permission to view the requested file or resource.',
																							'site_dir'		=> $this->site_dir,
																							'interface'		=> $this->access_context,
																								'application_name' => $this->config_application->name,
																								'callcentre_number' => $this->config_application->callcentre_number
																						]
																					);
						}
					}
					else{
						// render homepage
						
					$this->publishBroadcastedMessage();
					echo $this->render(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/layout.tpl", [		'title'			=> 'Content Page',
																								'request'		=> XCustomHttp::getUri(),
																								'notice_message'	=> $this->notice_message,
																								'mainmenu'		=> $strMainMenuItemsx,
																								'sidemenu'		=> $strSideMenuItems,
																								'site_dir'		=> $this->site_dir,
																								'interface'		=> $this->access_context,
																								'application_name' => $this->config_application->name,
																								'callcentre_number' => $this->config_application->callcentre_number
								
																							]
																					);
						
					}
				}
				else{
					// render homepage
					$this->publishBroadcastedMessage();
					echo $this->render(XCUSTOM_APP_RESOURCES_PATH ."pack/{$this->access_context}/layout.tpl", 
																					[	'title'				=> 'Welcome Page',
																						'notice_message'	=> $this->notice_message,
																						'request'			=> XCustomHttp::getUri(),
																						'mainmenu'			=> $strMainMenuItems,
																						'sidemenu'			=> $strSideMenuItems,
																						'site_dir'			=> $this->site_dir,
																						'interface'			=> $this->access_context,
																						'application_name' 	=> $this->config_application->name,
																						'callcentre_number' => $this->config_application->callcentre_number,
																						'content'			=> 'Homepage & content to be created'
																						]
							);
				}
			}
		}
	}
	
	/**
	 * broadcast success message
	 *
	 * @param string $message
	 * @return void
	 */
	public static function broadcastSuccessMessage($message){
		XCustomSecurity::setSession('notice-message-success', $message);
	}
	
	/**
	 * broadcast error message
	 *
	 * @param string $message
	 * @return void
	 */
	public static function broadcastErrorMessage($message){
		XCustomSecurity::setSession('notice-message-error', $message);
	}
	
	/**
	 * broadcast warning message
	 *
	 * @param string $message
	 * @return void
	 */
	public static function broadcastWarningMessage($message){
		XCustomSecurity::setSession('notice-message-warning', $message);
	}
	
	/**
	 * broadcast information message
	 * 
	 * @param string $message
	 * @return void
	 */
	public static function broadcastInfoMessage($message){
		XCustomSecurity::setSession('notice-message-info', $message);
	}
	
	/**
	 * publish all the broadcasted alerts
	 * 
	 * @note this will set the messages to the notice_message property
	 */
	public function publishBroadcastedMessage(){
		$strMessage = "";			
		$notice_message = XCustomSecurity::isSession('notice-message-success') ? XCustomSecurity::getSession('notice-message-success') : null;
		XCustomSecurity::killSession('notice-message-success');
		
		if(!empty($notice_message)){
			$strMessage .= "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>{$notice_message}</div>";
		}
		
		
		$notice_message = XCustomSecurity::isSession('notice-message-info') ? XCustomSecurity::getSession('notice-message-info') : null;
		XCustomSecurity::killSession('notice-message-info');			
		if(!empty($notice_message)){
			$strMessage .= "<div class=\"alert alert-info alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>{$notice_message}</div>";
		}
		
		$notice_message = XCustomSecurity::isSession('notice-message-warning') ? XCustomSecurity::getSession('notice-message-warning') : null;
		XCustomSecurity::killSession('notice-message-warning');
			
		if(!empty($notice_message)){
			$strMessage .= "<div class=\"alert alert-warning alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>{$notice_message}</div>";
		}
		
		$notice_message = XCustomSecurity::isSession('notice-message-error') ? XCustomSecurity::getSession('notice-message-error') : null;
		XCustomSecurity::killSession('notice-message-error');
			
		if(!empty($notice_message)){
			$strMessage .= "<div class=\"alert alert-danger alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>{$notice_message}</div>";
		}
		
		$this->notice_message = $strMessage;
		
	}
}