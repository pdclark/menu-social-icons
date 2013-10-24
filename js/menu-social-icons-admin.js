(function( $, icons ){
	/**
	 * Variable "icons" from MenuSocialIconsNetworks, PHP: MSI_Frontend::$networks)
	 */

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

	/**
	 * Check a URL to see if we have an icon for it
	 * @return string|bool valid URL|false
	 */
	var get_icon_if_exists_for_url = function( url_value ) {
		for (var i = 0; i < icon_urls.length; i++) {
			if ( -1 != url_value.indexOf( icon_urls[i] ) ){
				return icon_urls[i];
			}
		}
		
		return false;
	};

	/**
	 * Add icon, either from New Link area or menu item title
	 */
	var add_icon = function( $input, icon_url ){
		if ( "custom-menu-item-url" == $input.attr('id') ) {
			add_icon_to_new_link( $input, icon_url );
		}else {
			add_icon_to_title( $input, icon_url );
		}
	};

	/**
	 * Remove icon, either from New Link area or menu item title
	 */
	var remove_icon = function( $input ){
		if ( "custom-menu-item-url" == $input.attr('id') ) {
			remove_icon_from_new_link();
		}else {
			remove_icon_from_title( $input );
		}
	};

	/**
	 * Add icon to New Link area
	 */
	var add_icon_to_new_link = function( $input, icon_url ){
		remove_icon_from_new_link();

		$('#msi-shortcuts i').each( function(){
			if ( icon_url == $(this).data('url') ) {
				$(this).addClass('active');
			}
		});

	};

	/**
	 * Add an icon to menu title bar
	 */
	var add_icon_to_title = function( $input, icon_url ){
		// Identify title element and build appropriate icon
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		var $icon = get_icon_from_url( icon_url );

		// Add icon and move title text over
		remove_icon_from_title( $input );
		$title.prepend( $icon );
		$title.find("span.item-title").addClass("has-social-icon");
	};

	/**
	 * Remove icon from title area of menu item
	 */
	var remove_icon_from_title = function( $input ) {
		var $title = $input.parents('li.menu-item').find('dt.menu-item-handle');

		$title.children('i').remove();
		$title.find("span.item-title").removeClass("has-social-icon");
	};

	/**
	 *	Remove icon from New Link area
	 */
	var remove_icon_from_new_link = function(){
		$('#msi-shortcuts i').removeClass('active');
	};

	/**
	 * Take a matched URL and create an icon from info looked up in icons object
	 */
	var get_icon_from_url = function( url ){
		var $icon = $("<i>").addClass( icons[ url ].icon ).addClass('fa').addClass('fa-fw');

		return $icon;
	};

	/**
	 * Take a matched URL and return the network name
	 */
	var get_name_from_url = function( url ){
		return icons[ url ].name;
	};

	/**
	 * Add shortcuts to all icons in Links menu
	 */
	var display_icon_shortcuts = function(){
		var $icon, name;
		var $wrapper = $('<div>').attr('id', 'msi-shortcuts');

		$wrapper.append( '<h4>Social Icons</h4>');

		for (var i = 0; i < icon_urls.length; i++) {
			// Skip short-links (duplicates)
			if ( 'youtu.be' == icon_urls[i] || 'instagr.am' == icon_urls[i] ) {
				continue;
			}

			$icon = get_icon_from_url( icon_urls[i] );
			name = get_name_from_url( icon_urls[i] );

			$icon.data( 'url', icon_urls[i] );
			$icon.data( 'name', name );

			$icon.click( update_link_fields );

			$wrapper.append( $icon );
		}

		$faq = $('<ul>').addClass('faq');

		$faq.append( "<li><a href='http://youtube.com/watch?v=hA2rjDwmvms' target='_blank'>How to edit icon appearance</a></li>" );
		$faq.append( "<li><a href='http://fortawesome.github.io/Font-Awesome/community/#requesting-new-icons' target='_blank'>How to request new icons</a></li>" );

		$wrapper.append( $faq );

		$('#customlinkdiv').append( $wrapper );
	};

	/**
	 * Insert icon URL into input field when icon is clicked
	 */
	var update_link_fields = function(){
		var url = $(this).data('url');
		var name = $(this).data('name');

		remove_icon_from_new_link();
		$(this).addClass('active');

		$('#custom-menu-item-url').val( 'http://' + url );
		$('#custom-menu-item-name').val( name ).removeClass('input-with-default-title');
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

		display_icon_shortcuts();
	};

	// Fire this plugin
	init();

})( jQuery, MenuSocialIconsNetworks );