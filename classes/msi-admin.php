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

			wp_localize_script( 'menu-social-icons-admin', 'msi_networks', $msi_frontend->networks );
		}

	}


}