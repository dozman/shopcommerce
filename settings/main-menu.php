<?php
$main_menu = '';
// user is logged in
if(XCustomSecurity::loggedIn()){
	$objUser = XCustomSecurity::getUser();
	$main_menu .= "<li><a href=\"#\"><i class=\"glyphicon glyphicon-user\"></i> {$objUser->name}</a></li>";
	$main_menu .= "<li><a href=\"{site_dir}{interface}/user/logout/\" title=\"Logout\"><i class=\"glyphicon glyphicon-flag\"></i> Logout</a></li>";
	$main_menu .= "<li><a href=\"#\" title=\"Contact Us\"><i class=\"glyphicon glyphicon-phone\"></i> {callcentre_number}</a></li>";
}
else{
	$main_menu .= "<li><a href=\"{site_dir}{interface}/user/login/\" title=\"Logout\"><i class=\"glyphicon glyphicon-asterisk\"></i> Signin</a></li>";
	$main_menu .= "<li><a href=\"#\" title=\"Contact Us\"><i class=\"glyphicon glyphicon-phone\"></i> {callcentre_number}</a></li>";
}

return $main_menu;