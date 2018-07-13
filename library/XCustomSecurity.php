<?php
/**
 * XCustom Security
 *
 * @author  Peter Ramokone
 * @package Security
 */
class XCustomSecurity
{
	/**
	 * get the session namespace used
	 * - a combination of the session namespace, access section and url in use(which might include the port)
	 *
	 * @return string
	 */
	private static function getSessionNameSpace(){
		$session_namespace_prefix 		= XCustomApplication::instance()->config_tokens->session_namespace_prefix;
		$server_key				 		= XCustomApplication::instance()->config_tokens->server_key;
		$session_namespace_algorithm 	= XCustomApplication::instance()->config_application->session_namespace_algorithm;
		$interface						= XCustomApplication::instance()->access_context;
		
		$secure_name		= "SNP{$session_namespace_prefix}SK{$server_key}IF{$interface}";
		$session_namespace 	= $session_namespace_algorithm == 'md5' ? md5($secure_name) : sha1($secure_name);
	}
	
	/**
	 * get the cookie namespace used
	 *
	 * @return string
	 */
	private static function getCookieNameSpace(){
		$cookie_namespace_prefix 	= XCustomApplication::instance()->config_tokens->cookie_namespace_prefix;
		$server_key				 	= XCustomApplication::instance()->config_tokens->server_key;
		$cookie_namespace_algorithm = XCustomApplication::instance()->config_application->cookie_namespace_algorithm;
		$interface					= XCustomApplication::instance()->access_context;
		
		$secure_name		= "CNP{$cookie_namespace_prefix}SK{$server_key}IF{$interface}";
		$cookie_namespace 	= $cookie_namespace_algorithm == 'md5' ? md5($secure_name) : sha1($secure_name);
	}
	
	/**
	* this method will help with retieving the current loggedin user object
	*
	* @return object
	* @note it is advisable to execute this within the loggedIn call
	**/
	public static function getUser(){
		$session_namespace = self::getSessionNameSpace();
		
		// check if session exists
		if(isset($_SESSION[ $session_namespace ])){
			// check if session has user object
			if(isset($_SESSION[ $session_namespace ]['xcustom_user'])){
				return unserialize($_SESSION[ $session_namespace ]['xcustom_user']);
			}
		}
		return null;
	}
	
	/**
	* check if user is logged in
	* 
	* @note this method will help with checking if the current user has logged in
	*
	* @return boolean
	**/
	public static function loggedIn(){
		$session_namespace = self::getSessionNameSpace();
			
		// check if session exists
		if(isset($_SESSION[ $session_namespace ])){
			// check if session has user object
			if(isset($_SESSION[ $session_namespace ]['xcustom_user'])){
				$objUser = unserialize($_SESSION[ $session_namespace ]['xcustom_user']);				
				return isset($objUser->logged_in) ? $objUser->logged_in : false;
			}
		}
		
		// user not logged in
		return false;
	}
	
	/**
	* this method will help with destroying of the current session on the used namespace
	*
	* @return void
	**/
	public static function logout(){
		if(self::loggedIn()){
			// set session to null
			$session_namespace = self::getSessionNameSpace();
			
			$_SESSION[$session_namespace]['xcustom_user'] = null;
			$_SESSION[$session_namespace] = array();
			unset($_SESSION[$session_namespace]);
		}
	}
	
	/**
	* method to add set data to the session name
	
	* @param mixed $session_variable
	* @param mixed $session_data
	* 
	* @return void
	*/
	public static function setSession($session_variable,$session_data){
		// set session data under namespace
		$_SESSION[self::getSessionNameSpace()][$session_variable] = $session_data;
	}
	
	/**
	* method to add set data to the cookie name
	
	* @param string $name
	* @param string $value optional default null
	* @param timestamp $expire optional default null: The time the cookie expires
	* @param string $path optional default null: The path on the server 
	* @param string $domain optional default null: The domain that the cookie is available.
	* @param boolean $secure optional default false: Indicates that the cookie should only be transmitted over a secure HTTPS connection.
	* @param boolean $httponly optional default true: to effectively help to reduce identity theft through XSS attacks
	* 
	* @return void
	*/
	public static function setCookie($name, $value = "", $expire = null, $path = null, $domain = null, $secure = false, $httponly = true){
		$cookie_namespace = self::getCookieNameSpace();
		if(is_null($expire)) {
			$expire = time()+60*60*24*30;
		}
		
		// set the cookie
		setcookie("{$cookie_namespace}[{$name}]", $value,$expire,$path, $domain, $secure, $httponly);
	}
	
	/**
	* method to retrieve session data for a particular name 
	*
	* @return mixed - this will return null if name not set
	 *
	*/
	public static function getSession($session_name, $default_value = null){
		return (self::isSession($session_name) && isset($_SESSION[self::getSessionNameSpace()][$session_name])) ? $_SESSION[self::getSessionNameSpace()][$session_name] : $default_value;
	}
	
	/**
	* method to retrieve cookie data for a particular name 
	*
	* @return mixed - this will return null if name not set
	*/
	public static function getCookie($name, $default_value = null){
		return (self::isCookie($name) && isset($_COOKIE[self::getCookieNameSpace()][$name])) ? $_COOKIE[self::getCookieNameSpace()][$name] : $default_value;
	}
	
	/**
	* method to check is data has been stored with a particular name in the session
	* 
	* @param string $session_name
	*
	* @return boolean - true if session isset - otherwise false
	*/
	public static function isSession($session_name){
		return isset($_SESSION[self::getSessionNameSpace()][$session_name]);
	}	
	
	/**
	* method to check is data has been stored with a particular name in the cookie
	* 
	* @param string $cookie_name
	*
	* @return boolean - true if cookie isset - otherwise false
	*/
	public static function isCookie($cookie_name){
		return isset($_COOKIE[self::getCookieNameSpace()][$cookie_name]);
	}
	
	/**
	* method to destroy session with a particular name
	* 
	* @param string $session_name
	*
	* @return void
	*/
	public static function killSession($session_name){
		if(self::isSession($session_name)){
			$_SESSION[self::getSessionNameSpace()][$session_name] = null;
			unset($_SESSION[self::getSessionNameSpace()][$session_name]);
		}
	}
	
	/**
	* method to destroy cookie with a particular name
	* 
	* @param string $cookie_name
	*
	* @return void
	*/
	public static function killCookie($cookie_name){
		if(self::isCookie($cookie_name)){		
			$_COOKIE[self::getCookieNameSpace()][$cookie_name] = null;
			unset($_COOKIE[self::getCookieNameSpace()][$cookie_name]);
		}
	}
	
	/**
	 * login
	 * 
	 * @param string $username
	 * @param string $password
	 * @param boolean $create_session optional default true
	 * 
	 * @throws Exception
	 * 
	 * @todo implement restriction for user to one or multiple interfaces
	 */
	final public static function login($username, $password, $create_session = true){
		// load user by username
		try{
			// get user where status is not deleted
			$objDBConn = XCustomApplication::instance()->connection->prepare('SELECT * FROM user WHERE status_id != :deleted AND username LIKE :username');
			$objDBConn->execute(array(':deleted' => XCUSTOM_APP_STATUS_DELETED, ':username' => $username));
			$objUser = $objDBConn->fetchObject();
			
			// user record not found
			if(!$objUser){
				throw new Exception('Invalid login details');
			}
						
			// check the password
			if( strcmp($objUser->password, self::encryptPassword($objUser->id, $password)) != 0){
				// error: invalid login details supplied
				throw new Exception('User password invalid');
			}
			
			// for security sake, password get to be ****
			$objUser->password 			= str_repeat('*', strlen($objUser->password) * 5);
			
			// check user status
			switch ($objUser->status_id){
				case XCUSTOM_APP_STATUS_ACTIVE:
					$session_namespace = self::getSessionNameSpace();
					
					// set the is logged in flag
					$objUser->logged_in		= true;
					$objUser->login_time	= time();
					$objUser->active_token	= md5("U{$objUser->username}T{$objUser->login_time}NS{$session_namespace}");
										
					// add user object to session
					if($create_session){
						$_SESSION[$session_namespace]['xcustom_user'] = serialize($objUser);
						return true;
					}
					else{
						// respond with user permission array
						return $objUser;
					}
					
				break;
			
				// inactive account
				case XCUSTOM_APP_STATUS_INACTIVE:
					// throw error message
					throw new Exception('User account inactive');
				break;
			
				// pending approval
				case XCUSTOM_APP_STATUS_PENDING:
					// throw error message
					throw new Exception('User account pending approval');
				break;
			
				// account registration rejected
				case XCUSTOM_APP_STATUS_REJECTED:
					// throw error message
					throw new Exception('User account in a rejected state');
				break;
			
				// suspended
				case XCUSTOM_APP_STATUS_SUSPENDED:
					// throw error message
					throw new Exception('User account has suspended');
				break;
			
				// not verified
				case XCUSTOM_APP_STATUS_NOT_VERIFIED:
					// throw error message
					throw new Exception('User account has not been verified');
				break;
			
				// acount not active
				default:
					// throw error message
					throw new Exception('User account status not known');
				break;
			}
		}
		catch(Exception $e){
			// no record found
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * encrypt password using the system token, password key and the password
	 * 
	 * @param int $user_id
	 * @param string password
	 * 
	 * @return string encrypted password
	 * @note this encryption process is important for protecting user password and can be avoided by leaving the password_storage_algorithm to blank in the application config but not advisible to do so as passwords will be stored as plain text
	 */
	final private static function encryptPassword($user_id, $password){
		/*
		 * @var string get the right password storage salt from the tokens config
		 */
		$password_key 	= isset(XCustomApplication::instance()->config_tokens->password_storage_salt) ? XCustomApplication::instance()->config_tokens->password_storage_salt : null;
		
		/*
		 * @var string get the right server key from the tokens config
		 */
		$system_token	= isset(XCustomApplication::instance()->config_tokens->server_key) ? XCustomApplication::instance()->config_tokens->server_key : null;
		
		/*
		 * @var string get the right password storage algorithm from the application config
		 */
		$password_storage_algorithm = isset(XCustomApplication::instance()->config_application->password_storage_algorithm) ? XCustomApplication::instance()->config_application->password_storage_algorithm : null;
		
		// encrypt and send back the encrypted password
		switch($password_storage_algorithm){
			// password are stored using md5
			case 'md5':
				return md5("UID{$user_id}_SK{$system_token}_PW{$password}_PK{$password_key}");
			break;
			
			// password are stored using sha1
			case 'sha1':
				return sha1("UID{$user_id}_SK{$system_token}_PW{$password}_PK{$password_key}");
			break;
			
			default:
				return $password;
			break;
		}
	}
}