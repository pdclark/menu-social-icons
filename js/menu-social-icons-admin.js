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

		var icon_url = get_icon_if_exists_for_url( url_value );

		if ( icon_url ){
			add_icon( $input, icon_url );
		}else {
			remove_icon( $input );
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

	var add_icon = function( $input, icon_url ){
		if ( "custom-menu-item-url" == $input.attr('id') ) {
			add_icon_to_new_link( $input, icon_url );
		}else {
			add_icon_to_title( $input, icon_url );
		}
	};

	var remove_icon = function( $input ){
		if ( "custom-menu-item-url" == $input.attr('id') ) {
			remove_icon_from_new_link();
		}else {
			remove_icon_from_title( $input );
		}
	};

	var add_icon_to_new_link = function( $input, icon_url ){
		var $icon = get_icon_from_url( icon_url );

		$icon.css({
			"position": "absolute",
			"top": "0px",
			"right": "150px"
		});
		$("#submit-customlinkdiv").parent().css("position", "relative");

		remove_icon_from_new_link();

		$("#submit-customlinkdiv").before( $icon );
	};

	/**
	 * Add an icon to menu title bar
	 */
	var add_icon_to_title = function( $input, icon_url ){
		// Identify title element and build appropriate icon
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		var $icon = get_icon_from_url( icon_url );

		$icon.css({
			"position": "absolute",
			"top": "4px",
			"left": "4px"
		});

		// Add icon and move title text over
		$title.prepend( $icon );
		$title.find("span.item-title").css("padding-left", "33px");
	};

	var remove_icon_from_title = function( $input ) {
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		$title.children('i').remove();
		$title.find("span.item-title").css("padding-left", "0px");
	};

	var remove_icon_from_new_link = function(){
		$("#submit-customlinkdiv").siblings("i").remove();
	};

	/**
	 * Take a matched URL and create an icon from info looked up in icons object
	 */
	var get_icon_from_url = function( url ){
		var $icon = $("<i>").addClass( icons[ url ].icon ).addClass('fa-fw');

		// Style icon
		$icon.css({ "font-size": "28px" });

		return $icon;
	};

	/**
	 * Initial search and change event hook
	 */
	var init = function(){
		$( '#menu-to-edit input.edit-menu-item-url' ).each( check_menu_item );
		$( '#menu-to-edit input.edit-menu-item-url' ).on( 'keyup', check_menu_item );
		$( '#custom-menu-item-url' ).on( 'keyup', check_menu_item );

		// Closest thing I can find to an event on new link add
		$( '#custom-menu-item-name' ).on( 'blur', function(){
			$( '#menu-to-edit input.edit-menu-item-url' ).each( check_menu_item );
			remove_icon_from_new_link();
		});
	};

	// Fire this plugin
	init();

});