<?php

$arrData  		= [	'email' => ['required' => true,'max' =>  100, 'type' => 'email'	, 'value' => null,'label' => 'Email', 'placeholder' => 'Email'], 
					'name' => ['required' => true,'max' =>  50, 'type' => 'text', 'value' => null,'label' => 'Name', 'placeholder' => 'Known As'], 
				    'pwd' => ['required' => true,'max' =>  100, 'type' => 'password', 'value' => null,'label' => 'Password', 'placeholder' => 'Password'], 
				  ];
//$arrFormData 	= XCustomGeneric::buildFormData($arrData);

$objForm = new XCustomForm();
$objForm->setKey(			$this->config_application->form_key);
$objForm->setId(			"{$this->config_application->form_key}regu_");
$objForm->setName(			"{$this->config_application->form_key}regu_");
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
			//@todo check user exists before add to avaid constraits
			
			
			// try to login
			$objDBConn = XCustomApplication::instance()->connection->prepare('INSERT 
					INTO user(username, password, name, security_role_id, status_id) 
					VALUES(:username, :password, :name, :security_role_id, :status_id)');
			
			$objDBConn->execute(array(	':username' => $objForm->getFieldData('email'), 
										':password' => $objForm->getFieldData('pwd'),
										':name' => $objForm->getFieldData('name'),
										':security_role_id' => XCUSTOM_DEAFULT_CLIENT_ROLE_ID,
										':status_id' => XCUSTOM_APP_STATUS_ACTIVE,
									));
			
			// broadcast message
			XCustomApplication::broadcastSuccessMessage('Your account has been created');
				
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
		XCustomApplication::broadcastErrorMessage($objForm->getErrorMessage());
	}
}


return $this->renderViewer(['inputs' 			=> $objForm->generateForm($elements_only = true), 
							'form_id' 			=> $objForm->getId(),
							'form_method' 		=> $objForm->getMethod(), 
							'form_name' 		=> $objForm->getName(), 
							'form_autocomplete' => $objForm->getAutocomplete(),
							'form_action' 		=> $objForm->getAction(),
							]);
