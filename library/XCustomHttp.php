<?php
/**
 * XCustom Http
 *
 * @author  Peter Ramokone
 * @package Http Request & Response Handler
 */
class XCustomHttp
{
	/**
	 * add no cache headers to HTTP response
	 */
	public static function addNoCacheHeaders() {
		// add date in the past header
		header('Expires: 0');
	
		// ad  always modified header
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	
		// add HTTP/1.1 header
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
	
		// add HTTP/1.0 header
		header("Pragma: no-cache");
	}
	
	/**
	 * This function retrives the port the server is using to make this call
	 *
	 * @param boolean $ignore_query_string : optionla - default false
	 *
	 * - by default: port 80 is returned, which is the http port
	 * - this will help in most cases where the classes is used where server variables are unavailable
	 */
	public static function getUri($ignore_query_string = false){
		// check this 1st uri IIS will catch
		if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
			$uri = $_SERVER['HTTP_X_REWRITE_URL'];
		}
		// normal uri
		elseif (isset($_SERVER['REQUEST_URI'])) {
			$uri = $_SERVER['REQUEST_URI'];
		}
		// uri on IIS 5.0, PHP as CGI environment
		elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
			$uri = $_SERVER['ORIG_PATH_INFO'];
		}
		// get uri from script name
		else {
			$uri = self::getScriptName();
		}
	
		// stop before the query string
		if($ignore_query_string && ($pos = strpos($uri, "?")) !== false) {
			$uri = basename(substr($uri, 0, $pos));
		}
	
		return $uri;
	}
		
	/**
	 * get request script name
	 *
	 * @return string
	 */
	public static function getScriptName(){
		return $_SERVER['SCRIPT_NAME'];
	}
	
	/**
	* This function retrives the port the server is using to make this call
	*
	* - by default: port 80 is returned, which is the http port
	* - this will help in most cases where the classes is used where server variables are unavailable
	*/
	public static function getPort(){
		return (isset($_SERVER['SERVER_PORT']))? $_SERVER['SERVER_PORT'] : null;
	} 
	
	/**
	* method to retrieve the string version of the port
	*
	* @return string
	*/
	public static function getPortString(){
		// get port string based on https on / off
		return self::isSecure() ? 'https' : 'http';
	} 
	
	/**
	 * get server address
	 *
	 * @return string
	 */
	public static function getServerIp(){
		return isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1';
	}
	
	/**
	 * get server admin
	 *
	 * @return string
	 */
	public static function getServerAdmin(){
		return isset($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : null;
	}
	
	/**
	 * check if request is ajax/jason
	 * 
	 * @return boolean
	 */
	public static function isAjax(){		
		// check the xml httml reuset from server array
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			return ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
		}
		
		// check from server header
		 if (function_exists('apache_request_headers')) {
		 	// get all headers
            $headers = apache_request_headers();
			
			// check for x header
           return ( isset($headers['X_REQUESTED_WITH']) && $headers['X_REQUESTED_WITH'] == 'XMLHttpRequest');
        }
		
		// no server headers
		return false;
	}
	
	/**
     * check if request is of https/ssl
     *
     * @return boolean
     */
    public static function isSecure(){
        return ((isset($_SERVER['HTTPS'])) &&  $_SERVER['HTTPS'] === 'on');
    }
    
    /**
 	 * check if we have internet connection
 	 * 
 	 * this will check to see if the local machine is connected to the web
 	 * uses sockets to open a connection to given domain
 	 * 
 	 * @param string $domain optional default google.com
 	 * @param string $port optional : default 80 - http
 	 *
 	 * @return boolean fals for no internet connection
 	 */
 	public static function hasInternetConnection($domain = 'google.com', $port = 80) {
 		// try to open a socket connection	   
	    if ( $socket = @fsockopen($domain, $port) ) {
	        // close bthe socket
	        fclose($socket);
	        // we have connection
	        return true;
	    }
	    // no connection	   
	    return false;
	}
	
	/**
	* this method will help retrieving current user's IP Address
	*
	* @return string
	**/
	public static function getIpAddress(){
		//check ip from share internet
	    if( getenv('HTTP_CLIENT_IP') ){
	    	return getenv('HTTP_CLIENT_IP');
	    }
		//to check ip is pass from proxy
		else if (getenv('HTTP_X_FORWARDED_FOR') && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', getenv('HTTP_X_FORWARDED_FOR'), $matches)){
		// make sure we dont pick up an internal IP defined by RFC1918
			foreach ($matches[0] AS $ip){
				if (!preg_match("#^(10|172\.16|192\.168)\.#", $ip)){
					// found valid id
					return $ip;
				}
			}				
		}
		// http from has been specified
		else if (getenv('HTTP_FROM')){
			return getenv('HTTP_FROM');
		}

		// normal user ip address
		return getenv('REMOTE_ADDR');
	}	
	
	/**
	* this method will help retrieving current user's agent: browser name
	*
	* @return string
	**/
	public static function getUserAgent(){
		//check ip from share internet
	    if( getenv('HTTP_USER_AGENT') ){
	    	return getenv('HTTP_USER_AGENT');
	    }
		// normal user ip address
		return getenv('REMOTE_ADDR');
	
	}
		
	/**
     * get the request status
     *
     * @return int - default 200
     */
    public static function getStatus(){
        return isset($_SERVER['REDIRECT_STATUS']) ? $_SERVER['REDIRECT_STATUS'] : 200;
    }
	
	/**
	 * get request time
	 * 
	 * @return timestamp
	 */
	public static function getTime(){
		return isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
	}
	
	/**
	 * get method
	 * 
	 * @return string - GET|POST|DELETE|PUT
	 * 
	 * @throws Exception
	 */
	public static function getMethod(){
		// set the initial method from server vars
		$strMethod = $_SERVER['REQUEST_METHOD'];
		
		// method for delete and put
		if ($strMethod == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
				$strMethod = 'DELETE';
			} 
			else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
				$strMethod = 'PUT';
			}
		}
		// send back the http request method
		return $strMethod;
	} 
	
	/**
	* method to retrieve the Domain Name
	* - if the Server http host is not set, then the settings DomainName will be used
	*
	* @return string
	*/
	public static function getDomainName(){
		return (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : ( isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost' );
	}
	
	/**
	* method to retrieve the complete url request
	* - http://domain.name/uri?with=querystring
	*
	* @return string
	*/
	public static function getFullUrl(){
		// get port string http / https
		$strPortString 	= self::getPortString();
		
		// get domain name
		$strDomain 		= self::getDomainName();
		
		//Get the REQUEST_URI. i.e. The Uniform Resource Identifier.
		$strUri 		= self::getUri();
		
		// send back a constructed the full url & prevent XSS attacks
		return $strPortString . '://' . htmlentities($strDomain) . '/' . htmlentities($strUri);
	}
	
	
	/**
	* method to check if form has been posted
	*
	* @return boolean - true if posted - otherwise false
	*/
	public static function isPosted(){
		return (isset($_SERVER, $_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post');
	}
	
	/**
	* method to check if form has been posted
	*
	* @return boolean - true if posted - otherwise false
	*/
	public static function isUploaded($name = null){
		if(is_null($name)){
			return (isset($_FILES)); 
		}
		else{
			if(isset($_FILES,$_FILES[$name],$_FILES[$name]['tmp_name']) && $_FILES[$name]['tmp_name']){
				return true;
			}
			else{
				return false; 
			}
		}		
	}
	
	/**
	* method to check if data has been posted with a particular name
	* - there is no limit in number of variable to send
	*
	* @param mixed $post_variable
	* @return boolena - true if posted - otherwise false
	*/
	public static function isPost(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	
			if(! array_key_exists($arguments_list[$argument_index],$_POST) ){
				// Fee memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;														
			}
    	}
		// Fee memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if data has been posted with empty data
	* - there is no limit in number of variable to send
	*
	* @param mixed $post_variable
	* @return boolena - true if any of the post empty - otherwise false
	*/
	public static function isEmptyPost(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	
			if(! isset($_POST[$arguments_list[$argument_index]]) ){
				// Fee memory				
				unset($number_of_arguments);
				unset($arguments_list);
				return true;														
			}
			else{
				if(is_array($_POST[$arguments_list[$argument_index]])){
					if(count($_POST[$arguments_list[$argument_index]]) <= 0){
						return true;
					}
				}
				elseif(empty($_POST[$arguments_list[$argument_index]]) || 
						 trim($_POST[$arguments_list[$argument_index]]) == '' || 
						 is_null($_POST[$arguments_list[$argument_index]])){						 
					return true;
				}
			}	
    	}
		// Fee memory
		unset($number_of_arguments);
		unset($arguments_list);
		return false;
	}
	
	/**
	* method to retrieve form data for a particular field 
	*
	* @param mixed $field_name
	* @return mixed - this will return null if field not set
	*/
	public static function getPost($field_name, $default_value = null){
		if(isset($_POST[$field_name])){
			return (is_array($_POST[$field_name])) ? $_POST[$field_name] : stripslashes(trim($_POST[$field_name]));
		}
		return $default_value;
	}
	
	/**
	* method to retrieve form data for all posts
	*
	* @return array - this will return null if field not set
	*/
	public static function getPosts(){
		return (isset($_POST)) ? $_POST : NULL;
	}
	
	/**
	* method to retrieve form data for a particular file field 
	*
	* @param mixed $field_name
	* @return array - this will return null if field not set
	*  
	*  - This variable contains the folowing as array
	*  	[name] 		=> index.form
        [type] 		=> application/octet-stream
        [tmp_name] 	=> /development/ketroute/framework/tmp/cda3A.tmp
        [error] 	=> 0
        [size] 		=> 1302
        
    * The index of error is the upload error flag as per php core 
    * - 0 as CONSTANT UPLOAD_ERR_OK: file uploaded ok
    * - 1 as CONSTANT UPLOAD_ERR_INI_SIZE: The uploaded file exceeds the upload_max_filesize directive in php.ini    
    * - 2 as CONSTANT UPLOAD_ERR_FORM_SIZE: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form   
    * - 3 as CONSTANT UPLOAD_ERR_PARTIAL: The uploaded file was only partially "not wholly" uploaded  
    * - 4 as CONSTANT UPLOAD_ERR_NO_FILE: no file was uploaded  
    * - 6 as CONSTANT UPLOAD_ERR_NO_TMP_DIR: Missing tmp folder 
    * - 7 as CONSTANT UPLOAD_ERR_CANT_WRITE: Failed to write to disk 
    * - 8 as CONSTANT UPLOAD_ERR_EXTENSION: Error stopped by extension 
    * 
    *  Readmore about the upload error on: http://www.php.net/features.file-upload.errors
	*/
	public static function getUpload($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name] : NULL;
	}
	
	/**
	* method to retrieve form uploaded file size for a particular file field 
	*
	* @param mixed $field_name
	* @return int - this will return 0 on failiar
	*/
	public static function getUploadSize($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['size'] : 0;
	}
	
	/**
	* method to retrieve form uploaded file error for a particular file field 
	*
	* @param mixed $field_name
	* @return int - this will return false on failiar
	*/
	public static function getUploadError($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['error'] : false;
	}
	
	/**
	* method to retrieve form uploaded file name for a particular file field 
	*
	* @param mixed $field_name
	* @return string - this will return null on failiar
	*/
	public static function getUploadName($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['name'] : null;
	}
	
	/**
	* method to retrieve form uploaded file mime for a particular file field 
	*
	* @param mixed $field_name
	* @return string - this will return null on failiar
	*/
	public static function getUploadMime($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['type'] : null;
	}
	
	/**
	* method to retrieve form uploaded file data for a particular file field 
	*
	* @param mixed $field_name
	* @return string - this will return null on failiar
	*/
	public static function getUploadData($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['tmp_name'] : null;
	}
	
	/**
	* method to retrieve form uploaded file content for a particular temporary file 
	*
	* @param mixed $field_name
	* @return string - this will return null on failiar
	*/
	public static function getUploadContent($field_name){
		return (self::isUpload($field_name)) ? file_get_contents($_FILES[$field_name]['tmp_name']) : null;
	}
	
	/**
	* method to retrieve form uploaded file  for a particular file field 
	*
	* @param mixed $field_name
	* @return string - this will return null on failiar
	*/
	public static function getUploadFile($field_name){
		return (self::isUpload($field_name)) ? $_FILES[$field_name]['tmp_name'] : null;
	}
	
	/**
	 *  This function helps with redirect to a different page in the current directory that was requested
	 * - it also checks if headers are already sent, then uses the javascript as an alternative redirect
	 *
	 * 
	 * @param string $url
	 * @param boolean $force_native_redirect - optional: deafult false
	 * 
	 * @note $force_native_redirect can be used as false when you want to do a hard/native redirect regardless of the request being ajax
	 * 
	 * @return void
	 */
	public static function	redirect($url = null, $force_native_redirect = false){
		$alternative_url = XCustomApplication::instance()->site_dir . XCustomApplication::instance()->access_context;
		
		$url = (is_null($url) || $url == '') ? $alternative_url : $url;
		
		// content already outputten to the response
		if(headers_sent() || $force_native_redirect)
	  	{
			$script = '<script language=javascript>';
			$script.= 'location.href="'.$url.'";';
			$script.= '</script>';
			echo $script;
			exit;
	  	}
	  	else{
	  		header("Location:{$url}");
			exit;
	  	}
	}	
	
}