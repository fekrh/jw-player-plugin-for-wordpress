=== JW Player Plugin for WordPress ===
Contributors: LongTail Video Inc.
Tags: JW Player, Video, Flash
Requires at least: 2.8.6
Tested up to: 2.9.2
Stable tag: 1.1.2

This module is provided by LongTail Video Inc.  It enables you to configure and embed the JW Player for Flash for use on your WordPress website.

== Description ==

The JW Player for Flash Plugin enables you to deliver video content through your WordPress website. This plugin has been developed by LongTail Video, the creator of the JW Player, and allows for easy customization and embedding of the Player in the body of your WordPress articles. It provides support for all of the player's configuration options, including skins, plugins and the LongTail Video AdSolution. 

In addition, it supports a powerful tag system that allows for dynamic customization at embed time, and gives you the capability of referencing external video content.

This plugin also expands the built in WordPress Media Library.  You can now add media files from a URL (including full support for YouTube videos and the YouTube API).  You can also create and embed playlists on the fly using the new Playlist Manager.

For more information about the JW Player and the LongTail AdSolution please visit http://www.longtailvideo.com.

Note that to use the LongTail Ad Solution you will need to apply on the LongTail site.

== Installation ==

1. Place the plugin folder in your plugin directory.
1. Download the player from www.longtailvideo.com.
1. Place player.swf and yt.swf into the JW Player Plugin for WordPress directory.
1. Navigate to Site Admin > Plugins.
1. Click the activate link to enable the plugin.
1. Click on Save configuration.

== Requirements ==

* WordPress 2.8.6 or higher
* PHP 5.0 or higher
* The "configs" directory contained in the plugin directory must be writable.

== Usage ==

1. Go to Site Admin > Settings > JW Player Plugin
1. Click on the button to create a player.
1. Configure the Basic flashvars.
1. (Optional) Configure Advanced flashvars and add plugins.
1. Save your Player.
1. Create or edit a post.
1. Insert the following tag: [jwplayer config="&lt;Player name&gt;" file="&lt;your video&gt;"] into the body.  &lt;your video&gt; is a url to your file.  The "config" attribute is only need when using a player other than the default.
1. Save your posts.
1. For more advanced and detailed description of the module please refer to the provided manual.

== Changelog ==

= 1.1.2 =
* reimplemented path generation and usage
* Fixed links to longtailvideo.com
* Added links to plugin pages for plugins

= 1.1.1 =
* Improved path resolution.

= 1.1 =
* Fixes path resolution of player.swf on the LAMP stack.

= 1.0 =
* Initial release of the JW Player Plugin for WordPress
