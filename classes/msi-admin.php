<?php

class MSI_Admin {
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

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

	}

	public function admin_enqueue_scripts( $page ) {

		if ( 'nav-menus.php' == $page ) {
			$msi_frontend = MSI_Frontend::get_instance();
			
			$msi_frontend->wp_enqueue_scripts();

			wp_enqueue_script( 'menu-social-icons-admin', plugins_url( 'js/menu-social-icons-admin.js', MSI_PLUGIN_FILE ), array( 'jquery' ), MSI_VERSION, true );
			wp_enqueue_style(  'menu-social-icons-admin', plugins_url( 'css/menu-social-icons-admin.css', MSI_PLUGIN_FILE ), array(), MSI_VERSION );

			wp_localize_script( 'menu-social-icons-admin', 'MenuSocialIconsNetworks', $this->get_networks() );
		}

	}

	/**
	 * Get networks array to pass to javascript
	 * Set icon-sign values as icon values if icon-sign in use.
	 * Strip remaining icon-sign values
	 */
	public function get_networks() {
		$msi_frontend = MSI_Frontend::get_instance();

		$networks = $msi_frontend->networks;

		foreach ( $networks as &$network ) {
			if ( 'icon-sign' == $msi_frontend->type ) {
				$network['icon'] = $network['icon-sign'];
			}
			unset( $network['icon-sign'] );
		}

		return $networks;
	}


}