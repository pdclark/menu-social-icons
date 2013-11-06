<?php
/*
Plugin Name: Menu Social Icons
Description: Change menu links to social sites to icons automatically. Uses <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">FontAwesome</a> and supports: Bitbucket, Dribbble, Dropbox, Flickr, Foursquare, Gittip, Instagram, RenRen, Stack Overflow, Trello, Tumblr, VK, Weibo, Xing, and YouTube.
Version: 1.3.4
Author: Brainstorm Media
Author URI: http://brainstormmedia.com
*/

/**
 * Copyright (c) 2013 Brainstorm Media. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

define( 'MSI_PLUGIN_FILE', __FILE__ );
define( 'MSI_VERSION', '1.3.4' );

add_action( 'init', 'storm_menu_social_icons_init' );

function storm_menu_social_icons_init() {
	
	// PHP Version Check
	$php_is_outdated = version_compare( PHP_VERSION, '5.2', '<' );

	// Only exit and warn if on admin page
	$okay_to_exit = is_admin() && ( !defined('DOING_AJAX') || !DOING_AJAX );
	
	if ( $php_is_outdated ) {
    if ( $okay_to_exit ) {
      require_once ABSPATH . '/wp-admin/includes/plugin.php';
      deactivate_plugins( __FILE__ );
      wp_die( sprintf( __( 'Menu Social Icons requires PHP 5.2 or higher, as does WordPress 3.2 and higher. The plugin has now disabled itself. For information on upgrading, %ssee this article%s.', 'menu-social-icons'), '<a href="http://codex.wordpress.org/Switching_to_PHP5" target="_blank">', '</a>') );
    } else {
      return;
    }
	}

	require_once dirname ( __FILE__ ) . '/classes/msi-frontend.php';
	require_once dirname ( __FILE__ ) . '/classes/msi-admin.php';

	if ( class_exists( 'BWP_MINIFY' ) ) {
		require_once dirname ( __FILE__ ) . '/classes/msi-bwp-compatibility.php';
	}
	
	// Frontend actions
	// WP E-Commerce blocks other template_redirect actions by exiting at priority 10.
	add_action( 'template_redirect', 'MSI_Frontend::get_instance', 5 );

	// Admin actions
	add_action( 'admin_init', 'MSI_Admin::get_instance' );

}
