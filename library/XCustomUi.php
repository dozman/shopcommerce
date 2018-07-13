<?php
/**
 * XCustom Application
 *
 * @author  Peter Ramokone
 * @package Application
 * @dependency XCustomSecurity package 
 */
class XCustomUi{
	
	/**
	 * @var array list of ui params
	 */
	protected	$_ui_param 		= [];
	
	/**
	 * initialising all the parameters used as null by default
	 */
	public function __construct(){
		$this->_ui_param['doctype'] 			= null;
		$this->_ui_param['title'] 				= null;
		$this->_ui_param['sub_title'] 			= null;
		$this->_ui_param['crumbtrail'] 			= null;
	
		// meta data
		$this->_ui_param['meta_title'] 			= null;
		$this->_ui_param['meta_keywords'] 		= null;
		$this->_ui_param['meta_description'] 	= null;
		$this->_ui_param['meta_redirect'] 		= null;
		$this->_ui_param['language'] 			= null;
		
		
		$this->_ui_param['layout_content'] 		= null;
		$this->_ui_param['view_content'] 		= null;
		$this->_ui_param['errors_and_notices'] 	= null;
	}
	
	 /**
     * set UI param
     *
     * @param string $name - The location in the ArrayObject in which to store 
     * @param mixed $data -  The object to store in the ArrayObject.
     * @return void
     */
    public function set($name,$data){
       	$this->_ui_param[$name] = $data;
    }
	
	 /**
     * set UI param
     *
     * @param string $name - name will be converted to clean string with no spaces and only underscores
     * @param mixed $data -  The object to store in the ArrayObject.
     * @return void
     */
    public function get($name){
       	return array_key_exists($name, $this->_ui_param) ? $this->_ui_param[$name] : null;
    }
}