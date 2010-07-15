<?php
/**
 * @file This file defines the filter hooks for extending the WordPress Media
 * Library.
 */

// Filter hook for specifying which custom fields are save.
add_filter("attachment_fields_to_save", "jwplayer_attachment_fields_to_save", 10, 2);

/**
 * Handler function for saving custom fields.
 * @param array $post Array representing the post we are saving.
 * @param array $attachment Array representing the attachment fields being
 * saved.
 * @return array $post updated with the attachment fields to be saved.
 */
function jwplayer_attachment_fields_to_save($post, $attachment) {
  $mime_type = substr($post["post_mime_type"], 0, 5);
  $rtmp = get_post_meta($post["ID"], LONGTAIL_KEY . "rtmp");
  if ($mime_type == "video" && isset($rtmp)) {
    update_post_meta($post["ID"], LONGTAIL_KEY . "streamer", $attachment[LONGTAIL_KEY . "streamer"]);
    update_post_meta($post["ID"], LONGTAIL_KEY . "file", $attachment[LONGTAIL_KEY . "file"]);
    update_post_meta($post["ID"], LONGTAIL_KEY . "provider", $attachment[LONGTAIL_KEY . "provider"]);
  }
  if ($mime_type == "video" || $mime_type == "audio") {
    update_post_meta($post["ID"], LONGTAIL_KEY . "thumbnail", $attachment[LONGTAIL_KEY . "thumbnail"]);
    update_post_meta($post["ID"], LONGTAIL_KEY . "thumbnail_url", $attachment[LONGTAIL_KEY . "thumbnail_url"]);
    update_post_meta($post["ID"], LONGTAIL_KEY . "creator", $attachment[LONGTAIL_KEY . "creator"]);
  }
  if ($mime_type == "image") {
    update_post_meta($post["ID"], LONGTAIL_KEY . "duration", $attachment[LONGTAIL_KEY . "duration"]);
  }
  return $post;
}

// Filter hook for specifying additional fields to appear when editing
// attachments.
add_filter("attachment_fields_to_edit", "jwplayer_attachment_fields", 10, 2);

/**
 * Handler function for displaying custom fields.
 * @param array $form_fields The fields to appear on the attachment form.
 * @param array $post Object representing the post we are saving to.
 * @return array Updated $form_fields with the new fields.
 */
function jwplayer_attachment_fields($form_fields, $post) {
  $mime_type = substr($post->post_mime_type, 0, 5);
  switch($mime_type) {
    case "image":
      $form_fields[LONGTAIL_KEY . "duration"] = array(
        "label" => __("Duration"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "duration", true)
      );
      break;
    case "audio":
    case "video":
      $form_fields[LONGTAIL_KEY . 'thumbnail_url'] = array(
        "label" => __("Thumbnail URL"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "thumbnail_url", true)
      );
      $form_fields[LONGTAIL_KEY . "thumbnail"] = array(
        "label" => __("Thumbnail"),
        "input" => "html",
        "html" => generateImageSelectorHTML($post->ID)
      );
      $form_fields[LONGTAIL_KEY . "creator"] = array(
        "label" => __("Creator"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "creator", true)
      );
      break;
  }
  $rtmp = get_post_meta($post->ID, LONGTAIL_KEY . "rtmp");
  if ($mime_type == "video" && isset($rtmp) && $rtmp) {
    unset($form_fields["url"]);
    $form_fields[LONGTAIL_KEY . "streamer"] = array(
        "label" => __("Streamer"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "streamer", true)
    );
    $form_fields[LONGTAIL_KEY . "file"] = array(
        "label" => __("File"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "file", true)
    );
    $form_fields[LONGTAIL_KEY . "provider"] = array(
        "label" => __("Provider"),
        "input" => "text",
        "value" => get_post_meta($post->ID, LONGTAIL_KEY . "Provider", true)
    );
  }
  if (isset($_GET["post_id"]) && ($mime_type == "video" || $mime_type == "audio" || $mime_type == "image")) {
    $insert = "<input type='submit' class='button-primary' name='send[$post->ID]' value='" . esc_attr__( 'Insert JW Player' ) . "' />";
    $form_fields[LONGTAIL_KEY . "player_select"] = array(
      "label" => __("Select Player"),
      "input" => "html",
      "html" => generatePlayerSelectorHTML($post->ID)
    );
    $form_fields["jwplayer"] = array("tr" => "\t\t<tr class='submit'><td></td><td class='savesend'>$insert</td></tr>\n");
  }
  return $form_fields;
}

/**
 * Generates the HTML for rendering the thumbnail image selector.
 * @param int $id The id of the current attachment.
 * @return string The HTML to render the image selector.
 */
function generateImageSelectorHTML($id) {
  $output = "";
  $args = array(
    "post_type" => "attachment",
    "numberposts" => -1,
    "post_status" => null,
    "post_parent" => null
  );
  $attachments = get_posts($args);
  if ($attachments) {
    $output .= "<script language='javascript' src='" . WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . "/msdropdown/js/uncompressed.jquery.dd.js' type='text/javascript'></script>\n";
    $output .= "<link rel='stylesheet' type='text/css' href='" . WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . "/msdropdown/dd.css' />\n";
    $output .= "<script language='javascript'>jQuery(document).ready(function(e) {jQuery(\"#imageselector$id\").msDropDown({visibleRows:3, rowHeight:50});});</script>\n";
    $output .= "<select name='attachments[$id][" . LONGTAIL_KEY . "thumbnail]' id='imageselector$id' width='200' style='width:200px;'>\n";
    $output .= "<option value='-1'>None</option>\n";
    $image_id = get_post_meta($id, LONGTAIL_KEY . "thumbnail", true);
    foreach($attachments as $post) {
      if (substr($post->post_mime_type, 0, 5) == "image") {
        $selected = $post->ID == $image_id ? "selected='selected'" : "";
        $output .= "<option value='" . $post->ID . "' title='" . $post->guid . "' " . $selected . ">" . $post->post_title . "</option>\n";
      }
    }
    $output .= "</select>\n";
  }
  return $output;
}

/**
 * Generates the combobox of available players.
 * @param int $id The attachment id.
 * @return string The HTML to render the player selector.
 */
function generatePlayerSelectorHTML($id) {
  $player_select = "<select name='attachments[$id][" . LONGTAIL_KEY . "player_select]' id='" . LONGTAIL_KEY . "player_select_" . $id . "'>\n";
  $player_select .= "<option value='Default'>Default</option>\n";
  $configs = LongTailFramework::getConfigs();
  foreach ($configs as $config) {
    if ($config != "New Player") {
      $player_select .= "<option value='" . $config . "'>" . $config . "</option>\n";
    }
  }
  $player_select .= "</select>\n";
  return $player_select;
}

// Filter hook for modifying the text inserted into the post body.
add_filter("media_send_to_editor", "jwplayer_tag_to_editor", 11, 3);

/**
 * Handler function for modifying the text entered into the post body.  If the
 * "Insert JW Player" button isn't hit the standard WordPress behavior is used.
 * Otherwise the jwplayer tag is inserted.
 * @param string $html The html WordPress will insert.
 * @param string $send_id The id of the object triggering the insert.
 * @param array $attachment The attachment to be inserted.
 * @return string The text to be inserted.
 */
function jwplayer_tag_to_editor($html, $send_id, $attachment) {
  if ($_POST["send"][$send_id] == "Insert JW Player") {
    $output = "[jwplayer ";
    if ($attachment[LONGTAIL_KEY . "player_select"] != "Default") {
      $output .= "config=\"" . $attachment[LONGTAIL_KEY . "player_select"] . "\" ";
    }
    $output .= "mediaid=\"" . $send_id . "\"]";
    return $output;
  }
  return $html;
}

// Action hook for defining what the URL tab should use to render itself.
add_action("media_upload_jwplayer_url", "jwplayer_url_render");

/**
 * Handler for rendering the External Media tab.
 * @return string The HTML to render the tab.
 */
function jwplayer_url_render() {
  if (!empty($_POST)) {
    $return = media_upload_form_handler();

    if (is_string($return)) {
      return $return;
    }
    if (is_array($return)) {
      $errors = $return;
    }
  }
  require_once (dirname(__FILE__) . "/JWURLImportManager.php");
  return wp_iframe("media_jwplayer_url_insert_form", $errors);
}

// Action hook for defining what the Playlist tab should use to render itself.
add_action("media_upload_jwplayer", "jwplayer_render");

/**
 * Handler for rendering the JW Playlist Manager tab.
 * @return string The HTML to render the tab.
 */
function jwplayer_render() {
  if (!empty($_POST)) {
    $return = media_upload_form_handler();

    if (is_string($return)) {
      return $return;
    }
    if (is_array($return)) {
      $errors = $return;
    }
  }
  wp_enqueue_script('admin-gallery');
  require_once (dirname (__FILE__) . "/EmbedManager.php");
  return wp_iframe("media_jwplayer_insert_form", $errors);
}

// Filter hook for adding additional tabs.
add_filter("media_upload_tabs", "jwplayer_tab");

/**
 * Handler for adding additional tabs.
 * @param array $_default_tabs The array of tabs.
 * @return array $_default_tabs with the new tabs added.
 */
function jwplayer_tab($_default_tabs) {
  $_default_tabs["jwplayer_url"] = "From URL";
  $_default_tabs["jwplayer"] = "Playlists";
  return $_default_tabs;
}

// Filter hook for modifying the URL that displays for URL attachments.
add_filter("wp_get_attachment_url", "url_attachment_filter", 10, 2);

/**
 * Handler for modifying the attachment url.
 * @param string $url The current URL.
 * @param <type> $id The id of the post.
 * @return string The modified URL.
 */
function url_attachment_filter($url, $id) {
  preg_match_all("/http:\/\/|rtmp:\/\//", $url, $matches);
  if (count($matches[0]) > 1) {
    $upload_dir = wp_upload_dir();
    return str_replace($upload_dir["baseurl"] . "/", "", $url);
  }
  return $url;
}

// Filter hook for modifying the file value that appears in the Media Library.
add_filter("get_attached_file", "url_attached_file", 10, 2);

/**
 * Handler for modifying the path to the attached file.
 * @param string $file The current file path.
 * @param int $attachment_id The id of the attachmenet.
 * @return string The modified file path.
 */
function url_attached_file($file, $attachment_id) {
  $external = get_post_meta($attachment_id, LONGTAIL_KEY . "external", true);
  if (substr($post["post_mime_type"], 0, 5) == "video" || $external) {
    $upload_dir = wp_upload_dir();
    return str_replace($upload_dir["basedir"] . "/", "", $file);
  }
  return $file;
}

?>
