<?php
/**
 * define list of variables for the form
 * @var array
 */
$arrData  		= [	'usr' => ['required' => true,'max' =>  100, 'type' => 'text'	, 'value' => null,'label' => 'Username', 'placeholder' => 'Username'], 
					'pwd' => ['required' => true,'max' =>  100, 'type' => 'password', 'value' => null,'label' => 'Password', 'placeholder' => 'Password'], 
				  ];

$objForm = new XCustomForm();
$objForm->setKey(			$this->config_application->form_key);
$objForm->setId(			"{$this->config_application->form_key}secl_");
$objForm->setName(			"{$this->config_application->form_key}secl_");
$objForm->setAction(		XCustomHttp::getUri());
$objForm->setMethod(		XCustomForm::FORM_METHOD_POST);
$objForm->setAutocomplete(	true);
$objForm->setElements(		$arrData);

if(XCustomHttp::isPosted()){
	// validate form data
	$objForm->setValues(		XCustomHttp::getPosts());
	$objForm->validate();
	
	// validation has passed
	if($objForm->passedValidation()){
		
		try{
			// try to login
			XCustomSecurity::login($objForm->getFieldData('usr'), $objForm->getFieldData('pwd'));
			
			// broadcast message
			XCustomApplication::broadcastSuccessMessage('Successful login!!!');
						
			// take user to my profile
			XCustomHttp::redirect();
		}
		catch(Exception $e){
			// broadcast message
			XCustomApplication::broadcastErrorMessage($e->getMessage());
		}
	}
	else{
		// broadcast message
		XCustomApplication::broadcastErrorMessage($objForm->getErrorMessage(), $error = true);
	}
}


return $this->renderViewer(['inputs' 			=> $objForm->generateForm($elements_only = true), 
							'form_id' 			=> $objForm->getId(),
							'form_method' 		=> $objForm->getMethod(), 
							'form_name' 		=> $objForm->getName(), 
							'form_autocomplete' => $objForm->getAutocomplete(),
							'form_action' 		=> $objForm->getAction(),
							]);
