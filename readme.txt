=== Menu Social Icons ===
Contributors: pdclark
Plugin URI: https://github.com/pdclark/menu-social-icons
Author URI: http://pdclark.com
Tags: social, icons, menus, FontAwesome, social media, easy
Requires at least: 3.4
Tested up to: 3.8.1
Stable tag: 1.3.10
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add social icons to your WordPress menu items automatically.

== Description ==

This plugin changes social website links in any of your WordPress menus to use icons from FontAwesome.

No configuration is necessary, other having links to your social media profiles in the built-in WordPress menus. Add links to any of these social sites under `Appearance > Menus`, then enable the plugin.

http://www.youtube.com/watch?v=AS3hLeyV4S0

**Supported Sites**

`
bitbucket.org           dribbble.com         dropbox.com
facebook.com            flickr.com           foursquare.com
github.com              gittip.com           instagram.com
linkedin.com            mailto:(email)       pinterest.com
plus.google.com         renren.com           *slideshare.net
stackoverflow.com       *stackexchange.com   trello.com
tumblr.com              twitter.com          *vimeo.com
vk.com                  weibo.com            xing.com
youtube.com

* Requires storm_social_icons_use_latest be turned on. (See below.)
`

**Changing Icon Appearance**

If you want to edit the appearance of the icons in ways that the options below don't provide, you can do more with custom CSS to match your theme. This video walks through the process:

http://youtube.com/watch?v=hA2rjDwmvms

**Option: Add Vimeo and Stack Exchange**

To use FontAwesome 4.0+, which drops support for **IE7**, but adds **vimeo.com** and **stackexchange.com**, add this to your theme's **functions.php** file:
`add_filter( 'storm_social_icons_use_latest', '__return_true' );`

**Option: Show Text**

To show menu item text in addition to the icons, add this to your theme's **functions.php** file:
`add_filter( 'storm_social_icons_hide_text', '__return_false' );`

**Option: Alternate Icons**

To show an alternative icon style, where logos are cut out of signs, , add this to your theme's **functions.php** file:
`add_filter( 'storm_social_icons_type', create_function( '', 'return "icon-sign";' ) );`

**Option: Icon Sizes**

To vary icon sizes, add this to your theme's **functions.php** file: (Default is 2x)

    add_filter( 'storm_social_icons_size', create_function( '', 'return "normal";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "large";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "2x";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "3x";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "4x";' ) );

**Option: Add More Icons**

Add icons from [FontAwesome](http://fortawesome.github.io/Font-Awesome/) for other URLs. For example, an RSS feed:

    add_filter( 'storm_social_icons_networks', 'storm_social_icons_networks');
    function storm_social_icons_networks( $networks ) {

        $extra_icons = array (
	        '/feed' => array(                  // Enable this icon for any URL containing this text
                'name' => 'RSS',               // Default menu item label
                'class' => 'rss',              // Custom class
                'icon' => 'icon-rss',          // FontAwesome class
                'icon-sign' => 'icon-rss-sign' // May not be available. Check FontAwesome.
            ),
        );

        $extra_icons = array_merge( $networks, $extra_icons );
        return $extra_icons;

    }

**Option: Change HTML Output**

This is useful for developers using the plugin with custom icon sets.

Edit icon HTML output:
`
add_filter( 'storm_social_icons_icon_html', 'storm_social_icons_icon_html', 10, 4 );

function storm_social_icons_icon_html( $html, $size, $icon, $show_text ) {
    $html = "<i class='$size $icon $show_text'></i>";
    return $html;
}
`

Edit title HTML output:
`
add_filter( 'storm_social_icons_title_html', 'storm_social_icons_title_html', 10, 2 );

function storm_social_icons_title_html( $html, $title ){
    $html = "<span class='fa-hidden'>$title</span>";
    return $html;
}
`

Edit all link attributes (WordPress core filter):

`
add_filter( 'wp_nav_menu_objects', 'storm_wp_nav_menu_objects', 7, 2 );

function storm_wp_nav_menu_objects( $sorted_menu_items, $args ){

    foreach( $sorted_menu_items as &$item ) {

        if ( 0 != $item->menu_item_parent ) {
            // Skip submenu items
            continue;
        }

        // Only apply changes to links containing this text.
        $search_url = 'facebook.com';

        if ( false !== strpos( $item->url, $search_url ) ) {

            // Add a custom class
            $item->classes[] = 'some-custom-class';

            // Add custom HTML inside the link
            $item->title = '<strong>custom html</strong>' . $item->title;

        }
    }

    return $sorted_menu_items;
    
}
`

== Installation ==

1. Search for "Menu Social Icons" under `WordPress Admin > Plugins > Add New`
1. Activate the plugin.

== Screenshots ==

1. Icons and shortcuts in WordPress Menu Editor.
1. Menu without the plugin activated.
1. Menu with default settings.
1. Alternative "icon-sign" display.
1. Hidden text disabled.
1. "normal" icon size
1. "4x" icon size

== Frequently Asked Questions == 

= Can you add X icon? =

Menu Social Icons is dependent on the [FontAwesome icon library](http://fortawesome.github.io/Font-Awesome). If an icon exists in FontAwesome, you can add a filter for it using the `storm_social_icons_networks` example shown in the plugin description.

If an icon does not exist in FontAwesome, you can request see FontAwesome's instructions for [requesting new icons](http://fortawesome.github.io/Font-Awesome/community/#requesting-new-icons).

= How can I change how the icons are aligned, positioned, colored, sized, etc. =

See the tutorial video on editing appearance and the code samples for various options in the [plugin description](http://wordpress.org/plugins/menu-social-icons/).

= Does this plugin install all of FontAwesome? =

Yes. The plugin installs the complete FontAwesome package. You can use any of the icons in your HTML.

= I don't see FontAwesome anywhere in the plugin! =

We load FontAwesome onto your site using NetDNA's [Bootstrap CDN](http://www.bootstrapcdn.com/#tab_fontawesome) service. This makes it load much faster for your users.

== Changelog ==

= 1.3.10 =

* New: Add SlideShare. Thanks @mjiderhamn.

= 1.3.9 =

* Fix: Change `use_latest` filter to request "latest" version of FontAwesome, rather than stopping at `4.0.0`. Current version is `4.0.3`.

= 1.3.8 =

* Fix: Title notice.

= 1.3.7 =

* New: Remove templates folder. Replace with filters `storm_social_icons_title_html` and `storm_social_icons_icon_html`. Add example of core `wp_nav_menu_objects` filter to readme.

= 1.3.6 =

* New: Allow themes to override HTML output with msi-templates directory.

= 1.3.5 =

* Fix: Horizontal scrollbar on RTL layouts. Thanks [@mascatu](http://wordpress.org/support/profile/mascatu) for the [bug report](http://wordpress.org/support/topic/rtl-issue-1).

= 1.3.4 =

* Fix: Work around compatibility issue with [Better WordPress Minify](http://wordpress.org/plugins/bwp-minify/) plugin.

= 1.3.3 =

* Fix: Work around bug in WP E-commerce that causes other plugins to not load properly on product pages. Thanks [@elfary](http://wordpress.org/support/topic/menu-with-e-commerce). See [bug report to WP E-commerce](http://wordpress.org/support/topic/other-plugins-blocked-from-loading-on-product-pages).

= 1.3.2 =

* Fix: Properly enqueue stylesheets
* Fix: Set FontAwesome 4.0 to off by default

= 1.3 =

* New: Preview icons and shortcuts in the WordPress Menu Editor.
* New: vimeo.com and stackexchange.com icons when FontAwesome 4.0 is turned on.
* Notice: FontAwesome 4.0 removes support for IE7, so it is off by default. Use the filter `storm_social_icons_use_latest` shown in the readme to turn on FontAwesome 4.0. 

= 1.2 =

* New: Filter for custom icons and URLs.
* New: Icon for `mailto:` links.
* [Thanks to mmcginnis](http://wordpress.org/support/topic/just-works-40) for both of these changes.

= 1.1 =

* New: Upgrade to FontAwesome 3.2.1
* New: ots of new site icons: bitbucket.org, dribbble.com, dropbox.com, flickr.com, foursquare.com, gittip.com, instagram.com, renren.com, stackoverflow.com, trello.com, tumblr.com, vk.com, weibo.com, xing.com, youtube.com

= 1.0 =

* Initial public release.

== Upgrade Notice ==

= 1.3.10 =

* New: Add SlideShare. Thanks @mjiderhamn.