<?php

// Utility class that holds accessible settings and methods.
class JWP6_Plugin {

    public static $cdn_http_player = 'http://p.jwpcdn.com/6/2/jwplayer.js';

    public static $cdn_https_player = 'https://ssl.p.jwpcdn.com/6/2/jwplayer.js';

    public static $default_image = '/img/default-image.png';

    public static $ping_image = "http://i.n.jwpltx.com/v1/wordpress/ping.gif";

    public static $urls = array(
        'mail_support'      => "mailto:wordpress@longtailvideo.com",
        'forums'            => "http://www.longtailvideo.com/support/forums/jw-player/",
        'player_docs'       => "http://www.longtailvideo.com/support/jw-player/",
        'player_download'   => "http://www.longtailvideo.com/jw-player/download/",
        'player_pricing'    => "http://www.longtailvideo.com/jw-player/pricing/"
    );

    public static $license_versions = array(
        'free',
        'pro',
        'premium',
        'ads'
    );

    public static $player_options = array(
        // LAYOUT
        'controls' => array(
            'options' => false,
            'default' => true,
            'discard_if_default' => true,
            'help_text' => 'Whether to display the video controls (controlbar, icons and dock).',
            'text' => 'Display player controls.',
        ),
        'stretching' => array(
            'options' => array(
                'none' => 'Keep original dimensions',
                'exactfit' => 'Stretch disproportionally',
                'uniform' => 'Stretch proportionally (black borders)',
                'fill' => 'Stretch proportionally (parts cut off)',
            ),
            'default' => 'uniform',
            'discard_if_default' => true,
            'help_text' => 'How to resize the poster and video to fit the display.',
        ),
        'skin' => array(
            'options' => array( 
                'NULL' => 'Six (default)',
                'beelden' => 'Beelden',
                'bekle' => 'Bekle', 
                'five' => 'Five', 
                'glow' => 'Glow',
                'modieus' => 'Modieus',
                'roundster' => 'Roundster',
                'stormtrooper' => 'Stormtrooper',
                'vapor' => 'Vapor',
            ),
            'default' => 'NULL',
            'discard_if_default' => true,
            'licenses' => array('premium', 'ads'),
        ),

        // PLAYBACK
        'autostart' => array(
            'options' => false,
            'default' => false,
            'help_text' => 'Automatically start playing the video on page load. Autostart does not work on mobile devices like iOS and Android.',
            'text' => 'Start playing immediately',
            'discard_if_default' => true,
        ),
        'fallback' => array(
            'options' => false,
            'default' => true,
            'help_text' => 'Whether to render a nice download link for the video if HTML5 and/or Flash are not supported.',
            'text' => 'Render a nice download link if HTML5 and Flash are not supported.',
            'discard_if_default' => true,
        ),
        'mute' => array(
            'options' => false,
            'default' => false,
            'help_text' => 'Whether to have the sound muted on startup or not.',  
            'text' => 'Mute player sound on startup.',
            'discard_if_default' => true,
        ),
        'primary' => array(
            'options' => array('html5', 'flash'),
            'default' => 'html5',
            'help_text' => 'Which rendering mode to try first for rendering the player.',
            'discard_if_default' => true,
        ),
        'repeat' => array(
            'options' => false,
            'default' => false,
            'help_text' => 'Whether to loop playback of the playlist or not.', 
            'text' => 'Loop the playback of your video/playlist.',
            'discard_if_default' => true,
        ),
        // 'startparam' => array(
        //     'default' => '',
        //     'help_text' => 'Querystring parameter for seeking to not-yet-download portions of FLV or MP4 files in Flash mode. Not needed for HTML5 (where this works by default). See Pseudostreaming in Flash for more info.',
        //     'discard_if_default' => true,
        // ),

        // LISTBAR
        'listbar__position' => array(
            'options' => array(
                'none' => 'Do not show listbar',
                'bottom' => 'Show listbar below player',
                'right' => 'Show listbar to the right of the player',
            ),
            'default' => 'none',
            // 'discard_if_default' => true,
            'help_text' => 'Position of the listbar relative to the video display. You can choose no listbar, a listbar below the display, to the right of the display.'
        ),
        'listbar__size' => array(
            'default' => 180,
            'discard_if_default' => true,
            'help_text' => 'Width (if position is right) or height (if position is bottom) of the listbar. This is basically the amount of pixels the bar "steals" from the video window.',
        ),

        // LOGO
        'logo' => array (
            'licenses' => array('pro', 'premium', 'ads'),
        ),
        'logo__file' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'default' => '',
            'discard_if_default' => true,
            'help_text' => 'Location of an external JPG, PNG or GIF image to be used as watermark (e.g. /assets/logo.png). We recommend using 24 bit PNG images with transparency, since they blend nicely with the video.',
        ),
        'logo__hide' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'options' => false,
            'default' => false,
            'help_text' => 'By default (false), the logo remains visible all the time. When this option is set to true, the logo will automatically show and hide along with the other player controls',
            'text' => 'Hide logo during playback.',
            // 'discard_if_default' => true,
        ),
        'logo__link' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'default' => 'http://www.longtailvideo.com/jw-player/learn-more/',
            'discard_if_default' => true,
            'help_text' => 'HTTP URL to jump to when the watermark image is clicked (e.g. http://example.com/). If it is not set, a click on the watermark does nothing in particular.',
        ),
        'logo__margin' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'default' => 8,
            'help_text' => 'The distance of the logo from the edges of the display. The default is 8 pixels.',
            'discard_if_default' => true,
        ),
        'logo__position' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'options' => array('top-right', 'top-left', 'bottom-right', 'bottom-left', ),
            'default' => 'top-right',
            'help_text' => 'This sets the corner in which to display the watermark. Note the default position (top-right) is preferred, since the logo won\'t interfere with the controlbar, captions, overlay ads and dock buttons.',
            'discard_if_default' => true,
        ),

        // RIGHTCLICK
        'abouttext' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'default' => '',
            'discard_if_default' => true,
            'help_text' => 'Text to display in the right-click menu. The default is About JW Player 6.x.xxx.',
        ),

        'aboutlink' => array(
            'licenses' => array('pro', 'premium', 'ads'),
            'default' => '',
            'discard_if_default' => true,
            'help_text' => 'URL to link to when clicking the right-click menu. The default is http://www.longtailvideo.com/jw-player/learn-more.',
        ),

        // Google Analytics 

        'ga' => array (
            'licenses' => array('premium', 'ads'),
            'options' => false,
            'default' => false,
            'discard_if_default' => true,
            'stringval' => '{}',
            'text' => 'Enable google analytics for JW Player.',
            'help_text' => 'Please note that in order for Google Analytics to work you to have it installed in your Wordpress install.',
        ),

        // Sharing

        'sharing' => array (
            'licenses' => array('premium', 'ads'),
            'options' => false,
            'default' => false,
            'stringval' => '{}',
            'discard_if_default' => true,
            'text' => 'Enable sharing for this player.',
            'help_text' => 'When enabled the player will display sharing options which will link to the current page.',
        ),

        // Advertising

        'advertising' => array (
            'licenses' => array('ads'),
        ),

        'advertising__client' => array(
            'licenses' => array('ads'),
            'options' => array(
                'NULL' => 'No advertising client',
                'vast' => 'Video Ad Serving Template (VAST)',
                'googima' => 'Google Interactive Media Ads (IMA)',
            ),
            'default' => 'NULL',
            'discard_if_default' => true,
        ),

        'advertising__tag' => array(
            'licenses' => array('ads'),
            'default' => '',
            'discard_if_default' => true,
            'help_text' => 'This tag will automatically get scheduled as a pre-roll tag to your main video.',
        ),

    );

    public static $supported_video_extensions = array(
        'mp4', 'm4v', 'mov',
    );

    public static $supported_image_extensions = array(
        'png', 'jpg', 'jpeg',
    );

    public function __construct() {
    }

    public static function activate_plugin() {
        // Add the default player
        $default_player = new JWP6_Player();
        $default_player->save();

        // Set default option for tracking
        add_option(JWP6 . 'allow_anonymous_tracking', true, '', true);
    }

    public static function deactivate_plugin() {
        $purge = get_option(JWP6 . 'purge_settings_at_deactivation');
        if ( $purge ) {
            JWP6_Plugin::purge_settings(true);
        }
    }

    public static function purge_settings($purge_jwp5_settings_too = false) {
        if ( $purge_jwp5_settings_too && ! get_option(JWP6 . 'jwp5_purged') ) {
            JWP6_Legacy::purge_jwp5_settings();
        }
        global $wpdb;
        $meta_query = "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '" . JWP6 . "%';";
        $option_query = "DELETE FROM $wpdb->options WHERE option_name LIKE '" . JWP6 . "%'";
        $wpdb->query($meta_query);
        $wpdb->query($option_query);
    }

    public static function player_license_version() {
        $license_version = get_option(JWP6 . 'license_version');
        return ( $license_version && in_array($license_version, JWP6_Plugin::$license_versions) ) ? $license_version : "free";
    }

    public static function player_url() {
        if ( JWP6_PLAYER_LOCATION ) {
            return JWP6_PLAYER_LOCATION;
        }
        return ( is_ssl() ) ? JWP6_Plugin::$cdn_https_player : JWP6_Plugin::$cdn_http_player;
    }

    public static function player_license_key() {
        $key = get_option(JWP6 . 'license_key');
        return ( $key ) ? $key : null;
    }

    public static function playlist_url($id) {
        return get_option('siteurl') . '/' . 'index.php?jwp6=rss&id=' . $id;
    }

    public static function default_image_url() {
        return JWP6_PLUGIN_URL . JWP6_Plugin::$default_image;
    }

    public static function image_for_video_id($videoid) {
        $imageid = get_post_meta($videoid, JWP6 . 'thumbnail', true);
        if ($imageid) {
            $image = get_post($imageid);
            return $image->guid;
        }
        return JWP6_Plugin::default_image_url();
    }

    public static function option_available($option) {
        if ( array_key_exists($option, JWP6_Plugin::$player_options) ) {
            if ( array_key_exists( 'licenses', JWP6_Plugin::$player_options[$option]) ) {
                if ( ! in_array(JWP6_Plugin::player_license_version(), JWP6_Plugin::$player_options[$option]['licenses']) ) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function insert_license_key() {
        $key = get_option(JWP6 . 'license_key');
        if ( $key ) {
            ?>
            <script type="text/javascript">jwplayer.key='<?php echo $key; ?>';</script>
            <?php
        }
    }

    public static function register_query_vars($query_vars) {
        $query_vars[] = 'jwp6';
        return $query_vars;
    }

    public static function parse_request($wp) {
        if ( array_key_exists('jwp6', $wp->query_vars) && $wp->query_vars['jwp6'] == 'rss' ) {
            require_once (JWP6_PLUGIN_DIR . '/jwp6-playlist.php');
            exit();
        }
    }

    public static function insert_javascript() {
        wp_enqueue_script('jwplayer', JWP6_Plugin::player_url());
    }

    public static function validate_int($value) {
        $intval = intval($value);
        if ( '' . $intval == $value ) {
            return $intval;
        }
        return NULL;
    }

    public static function validate_empty_or_url($value) {
        if ( '' === $value ) return $value;
        $url = esc_url($value);
        if ( get_headers($url) ) {
            return $url;
        }
        return NULL;
    }

    public static function shortcode($shortcode, $content, $tag) {
        global $jwp6_global;
        // Keep track of the number of players that we are embedding;
        $jwp6_global['player_embed_count'] = ( array_key_exists('player_embed_count', $jwp6_global) ) ?
            $jwp6_global['player_embed_count'] + 1 : 0;
        $sc = new JWP6_Shortcode($shortcode);
        return $sc->embedcode($jwp6_global['player_embed_count']);
    }

    public static function register_actions() {
        register_activation_hook(JWP6_PLUGIN_FILE, array("JWP6_Plugin", "activate_plugin"));
        register_deactivation_hook(JWP6_PLUGIN_FILE, array("JWP6_Plugin", "deactivate_plugin"));
        if ( ! is_admin() ) {
            add_filter('query_vars', array('JWP6_Plugin', 'register_query_vars'));
            add_action('parse_request',  array('JWP6_Plugin', 'parse_request'), 9 );
            add_action('wp_enqueue_scripts', array('JWP6_Plugin', 'insert_javascript'));
            add_action('wp_head', array('JWP6_Plugin', 'insert_license_key'));
            add_shortcode('jwplayer', array('JWP6_Plugin', 'shortcode'));
        }
    }

}
