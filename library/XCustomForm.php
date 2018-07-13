<?php
/**
 * XCustom Http
 *
 * @author  Peter Ramokone
 * @package Form Handler
 */
class XCustomForm{
	
	const FORM_METHOD_GET 	= 'get';
	const FORM_METHOD_POST 	= 'post';
	/*
	 * @var object database engine instance
	 */
	protected 	$supported_types = ['text','password','radio','select','checkbox','file','datetime','hidden',
									'date','time','year','month','email','mobile','digit','domain','url','telephone',
									'textarea','html','yesno','ip','multipleselect','money','hex','rgb','coordinate','autocomplete'
									
									];
	
	
	protected $form_key				= null;
	protected $form_id				= 'form-id';
	protected $form_name			= 'form-name';
	protected $form_action			= null;
	protected $form_method			= XCustomForm::FORM_METHOD_POST;
	protected $form_autocomplete 	= true;
	protected $form_elements		= [];
	protected $form_values			= [];
	protected $success 				= false;
	protected $error_message 		= null;
	
	
	public function __construct(){
		$this->form_key 	= XCustomApplication::instance()->config_application->form_key;
		$this->form_action 	= XCustomHttp::getUri();
		$this->form_method 	= XCustomApplication::instance()->config_application->form_key;
	}
	
	public function setKey($value)			{ $this->form_key 			= $value;}
	public function setId($value)			{ $this->form_id 			= $value;}
	public function setName($value)			{ $this->form_name 			= $value;}
	public function setAction($value)		{ $this->form_action 		= $value;}
	public function setMethod($value)		{ $this->form_method 		= $value;}
	public function setAutocomplete($value)	{ $this->form_autocomplete 	= $value ? 'on' : 'off';}
	public function setElements($value)		{ $this->form_elements 		= $value;}
	public function setValues($value)		{ $this->form_values 		= is_array($value) ? array_merge($this->form_values,$value) : $this->form_values;}
	
	public function getKey()			{ return $this->form_key;}
	public function getId()				{ return $this->form_id;}
	public function getName()			{ return $this->form_name;}
	public function getAction()			{ return $this->form_action;}
	public function getMethod()			{ return $this->form_method;}
	public function getAutocomplete()	{ return $this->form_autocomplete;}
	public function getElements()		{ return $this->form_elements;}
	public function getValues()			{ return $this->form_values;}
	
	/**
	 * generate form
	 * 
	 * @note this will generate an html version of a form
	 * @param boolean $elements_only optional default false
	 * 
	 * @return string;
	 */
	public function generateForm($elements_only = false){
		$strForm = '';
		$arrAttr = [];
			
		
		if(!$elements_only){
			($this->form_id) 			? $arrAttr['id'] 			= $this->form_id 			: null;
			($this->form_name) 			? $arrAttr['name'] 			= $this->form_name			: null;
			($this->form_action) 		? $arrAttr['action'] 		= $this->form_action		: null;
			($this->form_method) 		? $arrAttr['method'] 		= $this->form_method		: null;
			($this->form_autocomplete) 	? $arrAttr['autocomplete']	= 'on'						: 'off';
			
			$strForm .= '<form';
			
			foreach($arrAttr as $key => $val){
				$strForm .= "{$key}=\"{$val}\"";
			}
			
			$strForm .= '>';
		}
		
		// check if we have elements
		if(!empty($this->form_elements)){
			$intTabIndex = 1;
			foreach($this->form_elements as $key => $element){
				// make sure all non optional attributes are set
				$element = $this->generateDefaultAttr($element, $key);
				
				switch($element['type']){
					case 'text':
					case 'password':
						$strForm .= '<div class="form-group">';
						$strForm .= "<label for=\"{$element['id']}\">{$element['label']}: </label>";
						$strForm .= "<input id=\"{$element['id']}\" name=\"{$element['datakey']}\" placeholder=\"{$element['placeholder']}\" type=\"{$element['type']}\" autocomplete=\"{$element['autocomplete']}\" required=\"{$element['required']}\" maxlength=\"{$element['maxlength']}\" tip=\"{$element['tip']}\" tabindex=\"{$intTabIndex}\" value=\"{$element['value']}\" >";
						$strForm .= '</div>';
						$intTabIndex++;	
					break;
						
					case 'email':
						$strForm .= '<div class="form-group">';
						$strForm .= "<label for=\"{$element['id']}\">{$element['label']}: </label>";
						$strForm .= "<input id=\"{$element['id']}\" name=\"{$element['datakey']}\" placeholder=\"{$element['placeholder']}\" type=\"{$element['type']}\" autocomplete=\"{$element['autocomplete']}\" required=\"{$element['required']}\" maxlength=\"{$element['maxlength']}\" tip=\"{$element['tip']}\" tabindex=\"{$intTabIndex}\" value=\"{$element['value']}\" >";
						$strForm .= '</div>';
						$intTabIndex++;
					break;
						
					case 'money':
						$strForm .= '<div class="form-group">';
						$strForm .= "<label for=\"{$element['id']}\">{$element['label']}: </label>";
						$strForm .= "<input id=\"{$element['id']}\" name=\"{$element['datakey']}\" placeholder=\"{$element['placeholder']}\" type=\"{$element['type']}\" autocomplete=\"{$element['autocomplete']}\" required=\"{$element['required']}\" maxlength=\"{$element['maxlength']}\" tip=\"{$element['tip']}\" tabindex=\"{$intTabIndex}\" value=\"{$element['value']}\" >";
						$strForm .= '</div>';
						$intTabIndex++;
					break;
						
					case 'select':
						$strForm .= '<div class="form-group">';
						$strForm .= "<label for=\"{$element['id']}\">{$element['label']}: </label>";
						$strForm .= "<select id=\"{$element['id']}\" name=\"{$element['datakey']}\" required=\"{$element['required']}\" tip=\"{$element['tip']}\" tabindex=\"{$intTabIndex}\">";
						foreach($element['data'] as $select_index => $select_value){
							$selected = ($element['value'] == $select_index) ? ' selected' : '';
							$strForm .= "<option value=\"{$select_index}\"{$selected}>{$select_value}</option>";
						}
						$strForm .= '</select>';
						$strForm .= '</div>';
						$intTabIndex++;
					break;
					
					case 'hidden':
						$strForm .= "<input id=\"{$element['id']}\" name=\"{$element['datakey']}\" type=\"{$element['type']}\" value=\"{$element['value']}\" >";
					break;
				}
			}
		}
		if(!$elements_only){
			$strForm .= '</form>';
		}
		
		return $strForm;
	}
	
	/**
	 * generate default / required attribute list
	 * @param array $element
	 * @param string $key
	 * 
	 * @return array
	 */
	private function generateDefaultAttr($element, $key){
		$arrElement = $element;
		$arrElement['name'] 		= (array_key_exists('name', $element)) 			? $element['name'] : $key;
		$arrElement['label'] 		= (array_key_exists('label', $element)) 		? $element['label'] : $arrElement['name'] ;
		$arrElement['id'] 			= (array_key_exists('id', $element)) 			? $element['id'] : $arrElement['name'] ;
		$arrElement['autocomplete'] = (array_key_exists('autocomplete', $element)) 	? $element['autocomplete'] : ($this->form_autocomplete ? 'on' : 'off') ;
		$arrElement['required'] 	= (array_key_exists('required', $element)) 		? ($element['required'] ? 'Y' : 'N') : 'N' ;
		$arrElement['maxlength'] 	= (array_key_exists('max', $element)) 			? $element['max'] : null ;
		$arrElement['minlength'] 	= (array_key_exists('min', $element)) 			? $element['min'] : null ;
		$arrElement['tip'] 			= (array_key_exists('tip', $element)) 			? $element['tip'] : $arrElement['name'] ;
		$arrElement['placeholder'] 	= (array_key_exists('placeholder', $element)) 	? $element['placeholder'] : $arrElement['name'] ;
		$arrElement['datakey']		= "{$this->form_id}{$arrElement['name']}";
		
		// add value if passed / supplied		
		$arrElement['value'] 		= null;
		
		if( array_key_exists("{$this->form_id}{$arrElement['id']}", $this->form_values) ){
			$arrElement['value'] = $this->form_values["{$this->form_id}{$arrElement['id']}"];
		}
		
		return $arrElement;
		
	}
	
	/**
	 * valiadate data from form
	 * 
	 * @return void
	 * @note this process will set the properties {success => true/false , errors => array}
	 */
	public function validate(){
		// check if we have elements
		if(!empty($this->form_elements)){
			// default validation to true
			$this->success = true;
			
			foreach($this->form_elements as $key => $element){
				// make sure all non optional attributes are set
				$element = $this->generateDefaultAttr($element, $key);
				
				// trim data passed for any leading 
				$this->form_values[$element['datakey']] = trim($this->form_values[$element['datakey']]);
				
				// initialize continue validating field flag to true
				$bolContinueValidatingField = true;
				
				// require if the other field has not been supplied
				if($bolContinueValidatingField && $element['required'] === 'Y' && XCustomValidate::isNull()){
					// data value send
					if(array_key_exists($element['datakey'], $this->form_values)){
						// check for empty data
						if(empty($this->form_values[$element['datakey']])){
							// form post data is empty
							$this->success 				= false;
							$bolContinueValidatingField = false;
							$element['error_msg'] 		= "Please supply information for {$element['label']}";
						}
					}
					else{
						// form post has no variable
						$this->success 				= false;
						$bolContinueValidatingField = false;
						$element['error_msg'] 		= "No data/information found for {$element['label']}";
					}
				} 
				
				// continue with validation of field data
				if($bolContinueValidatingField){
					// check for maxlength exceeded
					if($element['maxlength'] !== null && XCustomValidate::isTooLong($this->form_values[$element['datakey']], $element['maxlength'])){
						// form post data is too long
						$this->success 				= false;
						$bolContinueValidatingField = false;
						$element['error_msg'] 		= "Text/Content entered for {$element['label']} is too long. Maximum allowed is {$element['maxlength']} characters.";
					}
				}
				
				// continue with validation of field data
				if($bolContinueValidatingField){
					// check for maxlength exceeded
					if($element['minlength'] !== null && XCustomValidate::isTooShort($this->form_values[$element['datakey']], $element['minlength'])){
						// form post data is too long
						$this->success 				= false;
						$bolContinueValidatingField = false;
						$element['error_msg'] 		= "Text/Content entered for {$element['label']} is too short. Minimum allowed allowed is {$element['maxlength']} characters.";
					}
				}
				
				// continue with validation of field data
				if($bolContinueValidatingField && $element['type'] == 'money'){
					// check for maxlength exceeded
					if(!XCustomValidate::isMoney($this->form_values[$element['datakey']])){
						// form post data is too long
						$this->success 				= false;
						$bolContinueValidatingField = false;
						$element['error_msg'] 		= "Data/Text entered for {$element['label']} is not a valid monetary value. Expected format: 25.50.";
					}
				}
				
				// continue with validation of field data
				if($bolContinueValidatingField && in_array($element['type'],['select', 'radio']) ){
					// check for maxlength exceeded
					if(!empty($this->form_values[$element['datakey']]) && !array_key_exists($this->form_values[$element['datakey']], $element['data'])){
						// form post data is too long
						$this->success 				= false;
						$bolContinueValidatingField = false;
						$element['error_msg'] 		= "Invalid option selected for {$element['label']}.";
					}
				}
					
					
					
					
				switch($element['type']){
					case 'text':
					case 'password':
						// check for 
					break;
				}
			}
			
			// failed with one or more error
			if(!$this->success){
				$this->error_message = 'Sorry, data invalid or not supplied for validation, fix error and try again.';
			}
			
			
		}
		else{
			// no form elements passed
			$this->error_message = 'No form element(s) passed for validation';
		}
		/*
		print_r($this->form_elements);
		print_r($this->form_values);
		print_r($this->success ? 'Success' : 'Failed');
		print_r($this->errors);
		print_r($this->error_message);
		exit;
		*/
	}
	
	/**
	 * get field data
	 *
	 * @return string
	 * 
	 * @note is best to call thiis only the form has been validated
	 */
	public function getFieldData($field_name){
		$datakey = "{$this->form_id}{$field_name}";
		return array_key_exists($datakey, $this->form_values) ? $this->form_values[$datakey] : null;
	}
	
	/**
	 * check if form has passed validation
	 *
	 * @return boolean
	 * @note generic error message get be retrieved usiing ->getErrorMessage(), and also note that each field that was validated will have error_msg property for full error message
	 */
	public function passedValidation(){
		return $this->success;
	}
	
	/**
	 * get the generic validation error message
	 *
	 * @return string
	 * 
	 * @note this will only be set if fomr fail validation
	 */
	public function getErrorMessage(){
		return $this->error_message;
	}
	
	/**
	 * set the generic validation error message
	 *
	 * @param string
	 */
	public function setErrorMessage($error){
		$this->error_message = $error;
	}
	
}