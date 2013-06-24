<?php
/*
Plugin Name: Menu Social Icons
Description: Change menu links to social sites to icons automatically. Uses <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">FontAwesome</a> and supports Facebook, Twitter, LinkedIn, Google+, Github, and Pinterest.
Version: 1.1
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

add_action( 'template_redirect', create_function( '', 'global $storm_menu_social_icons; $storm_menu_social_icons = new Storm_Menu_Social_Icons();' ) );

class Storm_Menu_Social_Icons {

	var $version = '1.1';

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
		'bitbucket.org'      => array( 'class' => 'bitbucket',     'icon' => 'icon-bitbucket',     'icon-sign' => 'icon-bitbucket-sign'   ),
		'dribbble.com'       => array( 'class' => 'dribbble',      'icon' => 'icon-dribbble',      'icon-sign' => 'icon-dribbble'         ),
		'dropbox.com'        => array( 'class' => 'dropbox',       'icon' => 'icon-dropbox',       'icon-sign' => 'icon-dropbox'          ),
		'facebook.com'       => array( 'class' => 'facebook',      'icon' => 'icon-facebook',      'icon-sign' => 'icon-facebook-sign'    ),
		'flickr.com'         => array( 'class' => 'flickr',        'icon' => 'icon-flickr',        'icon-sign' => 'icon-flickr'           ),
		'foursquare.com'     => array( 'class' => 'foursquare',    'icon' => 'icon-foursquare',    'icon-sign' => 'icon-foursquare'       ),
		'github.com'         => array( 'class' => 'github',        'icon' => 'icon-github',        'icon-sign' => 'icon-github-sign'      ),
		'gittip.com'         => array( 'class' => 'gittip',        'icon' => 'icon-gittip',        'icon-sign' => 'icon-gittip-sign'      ),
		'instagr.am'         => array( 'class' => 'instagram',     'icon' => 'icon-instagram',     'icon-sign' => 'icon-instagram'        ),
		'instagram.com'      => array( 'class' => 'instagram',     'icon' => 'icon-instagram',     'icon-sign' => 'icon-instagram'        ),
		'linkedin.com'       => array( 'class' => 'linkedin',      'icon' => 'icon-linkedin',      'icon-sign' => 'icon-linkedin-sign'    ),
		'pinterest.com'      => array( 'class' => 'pinterest',     'icon' => 'icon-pinterest',     'icon-sign' => 'icon-pinterest-sign'   ),
		'plus.google.com'    => array( 'class' => 'google-plus',   'icon' => 'icon-google-plus',   'icon-sign' => 'icon-google-plus-sign' ),
		'renren.com'         => array( 'class' => 'renren',        'icon' => 'icon-renren',        'icon-sign' => 'icon-renren'           ),
		'stackoverflow.com'  => array( 'class' => 'stackexchange', 'icon' => 'icon-stackexchange', 'icon-sign' => 'icon-stackexchange'    ),
		'trello.com'         => array( 'class' => 'trello',        'icon' => 'icon-trello',        'icon-sign' => 'icon-trello'           ),
		'tumblr.com'         => array( 'class' => 'tumblr',        'icon' => 'icon-tumblr',        'icon-sign' => 'icon-tumblr'           ),
		'twitter.com'        => array( 'class' => 'twitter',       'icon' => 'icon-twitter',       'icon-sign' => 'icon-twitter-sign'     ),
		'vk.com'             => array( 'class' => 'vk',            'icon' => 'icon-vk',            'icon-sign' => 'icon-vk'               ),
		'weibo.com'          => array( 'class' => 'weibo',         'icon' => 'icon-weibo',         'icon-sign' => 'icon-weibo'            ),
		'xing.com'           => array( 'class' => 'xing',          'icon' => 'icon-xing',          'icon-sign' => 'icon-xing'             ),
		'youtu.be'           => array( 'class' => 'youtube',       'icon' => 'icon-youtube',       'icon-sign' => 'icon-youtube-sign'     ),
		'youtube.com'        => array( 'class' => 'youtube',       'icon' => 'icon-youtube',       'icon-sign' => 'icon-youtube-sign'     ),
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

		add_action( 'wp_print_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_print_scripts', array( $this, 'wp_print_scripts' ) );

		add_filter( 'wp_nav_menu_objects', array( $this, 'wp_nav_menu_objects' ), 5, 2 );

		// Shortcode for testing all fontawesome icons: [fontawesometest]
		add_shortcode( 'fontawesometest', array( $this, 'shortcode_fontawesometest' ) );
		add_action( 'fontawesometest', array( $this, 'fontawesometest' ) );

	}

	/**
	 * Load FontAwesome from NetDNA's Content Deliver Network (faster, likely to be cached)
	 * @see http://www.bootstrapcdn.com/#tab_fontawesome
	 */
	public function wp_enqueue_scripts() {
		global $wp_styles;

		wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'fontawesome-ie', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css', array( 'fontawesome' ), $this->version );

		// Add Internet Explorer conditional comment
		$wp_styles->add_data( 'fontawesome-ie', 'conditional', 'IE 7' );
	}

	/**
	 * Hide text visually, but keep available for screen readers.
	 * Just 2 lines of stylesheet, so loading inline rather than adding another HTTP request.
	 */
	public function wp_print_scripts() {
		?>
		<style>
			/* Accessible for screen readers but hidden from view */
			.fa-hidden { position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden; }
			.fa-showtext { margin-right: 5px; }
		</style>
		<?php
	}

	/**
	 * Get icon HTML with appropriate classes depending on size and icon type
	 */
	public function get_icon( $network ) {

		$size = $this->icon_sizes[ $this->size ];
		$icon = $network[ $this->type ];
		$show_text = $this->hide_text ? '' : 'fa-showtext';

		return "<i class='$size $icon $show_text'></i>";

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