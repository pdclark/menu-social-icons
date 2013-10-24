<?php

class Storm_Menu_Social_Icons {

	var $version = '1.3';

	/**
	 * Should we hide the original menu text, or put the icon before it?
	 * Override with storm_social_icons_hide_text filter
	 * 
	 * @var bool
	 */
	var $hide_text = true;

	/**
	 * Contains 3.2.1 FontAwesome icons only. See update_network_classes for 4.0.
	 * @var array links social site URLs with CSS classes for icons
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
		'mailto:'            => array( 'class' => 'envelope',      'icon' => 'icon-envelope',      'icon-sign' => 'icon-envelope-alt'     ),
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
	 * FontAwesome 4.0+ -- Size options available for icon output
	 * These are sizes that render as "pixel perfect" according to FontAwesome.
	 */
	var $icon_sizes = array(
		'normal' => '',
		'large'  => 'fa-lg',
		'2x'     => 'fa-2x',
		'3x'     => 'fa-3x',
		'4x'     => 'fa-4x',
		'5x'     => 'fa-5x',
	);

	/**
	 * FontAwesome 3.2.1 -- Size options available for icon output
	 * These are sizes that render as "pixel perfect" according to FontAwesome.
	 */
	var $legacy_icon_sizes = array(
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

	/**
	 * @var bool If true, use FontAwesome 4.0+, which drops IE7, but adds Vimeo
	 */
	var $use_latest = true;

	/**
	 * @var Storm_Menu_Social_Icons Instance of the class.
	 */
	private static $instance = false;

	/**
	 * Don't use this. Use ::get_instance() instead.
	 */
	public function __construct() {
		if ( !self::$instance ) {
			$message = '<code>' . __CLASS__ . '</code> is a singleton.<br/> Please get an instantiate it with <code>' . __CLASS__ . '::get_instance();</code>';
			wp_die( $message );
		}       
	}
	
	public static function get_instance() {
		if ( !is_a( self::$instance, __CLASS__ ) ) {
			self::$instance = true;
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Initial setup. Called by get_instance.
	 */
	protected function init() {
		
		// Option to update to FontAwesome 4.0+ format (drops IE7 support)
		$this->use_latest = apply_filters( 'storm_social_icons_use_latest', $this->use_latest );

		if ( $this->use_latest ) {
			add_filter( 'storm_social_icons_networks', array( $this, 'update_network_classes' ), 1000 );
		}

		$this->size         = apply_filters( 'storm_social_icons_size',         $this->size );
		$this->type         = apply_filters( 'storm_social_icons_type',         $this->type );
		$this->hide_text    = apply_filters( 'storm_social_icons_hide_text',    $this->hide_text );
		$this->networks     = apply_filters( 'storm_social_icons_networks',     $this->networks );

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

		if ( $this->use_latest ) {

			// FontAwesome latest. Drops IE7 support.
			wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css', array(), $this->version, 'all' );

		}else {

			// FontAwesome 3.2.1 -- support IE7, but lacks Vimeo
			global $wp_styles;
			wp_enqueue_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'fontawesome-ie', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css', array( 'fontawesome' ), $this->version );

			// Internet Explorer conditional comment
			$wp_styles->add_data( 'fontawesome-ie', 'conditional', 'IE 7' );

		}

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

		// Switch between legacy or current icon size classes
		$icon_sizes = ( $this->use_latest ) ?  $this->icon_sizes : $this->legacy_icon_sizes;

		$size = $icon_sizes[ $this->size ];
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
	 * Change size classes from 3.2.1 format to 4.0+ format.
	 * 
	 * @param  array $networks See $this->$networks
	 * @return array $networks Filtered to change "icon-" to "fa fa-"
	 */
	public function update_network_classes( $networks ) {
		
		foreach ( $networks as $url => &$values ) {
			$values['icon']      = str_replace( 'icon-', 'fa fa-', $values['icon'] );
			$values['icon-sign'] = str_replace( 'icon-', 'fa fa-', $values['icon-sign'] );
		}

		$networks['stackoverflow.com'] = array( 'class' => 'stack-overflow', 'icon' => 'fa fa-stack-overflow', 'icon-sign' => 'fa fa-stack-overflow' );
		$networks['stackexchange.com'] = array( 'class' => 'stack-exchange', 'icon' => 'fa fa-stack-exchange', 'icon-sign' => 'fa fa-stack-exchange' );
		$networks['vimeo.com']         = array( 'class' => 'vimeo', 'icon' => 'fa fa-vimeo-square', 'icon-sign' => 'fa fa-vimeo-square' );

		return $networks;
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