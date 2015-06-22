<?php
/*
Plugin Name: Nexus MailChimp bridge
Version: 1.0.0
Plugin URI: http://nexusthemes.com
Description: Helper
Author: Gert-Jan Bark
Author URI: http://nexusthemes.com
*/

function nxs_mailchimp_init()
{
	if (!defined('NXS_FRAMEWORKLOADED'))
	{
		function nxs_mailchimp_frameworkmissing() {
	    ?>
	    <div class="error">
	      <p>The nxs_mailchimp plugin is not initialized; NexusFramework dependency is missing (hint: activate a WordPress theme from NexusThemes.com first)</p>
	    </div>
	    <?php
		}
		add_action( 'admin_notices', 'nxs_mailchimp_frameworkmissing' );
		return;
	}
	
	// MailChimp widgets
	nxs_lazyload_plugin_widget(__FILE__, "mcform");
}
add_action("init", "nxs_mailchimp_init");

function nxs_mailchimp_getwidgets($result, $widgetargs)
{
	if (defined("MC4WP_LITE_VERSION"))
	{
		$nxsposttype = $widgetargs["nxsposttype"];
		$pagetemplate = $widgetargs["pagetemplate"];
		
		if 
		(
			$nxsposttype == "post" || 
			$nxsposttype == "footer" || 
			$nxsposttype == "header" || 
			$nxsposttype == "subheader" ||
			$nxsposttype == "subfooter" ||
			$nxsposttype == "pagelet" ||
			$nxsposttype == "sidebar"
		)
		{
			$result[] = array("widgetid" => "mcform", "tags" => array("mailchimp"));
		}
	}
	
	//		
	return $result;
}
add_action("nxs_getwidgets", "nxs_mailchimp_getwidgets", 10, 2);	// default prio 10, 2 parameters (result, args)

/*
function nxs_mailchimp_styles()
{
	wp_register_style('nxs-mailchimp-style', 
    plugins_url( 'css/nxsmailchimp.css', __FILE__), 
    array(), 
    nxs_getthemeversion(),    
    'all' );
  
  $iswordpressbackendshowing = is_admin();
	if (!$iswordpressbackendshowing)
	{
		wp_enqueue_style('nxs-mailchimp-style');
	}
}
add_action('wp_enqueue_scripts', 'nxs_mailchimp_styles');
*/

/* --------------------------------------------------------------------- */
?>