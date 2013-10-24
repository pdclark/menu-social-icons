jQuery( document ).ready( function( $ ){

	/**
	 * Global variable from MSI_Frontend::$networks
	 */
	var icons = msi_networks;

	/**
	 * List of URLs to search for
	 */
	var icon_urls = Object.keys( icons );

	/**
	 * Iterate over all menu items, add icon if URL matches
	 */
	var check_menu_item = function(){
		var $input = $(this);
		var url_value = $input.val();

		var icon = get_icon_if_exists_for_url( url_value );

		if ( icon ){
			add_icon_to_title( $input, icon );
		}else {
			remove_icon_from_title( $input );
		}
	};

	var get_icon_if_exists_for_url = function( url_value ) {
		for (var i = 0; i < icon_urls.length; i++) {
			if ( -1 != url_value.indexOf( icon_urls[i] ) ){
				return icon_urls[i];
			}
		}
		
		return false;
	};

	/**
	 * Add an icon to menu title bar
	 */
	var add_icon_to_title = function( $input, url ){
		// Identify title element and build appropriate icon
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		// Add icon and move title text over
		$title.prepend( get_icon_from_url( url ) );
		$title.find("span.item-title").css("padding-left", "33px");
	};

	var remove_icon_from_title = function( $input ) {
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		$title.children('i').remove();
		$title.find("span.item-title").css("padding-left", "0px");
	};

	/**
	 * Take a matched URL and create an icon from info looked up in icons object
	 */
	var get_icon_from_url = function( url ){
		var $icon = $("<i>").addClass( icons[ url ].icon ).addClass('fa-fw');

		// Style icon
		$icon.css({
			"font-size": "28px",
			"position": "absolute",
			"top": "4px",
			"left": "4px"
		});

		return $icon;
	};

	/**
	 * Initial search and change event hook
	 */
	var init = function(){
		$( '#menu-to-edit input.edit-menu-item-url' ).each( check_menu_item );
		$( '#menu-to-edit input.edit-menu-item-url' ).on( 'keyup', check_menu_item );
	};

	// Fire this plugin
	init();

});