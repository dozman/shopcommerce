<?php
$side_menu = '';
// user is logged in
if(XCustomSecurity::loggedIn()){
	$objUser = XCustomSecurity::getUser();
	$side_menu .= "<li><a href=\"#\"><i class=\"glyphicon glyphicon-user\"></i> Hello, {$objUser->name}</a></li>";
}
foreach($this->user_permissions as $component => $permission_data){
	if(count($permission_data['direct_perms']) >= 1){
		$side_menu .= "<li><a href=\"#{$component}\">{$permission_data['title']}</a></li>";
		if(count($permission_data['direct_perms']) > 1){
			//$side_menu .= "<li><a href=\"#{$component}\">{$permission_data['title']}</a></li>";
			//$side_menu .= "<ul class=\"nav navbar-nav\">";
			foreach($permission_data['direct_perms'] as $perm){
				$perm_title = ucfirst(str_replace('-', ' ', $perm));
				$side_menu .= "<li><a href=\"{site_dir}{interface}/{$component}/{$perm}/\" title=\"{$perm}\"> > {$perm_title}</a></li>";
			}
			//$side_menu .= "</ul>";
			//$side_menu .= "</li>";
		}
		else{
			foreach($permission_data['direct_perms'] as $perm){
				
				$perm_title = ucfirst(str_replace('-', ' ', $perm));
				$side_menu .= "<li><a href=\"{site_dir}{interface}/{$component}/{$perm}/\" title=\"{$perm}\"> > {$perm_title}</a></li>";
			}
		}
	}
}

return $side_menu;