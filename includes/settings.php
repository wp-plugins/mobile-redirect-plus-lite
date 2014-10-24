<?php

add_action( 'admin_menu', 'mobi_redirect_menu_lite' );
function mobi_redirect_menu_lite(){
	add_options_page( 'WP Mobile Redirect', 'WP Mobile Redirect', 'manage_options', 
						'mobile-redirect-plus-lite', 'redirect_options_page_lite' );
	function redirect_options_page_lite(){
		?>
		<div class="wrap">
			<h2>WP Mobile Redirect Options</h2>
			<form action="options.php" method="POST">
				<?php settings_fields( 'mobi-setting-group-lite' ); ?>
				<?php do_settings_sections( 'mobi-redirect-plus-lite' ); ?>
				<?php submit_button( ); ?>
			</form>
			<hr/>
			<h2><a href="http://bitly.com/redirect-plus" style="float: left;">Check out Mobile Redirect Plus Pro Feature!!!</a></h2>
			<br/><br/>
		</div>
		<?php
	}
}
add_action( 'admin_init', 'mobi_redirect_init_lite' );
function mobi_redirect_init_lite(){
	register_setting( 'mobi-setting-group-lite', 'mobi-setting-lite' );
	add_settings_section( 'section-main-lite', 'Main Settings', 'main_setting_callback_lite', 'mobi-redirect-plus-lite' );
	add_settings_field( 'mobi-plus-lite', 'Redirect To Mobile', 'redirect_mobile_callback_lite', 'mobi-redirect-plus-lite', 'section-main-lite' );
	add_settings_field( 'mobi-link-lite', 'Mobile Website Link', 'mobile_link_callback_lite', 'mobi-redirect-plus-lite', 'section-main-lite' );
	add_settings_field( 'mobi-tablet-lite', 'Exclude Tablets Redirect', 'redirect_tablet_callback_lite', 'mobi-redirect-plus-lite', 'section-main-lite' );
	add_settings_field( 'mobi-back-main-lite', 'Back to full version website', 'redirect_back_main_lite', 'mobi-redirect-plus-lite', 'section-main-lite' );
	

	function main_setting_callback_lite(){
		echo 'Active Radio button to enable/disable mobile redirection. Then enter your mobile site URL in the field below';
	}
	function redirect_mobile_callback_lite(){
		$setting = (array)get_option('mobi-setting-lite');?>
		<input type="radio" name="mobi-setting-lite[redirect]" value="yes" <?php checked('yes', $setting['redirect']); ?> />Active
  		<input type="radio" name="mobi-setting-lite[redirect]" value="no" <?php checked('no', $setting['redirect']); ?> />Inactive
  		<?php
	}
	function mobile_link_callback_lite(){
		$setting = (array)get_option('mobi-setting-lite');
		$link = esc_attr( $setting['link'] );
		echo "<input type='text' class='regular-text' name='mobi-setting-lite[link]' value='$link' />";
		echo '<p class="description">Enter mobile site URL like &nbsp; http://m.google.com</p>';
	}

	function redirect_tablet_callback_lite(){
		$setting = (array)get_option('mobi-setting-lite');?>
		<input type="radio" name="mobi-setting-lite[redirect_tab]" value="yes" <?php checked('yes', $setting['redirect_tab']); ?> />Yes
  		<input type="radio" name="mobi-setting-lite[redirect_tab]" value="no" <?php checked('no', $setting['redirect_tab']); ?> />No
  		<?php
  		echo '<p class="description">If you want to stop redirection for Tablet then check yes (default is no)</p>';
	}
	//full version website
	function redirect_back_main_lite(){
		echo "<div style='background:#408CEA;color:#FFFFFF;font-weight:bold;min-height:21px;padding:3px 5px;width:338px;'>";
		echo get_site_url();
		echo "/?main=true</div>";
		echo '<p class="description">Place this link in mobile website for Redirect back mobile visitor to main website</p>';
	}

}