<?php
/*
Plugin Name: Menu Social Icons
Description: Replace menu items for social sites with icons automatically. Uses <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">FontAwesome</a> and supports Facebook, Twitter, LinkedIn, Google+, Github, and Pinterest.
Version: 1.0
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

add_action( 'template_redirect', create_function( '', 'new Storm_Menu_Social_Icons();' ) );

class Storm_Menu_Social_Icons {

	var $version = '1.0';

	/**
	 * Should we hide the original menu text, or put the icon before it?
	 * Override with storm_social_icons_hide_text filter
	 * 
	 * @var bool
	 */
	var $hide_text = true;

	/**
	 * Array linking social site URLs with CSS classes for icons
	 */
	var $networks = array(
		'facebook.com'    => array( 'class' => 'facebook',    'icon' => 'icon-facebook',    'icon-sign' => 'icon-facebook-sign'),
		'twitter.com'     => array( 'class' => 'twitter',     'icon' => 'icon-twitter',     'icon-sign' => 'icon-twitter-sign'),
		'linkedin.com'    => array( 'class' => 'linkedin',    'icon' => 'icon-linkedin',    'icon-sign' => 'icon-linkedin-sign'),
		'plus.google.com' => array( 'class' => 'google-plus', 'icon' => 'icon-google-plus', 'icon-sign' => 'icon-google-plus-sign'),
		'github.com'      => array( 'class' => 'github',      'icon' => 'icon-github-alt',  'icon-sign' => 'icon-github-sign'),
		'pinterest.com'   => array( 'class' => 'pinterest',   'icon' => 'icon-pinterest',   'icon-sign' => 'icon-pinterest-sign'),
	);

	/**
	 * Class to apply to the <li> of all social menu items
	 */
	var $li_class = 'social-icon';

	/**
	 * Size options available for icon output
	 * These are sizes that render as "pixel perfect" according to FontAwesome.
	 */
	var $icon_sizes = array(
		'normal' => '',
		'large'  => 'icon-large',
		'2x'     => 'icon-2x',
		'3x'     => 'icon-3x',
		'4x'     => 'icon-4x',
	);

	/**
	 * Size of the icons to display.
	 * Override with storm_social_icons_size filter
	 * 
	 * @var string normal|large|2x|3x|4x
	 */
	var $size = '2x';

	/**
	 * Display normal icons, or icons cut out of a box (sign) shape?
	 * Override with storm_social_icons_type filter
	 *
	 * @var string icon|icon-sign
	 */
	var $type = 'icon';

	public function __construct() {

		$this->size = apply_filters( 'storm_social_icons_size', $this->size );
		$this->type = apply_filters( 'storm_social_icons_type', $this->type );
		$this->hide_text = apply_filters( 'storm_social_icons_hide_text', $this->hide_text );

		// Load FontAwesome from NetDNA's Content Deliver Network (faster, likely to be cached)
		// See http://www.bootstrapcdn.com/#tab_fontawesome
		wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css', array(), $this->version, 'all' );
		add_action( 'wp_print_scripts', array( $this, 'wp_print_scripts' ) );

		add_filter( 'wp_nav_menu_objects', array( $this, 'wp_nav_menu_objects' ), 5, 2 );

		// Shortcode for testing all fontawesome icons: [fontawesometest]
		add_shortcode( 'fontawesometest', array( $this, 'shortcode_fontawesometest' ) );
		add_action( 'fontawesometest', array( $this, 'fontawesometest' ) );

	}

	public function wp_print_scripts() {
		?>
		<style>
			/* Accessible for screen readers but hidden from view */
			.fa-hidden { position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden; }
		</style>
		<!--[if IE 7]>
			<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome-ie7.css" rel="stylesheet">
		<![endif]-->
		<?php
	}

	/**
	 * Get icon HTML with appropriate classes depending on size and icon type
	 */
	public function get_icon( $network ) {

		$size = $this->icon_sizes[ $this->size ];
		$icon = $network[ $this->type ];

		return "<i class='$size $icon'></i>";

	}

	/**
	 * Find social links in top-level menu items, add icon HTML
	 */
	public function wp_nav_menu_objects( $sorted_menu_items, $args ){

		foreach( $sorted_menu_items as &$item ) { 
			if ( 0 != $item->menu_item_parent ) {
				// Skip submenu items
				continue;
			}

			foreach( $this->networks as $url => $network ) {
				if ( false !== strpos( $item->url, $url ) ) {

					$item->classes[] = $this->li_class;
					$item->classes[] = $network['class'];

					if ( $this->hide_text ) {
						$item->title = '<span class="fa-hidden">' . $item->title . '</span>';
					}

					$item->title = $this->get_icon( $network ) . $item->title ;
				}
			}
		}

		return $sorted_menu_items;
		
	}

	/**
	 * Test output of all FontAwesome icons 
	 */
	public function fontawesometest( $args ) {
		include dirname( __FILE__ ) . '/font-awesome-test.html';
	}

	/**
	 * Shortcode to test output of all FontAwesome icons
	 */
	public function shortcode_fontawesometest( $args ) {
		ob_start();
		$this->fontawesometest();
		return ob_get_clean();
	}
}