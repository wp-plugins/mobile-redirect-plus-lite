<?php
/*
Plugin Name: WP Mobile Redirect  
Plugin URI: http://wordpress.org/plugins/mobile-redirect-plus-lite/
Description: Detect the mobile device and redirect to mobile optimize website
Version: 2.4
Author: Iqbal Bary <contact@iqbalbary.com>
Author URI: http://iqbalbary.com
*/

require_once 'includes/settings.php';

add_action('init', 'mobi_plus_redirect_lite');
function mobi_plus_redirect_lite() {
	//call the script
	require_once 'includes/Mobile_Detect.php';
	$detect_lite = new Mobile_Detect_Plus_Lite;

	//Get all option for Redirect setting
	$red_plus_lite = (array)get_option('mobi-setting-lite');

	//Check the session
	$session_check_lite = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	if(substr_count($session_check, 'main=true')>0){
		setcookie('fullsite','true');
		return;
	} 

	//Check and Redirect
	if(!isset($_COOKIE['fullsite']) && $red_plus_lite['redirect'] === 'yes'){
		//Check Tablet
		if($detect_lite->isTablet()){
			if($red_plus_lite['redirect_tab'] === 'yes'){
				return;
			}else{
				$link_redirect_lite = $red_plus_lite['link'];
				wp_redirect( $link_redirect_lite, 302 );
				exit();
			}
		}

		//Check mobile
		if($detect_lite->isMobile()){
			$link_redirect_lite = $red_plus_lite['link'];
			wp_redirect( $link_redirect_lite, 302 );
			exit();	
		}
	}
}