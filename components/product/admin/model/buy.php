<?php
// check for image
if($this->isParam('xpid')){
	
	try{
		// load product
		$objDBConn = $this->connection->prepare('SELECT * FROM product WHERE id = :id AND status_id = :active ');
		$objDBConn->execute(array(':id' => $this->getParam('xpid'),':active' => XCUSTOM_APP_STATUS_ACTIVE));
		$objProduct = $objDBConn->fetchObject();
	}	
	catch(Exception $e){
		// broadcast message
		XCustomApplication::broadcastWarningMessage('Sorry!!! Product moved or deleted');
		
		// take user to products
		XCustomHttp::redirect("{site_dir}{interface}/{$this->getComponent()}/list/");
	}
	
	// load user
	$objDBConn = $this->connection->prepare('SELECT id,total_amount FROM user WHERE id = :id AND status_id = :active ');
	$objDBConn->execute(array(':id' => XCustomSecurity::getUser()->id,':active' => XCUSTOM_APP_STATUS_ACTIVE));
	$objClient = $objDBConn->fetchObject();
	
	$server_key = XCustomApplication::instance()->config_tokens->server_key;
	$arrData  		= [	'token' => ['required' => true,'max' =>  32, 'type' => 'hidden'	, 'value' => md5("{$server_key}{$objProduct->id}{$objProduct->code}")]];
	
	$objForm = new XCustomForm();
	$objForm->setKey(			$this->config_application->form_key);
	$objForm->setId(			"{$this->config_application->form_key}secl_");
	$objForm->setName(			"{$this->config_application->form_key}secl_");
	$objForm->setAction(		XCustomHttp::getUri());
	$objForm->setMethod(		XCustomForm::FORM_METHOD_POST);
	$objForm->setAutocomplete(	true);
	$objForm->setElements(		$arrData);
	
	//@todo build a more flexible discount based on system_discount table
	if($objProduct->price < 100){
		$discount	  =  0;
		$final_amount =  $objProduct->price;
	}
	else if($objProduct->price > 112 && $objProduct->price < 115){
		$discount	  =  $objProduct->price / 4;
		$final_amount =  $objProduct->price - $discount;
	}
	else if($objProduct->price > 120){
		$discount	  =  $objProduct->price / 2;
		$final_amount =  $objProduct->price - $discount;
	}
	
	
	
	
	if(XCustomHttp::isPosted()){
		// check funds
		if($objClient->total_amount >= $final_amount){
			
			//@todo manage purchase in a transaction table
			$objDBConn = $this->connection->prepare("UPDATE user SET total_amount = total_amount - :amount WHERE id = :id");
			$objDBConn->execute(array(':id' => $objClient->id, ':amount' => $final_amount));
				
			// broadcast message
			$dblNewBalance = XCustomFormat::getMoney(($objClient->total_amount - $final_amount), $freindly = true);
			XCustomApplication::broadcastSuccessMessage("Thanks for buying {$objProduct->name}.<br/><strong>Your new balance is:</strong> ZAR {$dblNewBalance}");
				
			// take user to list of products
			XCustomHttp::redirect("{$this->site_dir}{$this->access_context}/{$this->getComponent()}/list/");
		}
		else{
			// broadcast message
			XCustomApplication::broadcastErrorMessage("Sorry, You have insufficient funds to buy this product.<br/><strong>Your balance is:</strong> ZAR {$objClient->total_amount}");
		}
	}
	else{
		// broadcast message
		XCustomApplication::broadcastInfoMessage("You current balance is:</strong> ZAR ".XCustomFormat::getMoney($objClient->total_amount, $freindly = true));
	}
	
	

	return $this->renderViewer(['inputs' 			=> $objForm->generateForm($elements_only = true),
			'form_id' 			=> $objForm->getId(),
			'form_method' 		=> $objForm->getMethod(),
			'form_name' 		=> $objForm->getName(),
			'form_autocomplete' => $objForm->getAutocomplete(),
			'form_action' 		=> $objForm->getAction(),
			
			'name' 			=> $objProduct->name,
			'code' 			=> $objProduct->code,
			'pid' 			=> $objProduct->id,
			'description' 	=> nl2br($objProduct->description),
			'src' 			=> "{site_dir}{interface}/{$this->getComponent()}/list/view/{$objProduct->id}/n/{$objProduct->real_name}",
			'price' 		=> $objProduct->price,
			'back'			=> "{site_dir}{interface}/{$this->getComponent()}/list/",
			
			'discount' 			=> XCustomFormat::getMoney($discount, $freindly = true),
			'final_amount' 		=> XCustomFormat::getMoney($final_amount, $freindly = true),
				
	]);
}
else{
	// broadcast message
	XCustomApplication::broadcastWarningMessage('Sorry!!! Issue loading product for purchase');
	
	// take user to products
	XCustomHttp::redirect("{$this->site_dir}{$this->access_context}/{$this->getComponent()}/list/");
	
}