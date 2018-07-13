<?php
// check for image
if($this->isParam('view') && $this->isParam('n')){
	
	$objDBConn = $this->connection->prepare('SELECT * FROM product WHERE id = :id AND status_id = :active ');
	$objDBConn->execute(array(':id' => $this->getParam('view'),':active' => XCUSTOM_APP_STATUS_ACTIVE));
	
	$objProduct = $objDBConn->fetchObject();
	
	header("X-Content-Type-Options: nosniff");
	header('Access-Control-Allow-Methods: GET');
	XCustomHttp::addNoCacheHeaders();
	header("Content-Type: ." . XCustomFile::getMime($objProduct->real_name), true);
	header("Content-Length: " . XCustomFile::size(XCUSTOM_APP_DATA_PATH ."fileupload/{$objProduct->sys_name}"));
	readfile(XCUSTOM_APP_DATA_PATH ."fileupload/{$objProduct->sys_name}");
	exit;
}



// get list of guest permissions
$objDBConn = $this->connection->prepare('SELECT * FROM product WHERE status_id = :active ');
$objDBConn->execute(array(':active' => XCUSTOM_APP_STATUS_ACTIVE));
	
	
$arrProducts = $objDBConn->fetchAll(PDO::FETCH_ASSOC);

//print_r($arrProducts);exit;

if(!empty($arrProducts)){
	$strProducts = '';
	
	$strProducts .= "<div class=\"row row-eq-height\">";
	foreach($arrProducts as $product){
		
		$strProducts .= "<div class=\"col-xs-6 col-sm-4 panel\" style=\"padding:10px; height:350px;\">";
		$strProducts .= "<a href=\"{site_dir}{interface}/{$this->getComponent()}/buy/{$product['code']}/xpid/{$product['id']}/\">
						<img style=\"aliagn:center!important;\" width=\"200\" title=\"{$product['name']}\" src=\"{site_dir}{interface}/{$this->getComponent()}/{$this->getModule()}/view/{$product['id']}/n/{$product['real_name']}\"/>
						</a>";
		$strProducts .= "<br><strong>{$product['name']}<strong>";
		$strProducts .= "<hr/>
							<div style=\"float:left!important;\">ZAR {$product['price']}</div>
							<div style=\"bottom:0px!important;float:right!important;\"><a href=\"{site_dir}{interface}/{$this->getComponent()}/buy/{$product['code']}/xpid/{$product['id']}/\"> [ Buy ] </a></div>
						";
		$strProducts .= "</div>";
		
	}
	$strProducts .= "</div>";
}
else{
	$strProducts = 'No Product(s) on Sale';
}


return $this->renderViewer(['list' 			=> $strProducts]);