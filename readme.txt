=== Menu Social Icons ===
Contributors: brainstormmedia, pdclark
Plugin URI: https://github.com/brainstormmedia/menu-social-icons
Author URI: http://brainstormmedia.com
Tags: social, icons, menus, FontAwesome, social media, easy
Requires at least: 3.4
Tested up to: 3.6
Stable tag: 1.2

Add social icons to your WordPress menu items automatically.

== Description ==

This plugin changes social website links in any of your WordPress menus to use icons from FontAwesome.

No configuration is necessary, other having links to your social media profiles in the built-in WordPress menus. Add links to any of these social sites under `Appearance > Menus`, then enable the plugin.

http://www.youtube.com/watch?v=AS3hLeyV4S0

**Supported Sites**

* bitbucket.org
* dribbble.com
* dropbox.com
* facebook.com
* flickr.com
* foursquare.com
* github.com
* gittip.com
* instagram.com
* linkedin.com
* mailto: (email links)
* pinterest.com
* plus.google.com
* renren.com
* stackoverflow.com
* trello.com
* tumblr.com
* twitter.com
* vk.com
* weibo.com
* xing.com
* youtube.com

**Editing the Appearance**

If you want to edit the appearance of the icons in ways that the options below don't provide, you can do more with custom CSS to match your theme.

Menu Social Icons adds a `social-icon` class to every menu item that's an icon, as well as a class for each social network, like `facebook` or `twitter`.

If you're not familiar with how to use CSS to make these changes, here is a video walkthrough that will guide you through the process:

http://youtu.be/hA2rjDwmvms

**Available Options**

There are several configuration options that can be changed by adding filters to your theme's `functions.php` file.

Show menu item text in addition to the icons:
`add_filter( 'storm_social_icons_hide_text', '__return_false' );`

Show an alternative icon style, where logos are cut out of signs.
`add_filter( 'storm_social_icons_type', create_function( '', 'return "icon-sign";' ) );`

Various sizes for icons. Pick one. (Default is 2x).

    add_filter( 'storm_social_icons_size', create_function( '', 'return "normal";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "large";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "2x";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "3x";' ) );
    add_filter( 'storm_social_icons_size', create_function( '', 'return "4x";' ) );

Add icons from [FontAwesome](http://fortawesome.github.io/Font-Awesome/) for other URLs. For example, an RSS feed:

    add_filter( 'storm_social_icons_networks', 'storm_social_icons_networks');
    function storm_social_icons_networks( $networks ) {
        $extra_icons = array (
	        '/feed' => array( 'class' => 'rss', 'icon' => 'icon-rss', 'icon-sign' => 'icon-rss-sign' ),
        );
        $extra_icons = array_merge( $networks, $extra_icons );
        return $extra_icons;
    }


== Installation ==

1. Search for "Menu Social Icons" under `WordPress Admin > Plugins > Add New`
1. Activate the plugin.

== Screenshots ==

1. Menu without the plugin activated.
2. Plugin activated with default settings.
3. Alternative "icon-sign" display.
4. Hidden text disabled.
5. "normal" icon size
5. "4x" icon size

== Frequently Asked Questions == 

= Does this plugin install all of FontAwesome? =

Yes. The plugin installs the complete FontAwesome package. You can use any of the icons in your HTML.

= I don't see FontAwesome anywhere in the plugin! =

We load FontAwesome onto your site using NetDNA's [Bootstrap CDN](http://www.bootstrapcdn.com/#tab_fontawesome) service. This makes it load much faster for your users.

== Changelog ==

= 1.2 =
* Add filter for custom icons and URLs.
* Add icon for `mailto:` links.
* [Thanks to mmcginnis](http://wordpress.org/support/topic/just-works-40) for both of these changes.

= 1.1 =
* Upgrade to FontAwesome 3.2.1
* Add lots of new site icons: bitbucket.org, dribbble.com, dropbox.com, flickr.com, foursquare.com, gittip.com, instagram.com, renren.com, stackoverflow.com, trello.com, tumblr.com, vk.com, weibo.com, xing.com, youtube.com

= 1.0 =
* Initial public release.

== Upgrade Notice ==

**1.2**
* Add filter for custom icons and URLs.
* Add icon for `mailto:` links.
* [Thanks to mmcginnis](http://wordpress.org/support/topic/just-works-40) for both of these changes.

**1.1**
Add lots of new networks: bitbucket.org, dribbble.com, dropbox.com, flickr.com, foursquare.com, gittip.com, instagram.com, renren.com, stackoverflow.com, trello.com, tumblr.com, vk.com, weibo.com, xing.com, youtube.com