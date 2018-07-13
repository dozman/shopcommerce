<?php
/**
 * XCustom Http
 *
 * @author  Peter Ramokone
 * @package Http Request & Response Handler
 */
class XCustomFormat{
 	
 	/**
 	 * get money formated string
 	 *
 	 * @param mixed $amount
	 * @param boolean $friendly optional - default false
 	 * 
 	 * @return string
	 *
	 * @note if the $friendly is set to true, the  the return value will be formated as human readable i.e. 3250150.00 will return as 3, 250, 150.00
 	 */
	public static function getMoney($amount, $friendly = false ){
		// get friendly format
		if($friendly){
			return number_format($amount, 2, '.', ',');
		}
		else{
			if(! function_exists('money_format')){
				return sprintf("%01.2f",$amount);
			}
			else{
				return sprintf("%01.2f", $amount);
			}
		}
	}
	
	/**
 	 * get a formated table name based on the framework standards
 	 *
 	 * @param string $table_name
 	 * 
 	 * @return string
 	 */
	public static function getTableName($table_name){
		return strtolower(str_replace(array(' ', '-'), array('_','_'), $table_name));
	}
	
	/**
 	 * get a formated component based on the framework standards
 	 *
 	 * @param string $component
 	 * 
 	 * @return string
 	 */
	public static function getComponentName($component){
		return strtolower(str_replace(array(' ', '_'), array('-','-'), $component));
	}
	
	/**
 	 * get a formated module based on the framework standards
 	 *
 	 * @param string $module
 	 * 
 	 * @return string
 	 */
	public static function getModuleName($module){
		return strtolower(str_replace(array(' ', '_'), array('-','-'), $module));
	}
	
	
	/**
	 * get Friendly Filesize
	 *
	 * @param long $bytes
	 * @param string $spacer - optional default: &nbsp;
	 * @param int $mode - optional default : 1
	 * 
	 * 0 = ultrashort = B, K, M, G, T
	 * 1 = short = B, KB, MB, GB, TB
	 * 2 = long = Byte, KiloByte, MegaByte, GigaByte, TeraByte
	 * 
	 * @return string
	 */
	public static function getFriendlyFilesize($bytes, $spacer = '&nbsp;', $mode = 1) {
		switch($mode){
			case 1:
				$unit	= array('B','K','M','G','T','P');
			break; 
			
			case 2:
				$unit	= array('B','KB','MB','GB','TB','PB');
			break; 
			
			case 3:
			default:
				$unit	= array('Byte','KiloByte','MegaByte','GigaByte','TeraByte','pb');
			break; 
		}
		 
   		return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2).' '.$unit[$i];
   
	}
	
	/**
	 * format file name for save downloading
	 *
	 * @param string $filename
	 * 
	 * @return string
	 */
	public static function getFilename($filename){
		return preg_replace(array('/&/','/\s+/','/[^a-z0-9\s_,\-\.]+/i'), array('and','-',''), $filename);
	}
	
	
	/**
	 * get friendly percentage
	 * 
	 * @param int $percentage
	 * 
	 * @return string
	 */
	public static function getFriendlyPercentage($percentage){
		return ( strstr($percentage, '.00')) ? number_format($percentage, 0) : $percentage;
	}
    
    /**
     * format name as class name
     *
     * @param string $name
     * 
     * @return string
     */
    public static function getClassName($name){
        $name = preg_replace(array('/\s+/','/[^a-z0-9\s_,\-\.]+/i'), array(' ',''), $name);
        $name = strtolower(str_replace(array('-', '_'), array(' ',' '), $name));
        $name = preg_replace(array('/\s{2,}/'), array(' '), $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }
    
     /**
     * format name as method name
     *
     * @param string $name
     * 
     * @return string
     */
    public static function getMethodName($name){        
        $name = preg_replace(array('/\s+/','/[^a-z0-9\s_,\-\.]+/i'), array(' ',''), $name);
        $name = strtolower(str_replace(array('-', '_'), array(' ',' '), $name));
        $name = preg_replace(array('/\s{2,}/'), array(' '), $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        $name = strtolower(substr($name, 0,1)) . '' . substr($name, 1);
        return $name;
    }
    
     /**
     * format name as function name
     *
     * @param string $name
     * 
     * @return string
     */
    public static function getFunctionName($name){
        $name = preg_replace(array('/\s+/','/[^a-z0-9\s_,\-\.]+/i'), array(' ',''), $name);
        $name = strtolower(str_replace(array('-', '_'), array(' ',' '), $name));
        $name = preg_replace(array('/\s{2,}/'), array(' '), $name);
        $name = str_replace(' ', '_', $name);
        return $name;
    }
}
