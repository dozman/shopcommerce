<?php

$objDBConn = $this->connection->prepare('SELECT id, name FROM user WHERE status_id = :active AND security_role_id = :role
													 ');
$objDBConn->execute(array(':active' => XCUSTOM_APP_STATUS_ACTIVE,':role' => XCUSTOM_DEAFULT_CLIENT_ROLE_ID));
	
	
$arrClients = $objDBConn->fetchAll(PDO::FETCH_ASSOC);
$arrClientData = [];
foreach ($arrClients as $value){
	$arrClientData[$value['id']] = $value['name'];
}



$arrData  		= [	'user' => ['required' => true,'max' =>  100, 'type' => 'select'	, 'value' => null,'label' => 'Client', 'placeholder' => 'Select Client', 'data' => $arrClientData], 
					'amount' => ['required' => true,'max' =>  10, 'type' => 'money', 'value' => null,'label' => 'Amount', 'placeholder' => 'Amount'], 
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
			//@todo manage topup in a transaction table
			$objDBConn = $this->connection->prepare("UPDATE user SET total_amount = total_amount + :amount WHERE id = :id");
			$objDBConn->execute(array(':id' => $objForm->getFieldData('user'), ':amount' => $objForm->getFieldData('amount')));
			
			// broadcast message
			XCustomApplication::broadcastSuccessMessage('Success!!! User account has been updated.');
			
			// @todo notify user via email
			
				
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
							'message' 			=> $objForm->getErrorMessage(),
							]);
