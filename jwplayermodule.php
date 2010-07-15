<?php
/*
Plugin Name: JW Player Plugin for WordPress
Plugin URI: http://www.longtailvideo.com/
Description: Embed a JW Player for Flash into your WordPress articles.
Version: 1.1.2
Author: LongTail Video Inc.
Author URI: http://www.longtailvideo.com/

Copyright 2010  LongTail Video Inc.  (email : plugins@longtailvideo.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

global $wp_version;

// Check for WP2.7 installation
if (!defined ('IS_WP27')) {
	define('IS_WP27', version_compare($wp_version, '2.7', '>=') );
}

// This works only in WP2.7 or higher
if (IS_WP27 == FALSE) {
	add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, the JWPlayer Plugin for WordPress works only under WordPress 2.7 or higher.') . '</strong></p></div>\';'));
	return;
}

// The plugin is only compatible with PHP 5.0 or higher
if (version_compare(phpversion(), "5.0", '<')) {
  add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, the JWPlayer Plugin for WordPress only works with PHP Version 5 or higher.') . '</strong></p></div>\';'));
  return;
}

//Include core plugin files.
include_once (dirname (__FILE__) . "/framework/LongTailFramework.php");
include_once (dirname (__FILE__) . "/admin/AdminContext.php");
include_once (dirname (__FILE__) . "/media/JWMediaFunctions.php");
include_once (dirname (__FILE__) . "/media/JWShortcode.php");

//Define the plugin directory and url for file access.
define("JWPLAYER_DIR", WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define("JWPLAYER_URL", WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)));

// Error if the player doesn't exist
if (!file_exists(LongTailFramework::getPlayerPath())) {
	add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('The player.swf cannot be found at ' . LongTailFramework::getPlayerPath() . '.  The plugin will not work!') . '</strong></p></div>\';'));
	return;
}

// Add swfobject.js from Google CDN.  Needed for player embedding.
wp_enqueue_script("google-swfobject", "http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js");
add_filter("the_content", "jwplayer_tag_callback", 11);
add_filter("widget_text", "jwplayer_tag_callback", 11);

// Player configuration and Media Management, limited to administrators.
if (is_admin()) {
  add_action( 'plugins_loaded', create_function( '', 'global $adminContext; $adminContext = new AdminContext();' ) );
  add_action("admin_menu", "jwplayer_plugin_menu");
}

// Build the admin and media menues.
function jwplayer_plugin_menu() {
  $admin = add_options_page("JW Player Plugin Options", "JW Player Plugin", "administrator", "jwplayer", "jwplayer_plugin_options");
  add_action("admin_print_scripts-$admin", "add_admin_js");
}

// Add js for plugin tabs.
function add_admin_js() {
  wp_enqueue_script("jquery-ui-tabs");
  echo '<link rel="stylesheet" href="'. WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ).'/' . 'css/smoothness/jquery.ui.tabs.css" type="text/css" media="print, projection, screen" />'."\n";
}

// Entry point to the Player configuration wizard.
function jwplayer_plugin_options() {
  switch ($_GET["page"]) {
    case "jwplayer" :
      global $adminContext;
      $adminContext->processState();
      break;
  }
}

// Process xspf playlist requests.
function jwplayer_queryvars($query_vars) {
  $query_vars[] = 'xspf';
	return $query_vars;
}

// Parse xspf playlist requests.
function jwplayer_parse_request($wp) {
  if (array_key_exists('xspf', $wp->query_vars) && $wp->query_vars['xspf'] == 'true') {
  require_once (dirname (__FILE__) . '/media/JWPlaylistGenerator.php');
    exit();
  }
}

// Parse the $_GET vars for callbacks
add_filter('query_vars', 'jwplayer_queryvars' );
add_action('parse_request',  'jwplayer_parse_request', 9 );

?>
