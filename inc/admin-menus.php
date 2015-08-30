<?php
// create admin menus

if (!function_exists('pipdig_add_admin_menu')) {
	function pipdig_add_admin_menu() {
	
		global $submenu;
		add_menu_page( 'pipdig', 'pipdig', 'manage_options', 'pipdig', 'pipdig_main_options_page', 'dashicons-star-filled' );
		add_submenu_page( 'pipdig', 'Shortcodes', 'Shortcodes', 'manage_options', 'pipdig-shortcodes', 'pipdig_shortcodes_options_page' );
		if (pipdig_plugin_check('social-count-plus/social-count-plus.php')) { // social stats only if plugin active
			add_submenu_page( 'pipdig', __('Social Stats', 'p3'), __('Social Stats', 'p3'), 'manage_options', 'pipdig-social', 'pipdig_social_options_page' );
		}
		add_submenu_page( 'pipdig', __('Custom CSS', 'p3'), __('Custom CSS', 'p3'), 'manage_options', 'pipdig-css', 'pipdig_css_options_page' );
		add_submenu_page( 'pipdig', __('Theme', 'p3').' Hooks', __('Theme', 'p3').' Hooks', 'manage_options', 'pipdig-hooks', 'pipdig_hooks_options_page' );
		add_submenu_page( 'pipdig', __('Updates', 'p3'), __('Updates', 'p3'), 'manage_options', 'pipdig-updates', 'pipdig_updates_options_page' );
		$submenu['pipdig'][0][0] = __('Help / Guides', 'p3'); // http://wordpress.stackexchange.com/questions/98226/admin-menus-name-menu-different-from-first-submenu
		
	}
	add_action( 'admin_menu', 'pipdig_add_admin_menu' );
}

require_once('admin-menus/guides.php');
require_once('admin-menus/updates.php');
require_once('admin-menus/shortcodes.php');
require_once('admin-menus/css.php');
require_once('admin-menus/hooks.php');
if (pipdig_plugin_check('social-count-plus/social-count-plus.php')) { // social stats only if plugin active
	require_once('admin-menus/social.php');
}