<?php 
// take user to my profile
XCustomSecurity::logout();

// broadcast message
XCustomApplication::broadcastSuccessMessage('Your account has been created');

// take user to my profile
XCustomHttp::redirect();