=== JW Player Plugin for WordPress ===
Contributors: LongTail Video Inc.
Tags: JW Player, Video, Flash, LongTail Video, RTMP, Playlists, Audio, Image, HTML5
Requires at least: 2.8.6
Tested up to: 3.0.1
Stable tag: 1.2.4

This plugin is provided by LongTail Video Inc.  It enables you to configure and embed the JW Player for Flash for use on your WordPress website.

== Description ==

The JW Player Plugin for WordPress makes it extremely easy to deliver video through your WordPress website. This plugin has been developed by LongTail Video, the creator of the JW Player, and allows for easy customization and embedding of the JW Player in your WordPress posts. It provides support for all of the player's configuration options, including skins, plugins and the LongTail Video AdSolution.

<strong>Key Features</strong>

* Manage multiple custom players.
* Full skin and plugin support with easy to use plugin customization interface
* Full integration into the WordPress media library.  Embed media with the JW Player as you write your posts.
* Support for adding external media to your media library including Youtube and RTMP streams.
* A full featured playlist manager - order your media by simply dragging the mouse.
* Support for iPad, iPhone and iPod Touch when using YouTube or MP4 videos.
* A powerful shortcode system for customizations at embed time.

<strong>Documentation</strong>

* Full documentation for installation, setup and use on our <a href='http://www.longtailvideo.com/support/addons/jw-player-plugin-for-wordpress' target='_blank'>Support Site</a>.
* Important information about File Permissions:  http://codex.wordpress.org/Changing_File_Permissions
* If you have any questions, comments, problems or suggestions please post on our forum at: http://www.longtailvideo.com/support/forums

== Installation ==

Installing for the first time:

1. Place the plugin folder in your plugin directory.
1. Visit the JW Player Upgrade page and download or upload your JW Player.
1. For more detailed instructions please visit: <a href='http://www.longtailvideo.com/support/addons/jw-player-plugin-for-wordpress/11513/getting-started-with-the-wordpress-plugin-for-the-jw-pla' target='_blank'>Getting Started with the WordPress Plugin for the JW Player</a>

Upgrading:

It is recommended that you back up your custom players if you are upgrading.

You can perform the automatic update, download the plugin and upload, or FTP the plugin to the plugins folder directly.

== Requirements ==

* WordPress 2.8.6 or higher
* PHP 5.0 or higher
* The wp-content/uploads directory needs to be writable by the plugin.  This is likely already the case as WordPress stores your media and various other uploads here.

== Usage ==

1. Go to Site Admin > Settings > JW Player Plugin
1. Click on the button to create a player.
1. Configure the Basic flashvars.
1. (Optional) Configure Advanced flashvars and add plugins.
1. Save your Player.
1. Create or edit a post.
1. Click on one of the Upload/Insert buttons
1. Using the Media Library tab, you should be able to edit your media.
1. For a video you want to insert, click the Insert JW Player button.
1. It should insert a tag that looks like the following: [jwplayer config="&lt;Player name&gt;" file="&lt;your video&gt;"] into the body.  &lt;your video&gt; is a url to your file.  The "config" attribute is only need when using a player other than the default.
1. Save your posts.

== Changelog ==

= 1.2.4 =

* Fixed bug in Playlist Manager.  Would not remember selected playlist when paging through media.
* Improved error messaging.  It should be very clear what is preventing the plugin from working correctly.
* SWFObject code inserted on a single line.  Should theme formatting from breaking the javascript.

= 1.2.3 =

* Permission error handling tweaks
* BUG: Fix to JW Player plugins settings not being saved

Also, we apologize for the multiple updates in a short period of time.  We just want to iron out some issues as quickly as we can.

= 1.2.2 =
* Additional adjustment to permissions.
* Reduction of archive size to try and avoid zip errors.

= 1.2.1 =
* BUG: File permission issues should now be fixed.
* BUG: Problem where uploaded player was incorrectly marked as invalid should now be fixed.
* BUG: Automated player download problem should now be fixed.

= 1.2.0 =
* FEATURE: Installation of the JW Player is now handled entirely within the plugin.  Simply click a button to install the JW PLayer.  Additionally, upload of licensed players can be done through the plugin as well.
* FEATURE: Content Aware Embed - when embedding audio without a thumbnail, only the controlbar will show
* FEATURE: RTMP Media Library support - can add RTMP streams to the media library and specify streamer and file at the media level. (plugin will make best guess at streamer and file on import)
* FEATURE: Should now be able to use the shortcode in widgets
* FEATURE: Will use the video tag (for .mp4) or youtube embed (for youtube videos) when your blog is viewed on an iPod, iPhone or iPad.
* ENHANCEMENT: Player and configs relocated to the WordPress uploads directly.  This should minimize file permission issues going forward.
* ENHANCEMENT: Image Embedding now officially supported - Can specify the duration flashvar on image media.
* ENHANCEMENT: Audio embedding now officially supported - Can specify the thumbnail flashvar on audio media
* ENHANCEMENT: Arbitrary flashvar field added - useful when using custom plugins and you need to specify flashvars that aren't listed in the JW Player Setup
* ENHANCEMENT: Plugin now uses .zip skins.  Number of available skins has been greatly expanded.
* ENHANCEMENT: Top Nav Bar has been added to the JW Player Setup wizard interface - should make specific edits to your players much easier now
* ENHANCEMENT: Significant redesign of the Playlist Manager - Improved usability and better handling of large media libraries.
* BUG: spaces removed from plugin list - should address unexpected plugin behavior (eg. LTAS not working correctly).
* BUG: Provider/Streamer flashvars have been added back to JW Player Setup
* BUG: Image editing should no longer fail while the plugin is active

= 1.1.2 =
* reimplemented path generation and usage
* Fixed links to longtailvideo.com
* Added links to plugin pages for plugins

= 1.1.1 =
* Improved path resolution.

= 1.1.0 =
* Fixes path resolution of player.swf on the LAMP stack.

= 1.0.0 =
* Initial release of the JW Player Plugin for WordPress
