=== Menu Social Icons ===
Contributors: brainstormmedia, pdclark
Plugin URI: https://github.com/brainstormmedia/menu-social-icons
Author URI: http://brainstormmedia.com
Tags: social, icons, menus, FontAwesome, social media, easy
Requires at least: 3.4
Tested up to: 3.5.2
Stable tag: 1.1

Add social icons to your WordPress menu items automatically.

== Description ==

This plugin changes social website links in any of your WordPress menus to use icons from FontAwesome.

No configuration is necessary, other having links to your social media profiles in the built-in WordPress menus. Add links to any of these social sites under `Appearance > Menus`, then enable the plugin.

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

There are several configuration options that can be changed by adding filters to your theme's `functions.php` file.

These filters are:

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

= 1.1 =
* Upgrade to FontAwesome 3.2.1
* Add lots of new site icons: bitbucket.org, dribbble.com, dropbox.com, flickr.com, foursquare.com, gittip.com, instagram.com, renren.com, stackoverflow.com, trello.com, tumblr.com, vk.com, weibo.com, xing.com, youtube.com

= 1.0 =
* Initial public release.

== Upgrade Notice ==

**1.1**
Add lots of new networks: bitbucket.org, dribbble.com, dropbox.com, flickr.com, foursquare.com, gittip.com, instagram.com, renren.com, stackoverflow.com, trello.com, tumblr.com, vk.com, weibo.com, xing.com, youtube.com