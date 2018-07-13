<?php
/**
 * XCustom Validate
 *
 * @author  Peter Ramokone
 * @package Validate
 */
class XCustomValidate {
		
	/**
	* method to check if variables are numeric 
	* - there is no limit in number of variables to send
	* 
	 * @usage XCustomValidate::isNumeric($var)
	*
	* 
	* @return boolean - true if numeric - otherwise false
	*/
	public static function isNumeric(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	
			if(! is_numeric($arguments_list[$argument_index]) ){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;														
			}
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	 * check if the given string does not exceeding maximum given value
	 * 
	 * @param string
	 * @param int
	 * 
	 * @return boolean - true if numeric - otherwise false
	 */
	public static function isTooLong($string, $max){
		return (strlen($string) > $max) ? true : false;
	}
	
	/**
	 * check if the given string does not less than the given minumum given value
	 * 
	 * @param string
	 * @param int
	 * 
	 * @return boolean - true if numeric - otherwise false
	 */
	public static function isTooShort($string, $min){
		return (strlen($string) < $min) ? true : false;
	}
	
	/**
	 * check if the given string does not exceeding maximum given value
	 * 
	 * @param string
	 * @param int
	 * 
	 * @return boolean - true if numeric - otherwise false
	 */
	public static function isNotTooLong($string, $max){
		return (strlen($string) > $max) ? false : true;
	}
	
	/**
	 * check if the given string does not less than the given minumum given value
	 * 
	 * @param string
	 * @param int
	 * 
	 * @return boolean - true if numeric - otherwise false
	 */
	public static function isNotTooShort($string, $min){
		return (strlen($string) < $min) ? false : true;
	}
	
	/**
	 * check if the given string has allowed length given minumum and maximum value
	 * 
	 * @param string
	 * @param int min
	 * @param int max
	 * 
	 * @return boolean - true if length allowed - otherwise false
	 */
	public static function isLength($string, $min, $max){
		return (strlen($string) < $min || strlen($string) > $max) ? false : true;
	}

	/**
	* method to check if variables are null 
	* - there is no limit in number of variables to send
	*
	* 
	* @return boolean - true if null - otherwise false
	*/
	public static function isNull(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	if(! is_null($arguments_list[$argument_index]) ){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;														
			}
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if ip is valid 
	* - there is no limit in number of variables to send
	* - this function uses the php buildin function ip2long
	* 
	 * @usage XCustomValidate::isIp($var)
	* 
	* @return boolean - true if null - otherwise false
	*/
	public static function isIp(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	if( ip2long((string)$arguments_list[$argument_index]) == -1 || 
        	ip2long((string)$arguments_list[$argument_index]) === FALSE ){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;														
			}
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}	
	
	/**
	* method to check if date time is valid 
	* - there is no limit in number of variables to send	
	* - this function also uses the php buildin function checkdate
	* - the valid format is 2007/04/26 06:30:00
	* 
	* @usage XCustomValidate::isValidDateTimeSlash(datetime)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidDateTimeSlash(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			
			if (preg_match("/^(\d{4})/(\d{2})/(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",
			$arguments_list[$argument_index], $matches)) {
		        if(isset($matches[2], $matches[3], $matches[1]) && is_numeric($matches[1]) && is_numeric($matches[2]) && is_numeric($matches[3])){
		        	if (! checkdate($matches[2], $matches[3], $matches[1])) {
			            // Free memory
						unset($number_of_arguments);
						unset($arguments_list);
		        		return false;
			        }
		        }
		        else{
		        	// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
		        	return false;
		        }
		    }
		    else{
		    	// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
		    	return false;
		    }
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}	
	
	/**
	* method to check if date time is valid 
	* - there is no limit in number of variables to send	
	* - this function also uses the php buildin function checkdate
	* - the valid format is 2007-04-26 06:30:00
	* 
	* @usage XCustomValidate::isValidDateTimeHyphen(datetime)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidDateTimeHyphen(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			
			if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",
			$arguments_list[$argument_index], $matches)) {
				if(isset($matches[2], $matches[3], $matches[1]) && is_numeric($matches[1]) && is_numeric($matches[2]) && is_numeric($matches[3])){
		        	if (! checkdate($matches[2], $matches[3], $matches[1])) {
			            // Free memory
						unset($number_of_arguments);
						unset($arguments_list);
		        		return false;
			        }
		        }
		        else{
		        	// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
		        	return false;
		        }
		    }
		    else{
		    	// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
		    	return false;
		    }
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}	
		
	/**
	* method to check if date time is valid 
	* - there is no limit in number of variables to send
	* - the valid format is 10:30:00
	* 
	* @usage XCustomValidate::isValidTime(time)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidTime(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			$_time = explode(':',$arguments_list[$argument_index]);
			
			// with seconds
		    if(count($_time) == 3){
		    	$_hour 		= (int) $_time[0];
		    	$_minutes 	= (int) $_time[1];
		    	$_seconds 	= (int) $_time[2];
		    	if (! ($_hour > -1 && $_hour < 24) && ( $_minutes > -1 && $_minutes < 60) && 
		    	($_seconds > -1 && $_seconds < 60) ) {      
		        	// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;  
		        }
		    }
			// hours and minutes only
			else if(count($_time) == 2){
		    	$_hour 		= (int) $_time[0];
		    	$_minutes 	= (int) $_time[1];
		    	if (! ($_hour > -1 && $_hour < 24) && ( $_minutes > -1 && $_minutes < 60) ) {      
		        	// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;  
		        }
		    }
		    else{
		    	// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
		    }			
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}	
	
	/**
	* method to check if date is valid 
	* - there is no limit in number of variables to send	
	* - this function also uses the php buildin function checkdate
	* - the valid format is 1981/06/15
	* 
	* @usage XCustomValidate::isValidDateSlash(datetime)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidDateSlash(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			$matches = explode('/',$arguments_list[$argument_index]);
			if (! (count($matches) == 3 && is_numeric($matches[0]) && is_numeric($matches[1]) && is_numeric($matches[2]) && checkdate($matches[1], $matches[2], $matches[0])) ) {
	            // Free memory
				unset($number_of_arguments);
				unset($arguments_list);
        		return false;
	        }
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if date is valid 
	* - there is no limit in number of variables to send	
	* - this function also uses the php buildin function checkdate
	* - the valid format is 1981-06-15
	* 
	* @usage XCustomValidate::isValidDateHyphen(datetime)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidDateHyphen(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			$matches = explode('-',$arguments_list[$argument_index]);
			if (! (count($matches) == 3 && is_numeric($matches[0]) && is_numeric($matches[1]) && is_numeric($matches[2])  && checkdate($matches[1], $matches[2], $matches[0])) ) {
	            // Free memory
				unset($number_of_arguments);
				unset($arguments_list);
        		return false;
	        }
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if year is valid 
	* - there is no limit in number of variables to send	
	* - the valid format is 1981
	* 
	* @usage XCustomValidate::isValidYear(year)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isValidYear(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			if (!$arguments_list[$argument_index] || strtotime($arguments_list[$argument_index]) === false) {
	            // Free memory
				unset($number_of_arguments);
				unset($arguments_list);
        		return false;
	        }
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if domain  is valid 
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function checkdnsrr on a linux server or on windows
	* 
	* @usage XCustomValidate::isDomain(domain)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isDomain(){
		
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		if(!function_exists('checkdnsrr')){		 
		     
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				exec("nslookup -type=MX ".$arguments_list[$argument_index], $result);
		       /**
		        * look in each line to find the one that starts with the host 
		        */
		       foreach ($result as $line) {
		         if(! eregi("^{$arguments_list[$argument_index]}",$line)){
		         	// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;		           
		         }
		       }
	    	} 
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if (! checkdnsrr($arguments_list[$argument_index]) ) {	
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);				
					return false;
				}
	    	}
		}

		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;	
	}
	
	/**
	* method to check if an email address is valid 
	* - there is no limit in number of variables to send	
	* 
	* @usage XCustomValidate::isEmail(email)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isEmail(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			if(!preg_match($regex, $arguments_list[$argument_index])){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
			}
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	} 
	
	/**
	* method to check if an coordinate is valid 
	* - there is no limit in number of variables to send	
	* 
	* @usage XCustomValidate::isCoordinate(coordinate)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isCoordinate(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		$regex = "/^[\-0-9-]+(\.[0-9]+)*$/";
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			if(!preg_match($regex, $arguments_list[$argument_index])){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
			}
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	} 
		
		
	/**
	* method to check if a string is alpha numeric 
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_alnum
	* 
	* @usage XCustomValidate::isAlphaNumeric(alphanumeric)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isAlphaNumeric(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_alnum")){
			$regex = "/^[A-Za-z0-9]*$/";
			
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(!preg_match($regex,$arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}	
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(! ctype_alnum($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
		
		
	/**
	* method to check if a string is clean text 
	* @note the clean text should only have A-z 0-9 space - _ . , ; 
	* 
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_alnum
	* - this can be alphanumeric with underscores only
	* 
	* @usage XCustomValidate::isCleanText(cleantext)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isCleanText(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_alnum")){
			$regex = "/^[A-Za-z0-9]*$/";
			
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				// remove underscores
				$arguments_list[$argument_index] = str_replace('_','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(' ','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace('-','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace('.','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(',','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(';','',$arguments_list[$argument_index]);
				
				if(!preg_match($regex,$arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}	
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				// remove underscores
				$arguments_list[$argument_index] = str_replace('_','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(' ','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace('-','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace('.','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(',','',$arguments_list[$argument_index]);
				$arguments_list[$argument_index] = str_replace(';','',$arguments_list[$argument_index]);
				
				if(! ctype_alnum($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
		
		
	/**
	* method to check if a string is monetary
	* - there is no limit in number of variables to send	
	* 
	* @usage XCustomValidate::isMoney(alphanumeric)
	* 
	* @example 2500.00 or 0.00 or even 120.3
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isMoney(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		$regex = "/^[0-9]+(.[0-9]{1,2})?$/";
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			// remove negative sign
			$arguments_list[$argument_index] = ltrim($arguments_list[$argument_index],'-');
			
			if (!is_string($arguments_list[$argument_index]) && !is_int($arguments_list[$argument_index]) && !is_float($arguments_list[$argument_index])) {
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
			}
			
			if(! preg_match($regex,$arguments_list[$argument_index])){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
			}
		}	
		
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
			
	/**
	* method to check if a string is percentage
	* - there is no limit in number of variables to send	
	* 
	* @usage XCustomValidate::isPercentage(digit)
	* 
	* @example 100
	* 
	* @note this only support percentage from 0 to 100
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isPercentage(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		
		
		$regex = "/^[0-9\.]+$/";
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			// remove negative sign
			$arguments_list[$argument_index] = ltrim($arguments_list[$argument_index],'-');
			
			if($arguments_list[$argument_index] > 100 || !preg_match($regex,$arguments_list[$argument_index])){
				// Free memory
				unset($number_of_arguments);
				unset($arguments_list);
				return false;
			}
		}	
		
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if string is digitsor numeric
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_digit
	* 
	* @usage XCustomValidate::isDigit(digits)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isDigit(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_digit")){
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(!is_numeric($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}	
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(! ctype_digit($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if string is fax number
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_digit
	* 
	* @usage XCustomValidate::isFax(fax)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isFax(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_digit")){
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(!is_numeric($arguments_list[$argument_index]) || ( strlen($arguments_list[$argument_index]) < 10 || strlen($arguments_list[$argument_index]) > 15) ){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}	
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(! ctype_digit($arguments_list[$argument_index]) || (strlen($arguments_list[$argument_index]) < 10 || strlen($arguments_list[$argument_index]) > 15)){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	
	/**
	* method to check if string is mobile number
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_digit
	* 
	* @usage XCustomValidate::isMobile(mobile)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isMobile(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_digit")){
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(!is_numeric($arguments_list[$argument_index]) || strlen($arguments_list[$argument_index]) < 10  ){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}	
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(! ctype_digit($arguments_list[$argument_index]) || strlen($arguments_list[$argument_index]) < 10 ){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	* method to check if string contaons only a to z characters
	* - there is no limit in number of variables to send	
	* - this function uses the php buildin function ctype_alpha
	* 
	* @usage XCustomValidate::isAtoZ(chars)
	* 
	* 
	* @return boolean - true if valid - otherwise false
	*/
	public static function isAtoZ( ){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		if(! function_exists("ctype_alpha")){
			$regex = "/^[A-Za-z]+$/";
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {				
				if(!preg_match($regex,$arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}
		}
		else{
			for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
				if(! ctype_alpha($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			}				
		}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
 	/**
	* method to check if url  is valid 
	* - there is no limit in number of variables to send	
	* - format expected is :
	*         http(s)://www.site.co.za
	* 		  ftp(s)://www.site.co.za
	* 		  www.site.co.za
	* 		  10.0.0.1 	
	* 
	* @usage XCustomValidate::isURL(url)
	* @note if ip address is entered in the place of a url, it will be validated as such, see isIp Method
	* 
	* @return boolean - true if valid - otherwise false
	*/	
	public static function isURL() { 	
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
        	if (! preg_match("/^(?:(https?|ftps?:\/\/))*([a-zA-Z0-9]{3,})+([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+$)/i", $arguments_list[$argument_index]) ) {
				// this might be an ip, we need to check
				if(!self::isIp($arguments_list[$argument_index])){
					// Free memory
					unset($number_of_arguments);
					unset($arguments_list);
					return false;
				}
			} 
    	}
		// Free memory
		unset($number_of_arguments);
		unset($arguments_list);
		return true;
	}
	
	/**
	 * check if the two date period are valid
	 * 
	 * - start date & end date comparison, inclusive/exclusive of time
	 *  i.e 2008-01-01 10:20:00 or just 2008-01-01
	 *
	 * @param string  $startdate - date / datetime
	 * @param string $enddate - date / datetime
	 * @param boolean $ignore_time - optional. default: false = not to ignore time
	 * 
	 * @return boolean true if a valid date period - otherwise false
	 */
	public static function isValidPeriod($startdate,$enddate, $ignore_time = false){
		if($startdate && $enddate){
			// check if we need to ignore tine
			if($ignore_time){
				if( date('Ymd',strtotime($startdate)) <= date('Ymd',strtotime($enddate)) ){
					return true;
				}
			}
			elseif( date('YmdHis',strtotime($startdate)) <= date('YmdHis',strtotime($enddate)) ){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * check if the date is not in future stage
	 * 
	 * - date exclusive
	 *  i.e 2008-01-01
	 *
	 * @param date  $date
	 * @param date  $current_date - optional
	 * 
	 * @return boolean true if a valid date - otherwise false
	 */
	public static function isDateInFuture($date, $current_date = null){
		if($date){
			$current_date = $current_date ? date('Ymd', strtotime($current_date)) : date('Ymd');
			if( date('Ymd',strtotime($date)) > $current_date ){
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * check if the date is not in the past stage
	 * 
	 * - date exclusive
	 *  i.e 2008-01-01
	 *
	 * @param date  $date
	 * @param date  $current_date - optional
	 * 
	 * @return boolean true if a valid date - otherwise false
	 */
	public static function isDateInPast($date, $current_date = null){
		if($date){
			$current_date = $current_date ? date('Ymd', strtotime($current_date)) : date('Ymd');
			if( date('Ymd',strtotime($date)) < $current_date ){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * check if the datetime is not in future stage
	 * 
	 * - date time exclusive
	 *  i.e 2008-01-01 11:30:00 and 2008-01-01 11:30
	 *
	 * @param date  $datetime
	 * @param date  $current_datetime - optional
	 * 
	 * @return boolean true if a valid datetime - otherwise false
	 */
	public static function isDateTimeInFuture($datetime, $current_datetime = null){
		if($datetime){
			$datetime = strlen($datetime) >= 19 ? $datetime : "{$datetime}:00";
			$current_datetime = $current_datetime ? date('Ymdhis', strtotime($current_datetime)) : date('Ymdhis');
			
			if( date('Ymdhis',strtotime($datetime)) > date('Ymdhis') ){
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * check if the datetime is not in the past stage
	 * 
	 * - date exclusive
	 *  i.e 2008-01-01 11:30:00 and 2008-01-01 11:30
	 *
	 * @param date  $datetime
	 * @param date  $current_datetime - optional
	 * 
	 * @return boolean true if a valid datetime - otherwise false
	 */
	public static function isDateTimeInPast($datetime, $current_datetime = null){
		if($datetime){
			$datetime = strlen($datetime) >= 19 ? $datetime : "{$datetime}:00";
			$current_datetime = $current_datetime ? date('Ymdhis', strtotime($current_datetime)) : date('Ymdhis');
			
			if( date('Ymdhis',strtotime($datetime)) < date('Ymdhis') ){
				return true;
			}
		}
		return false;
	}	
	
	/**
	 * check if the time is not in future stage
	 * 
	 * - time exclusive
	 *  i.e 11:30:00 and 11:30
	 *
	 * @param time  $time
	 * @param date  $current_time - optional
	 * 
	 * @return boolean true if a valid time - otherwise false
	 */
	public static function isTimeInFuture($time, $current_time = null){
		if($datetime){
			$time = strlen($time) >= 8 ? $time : "{$time}:00";
			$current_time = $current_time ? date('his', strtotime($current_time)) : date('his');
			
			if( date('his',strtotime($time)) > date('his') ){
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * check if the time is not in the past stage
	 * 
	 * - date exclusive
	 *  i.e 11:30:00 and 11:30
	 *
	 * @param time  $time
	 * @param time  $current_time - optional
	 * 
	 * @return boolean true if a valid time - otherwise false
	 */
	public static function isTimeInPast($time, $current_time = null){
		if($datetime){
			$time = strlen($time) >= 8 ? $time : "{$time}:00";
			$current_time = $current_time ? date('his', strtotime($current_time)) : date('his');
			
			if( date('his',strtotime($time)) < date('his') ){
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * check if the year is not in future stage
	 * 
	 * @param year  $year
	 * @param year  $current_year - optional
	 * 
	 * @return boolean true if a valid year - otherwise false
	 */
	public static function isYearInFuture($year, $current_year = null){
		if($year){
			$current_year = $current_year ? date('Y', strtotime($current_year)) : date('Y');
			
			if( date('Y',strtotime($year)) > date('Y') ){
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * check if the year is not in the past stage
	 * 
	 * @param year  $year
	 * @param year  $current_year - optional
	 * 
	 * @return boolean true if a valid year - otherwise false
	 */
	public static function isYearInPast($year, $current_year = null){
		if($year){
			$current_year = $current_year ? date('Y', strtotime($current_year)) : date('Y');
			
			if( date('Y',strtotime($year)) < date('Y') ){
				return true;
			}
		}
		return false;
	}	
	
	/**
	 * check if the date is today's date
	 * 
	 * - date exclusive
	 *  i.e 2008-01-01
	 *
	 * @param date  $date
	 * 
	 * @return boolean true if a valid date - otherwise false
	 */
	public static function isDateToday($date){
		if($date){
			if( date('Ymd',strtotime($date)) == date('Ymd') ){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * check if date is set
	 * 
	 * @param mixed $date
	 * 
	 * 2009-02-05 - true
	 * 0000-00-00 - false
	 * 
	 * 2009-02-05 00:00:00 - true
	 * 
	 * @return boolean true if a date or time is set - otherwise false
	 *
	 */
	public static function isDateSet($date){
		return ( (int) str_replace(':','', str_replace('-','', str_replace('/','', str_replace(' ','',$date)))));
	}
	
	/**
	 * check if the date is within a given period
	 *
	 * @param date $date
	 * @param date $start
	 * @param date $end
	 * 
	 * @return boolean
	 */
	public static function isDateBetweenPeriods($date, $start, $end){
		// check for date before start date
		if(strtotime($date) < strtotime($start)){
			return false;
		}
		// check for date after end date
		elseif(strtotime($date) > strtotime($end)){
			return false;
		}
		// a valid date
		return true;
	}
	
	/**
	 * check if this is a valid sa id
	 * 
	 * at the moment we just check for 13 digits
	 * with a valid month and day
	 * 
	 * if this becomes a problem, here a tip to go forward:
	 * {YYMMDD}{G}{SSS}{A}{Z}
	 * YYMMDD: Date of birth
	 * G  : Gender. 0-4 Female; 5-9 Male.
	 * SSS  : Sequence No. for DOB/G combination.
	 * C  : Citizenship. 0 SA; 1 Other.
	 * A  : Usually 8, or 9 (can be other values)
	 * Z  : Control digit.
	 * 
	 *
	 * @param string $id_number
	 * 
	 * @return boolean
	 */
	public static function isSAID($id_number){
		//  check length
		if(strlen($id_number) != 13)	{
			return false;
		}
		
		// check digits
		if(!self::isDigit($id_number)){
			return false;
		}
		
		// check for month
		if(!( substr($id_number,2,2) >= 1 && substr($id_number,2,2) <= 12) ){
			return false;
		}
		
		// check for day
		if(!( substr($id_number,4,2) >= 1 && substr($id_number,4,2) <= 31) ){
			return false;
		}
		
		// check for date of birth
		if(!self::isValidDateHyphen(date('Y-m-d',strtotime(substr($id_number,2,2).'/'.substr($id_number,4,2).'/'.substr($id_number,0,2))))){
			return false;
		}
		
		// valid sa id
		return true;
	}
	
	/**
	 * check if the size uploaded is a valid size
	 * 
	 * @note this will check the size against server serttings: post_max_size and upload_max_filesize
	 * 
	 * @param float $filesize
	 * 
	 * @boolean
	 */
	public static function isValidServerUploadSize($file_size){
		// post max size for the form post
		$post_max_size= XCustomGeneric::sizeToBytes(ini_get('post_max_size'));
		
		// post max size for the form upload
	    $upload_max_filesize = XCustomGeneric::sizeToBytes(ini_get('upload_max_filesize'));        
	
	    return ($post_max_size < $file_size || $upload_max_filesize < $file_size) ? false : true;   
	}
	
	/**
	 * comparing or two mixed values
	 * 
	 * value from array
	 * two arrays
	 * compare tow strings/digits
	 * 
	 * @param mixed $value1
	 * @param mixed $value2
	 * 
	 * @return boolean
	 */
	public static function mixedComparison($value1, $value2){					
		// 	value 1 is array and second one is not
		if(is_array($value1) && !is_array($value2)){
			return (in_array($value2, $value1)) ? true : false;
		}
		// 	second value  is array and 1st one is not
		else if(!is_array($value1) && is_array($value2)){
			return (in_array($value1, $value2)) ? true : false;
		}
		// 	both  values are arrays
		else if(is_array($value1) && is_array($value2)){
			$compared = array_intersect($value1, $value2);
			return (!empty($compared)) ? true : false;
		}		
		// values are string/digits
		elseif($value1 === $value2){
			return true;
		}
		// not the same
		return false;
	}
	
	/**
	 * check if the pattern matches
	 * 
	 * @param string $value - text/string to be check against the pattern
	 * @param string $pattern
	 * 
	 * @return boolean - true when pattern is correct otherwise false
	 */
	public static function isPattern($value, $pattern){
		return preg_match($pattern, $value);
	}
	
	 /**
	  * validate if the object have propaerties
	  * 
	  * @param object $object
	  * @param array $properties
	  * 
	  * @return boolean true when all propertis exists, otherwise false
	  */
	public static function objectHaveProperties($object, $properties){
		// if no properties then 
		if(!is_object($object) || empty($properties)){return false;}
		
		foreach($properties as $prop){
			if(!isset($object->{$prop})){
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * method to check if there is matching data
	 * - there is no limit in number of variables to send
	 * - this function is meant to do comparison on strings only
	 * - the function will firstly convert all passed data to lowercase - this means that the word flower and Flower will be found the same
	 * 
	 * @usage XCustomValidate::isSameData('flower', 'budget', 'Flower')
	 *
	 *
	 * @return boolean - true if valid any passed parameter matches - otherwise false
	 */
	public static function isSameData(){
		$number_of_arguments 	= func_num_args();
		$arguments_list 		= func_get_args();
		$arguments_list 		= array_map('strtolower', $arguments_list);
		$new_arguments_list		= array();
		
		// if only one param passed - no match found
		if($number_of_arguments <= 1){
			return false;
		}
		
		for ($argument_index = 0; $argument_index < $number_of_arguments; $argument_index++) {
			$new_arguments_list = $arguments_list;
			
			// remove the current data param from list for comparisons
			unset($new_arguments_list[$argument_index]);
			
			//check if the current data is same same any other param data
			if(in_array(strtolower($arguments_list[$argument_index]), $new_arguments_list)){
				// free memory
				unset($new_arguments_list);
				unset($arguments_list);
				return true;
			}
		}
		
		// free memory
		unset($new_arguments_list);
		unset($arguments_list);
		
		// data not the same
		return false;
		
	}
}
