<?php
/**
 * Plugin Name: HLS Player
 * Plugin URI: https://github.com/root-sector/wordpress-plugin-hls-player-free
 * Description: HLS Player is a simple, lightweight HTTP Live Streaming player for WordPress. Leveraging video.js, the leading open-source HTML5 player, it enables effortless embedding of both responsive and fixed-width .m3u8 or .mpd HLS videos into posts and pages.
 * Version: 1.0.5
 * Requires at least: 6.4
 * Requires PHP: 8.1
 * Author: Root Sector Ltd. & Co. KG
 * Author URI: https://root-sector.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HLS_PLAYER_VERSION', '1.0.5');

class HLSPlayer
{
    private $plugin_version;

    public function __construct()
    {
        $this->plugin_version = HLS_PLAYER_VERSION;

        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_and_styles'));

        // AJAX actions
        add_action('wp_ajax_sign_cookie_policy', array($this, 'process_video_signing_request'));
        add_action('wp_ajax_nopriv_sign_cookie_policy', array($this, 'process_video_signing_request'));

        // Shortcodes and filters
        add_shortcode('hls_player', array($this, 'hls_player_shortcode'));
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_excerpt', 'do_shortcode', 11);
        add_filter('the_content', 'do_shortcode', 11);

        // Add script localization for video instances
        add_action('wp_enqueue_scripts', array($this, 'enqueue_hls_player_script'));
    }

    // Enqueue Video.js script and styles
    public function enqueue_scripts_and_styles()
    {
        if (!is_admin()) {
            wp_enqueue_script('videojs', plugins_url('public/js/video.min.js', __FILE__), array(), $this->plugin_version, false);
            wp_enqueue_style('videojs', plugins_url('public/css/video-js.min.css', __FILE__), array(), $this->plugin_version);
        }
    }

    public function enqueue_hls_player_script()
    {
        if (!is_admin() && isset($GLOBALS['hlsPlayerData']) && !empty($GLOBALS['hlsPlayerData'])) {
            wp_enqueue_script('hls-player-script', plugins_url('public/js/hls-player.min.js', __FILE__), array('videojs'), $this->plugin_version, true);
            wp_localize_script('hls-player-script', 'hlsPlayerData', $GLOBALS['hlsPlayerData']);
        }
    }

    public function hls_player_shortcode($atts)
    {
        // Parse the attributes and set the default value for url
        $atts = shortcode_atts(
            array(
                'url' => '',
                'class' => '',
                'width' => '',
                'height' => '',
                'controls' => '',
                'preload' => 'auto',
                'autoplay' => 'false',
                'loop' => '',
                'muted' => '',
                'poster' => '',
                'captions' => '',
            ),
            $atts,
            'videojs_hls'
        );

        // Generate a unique id for the video element
        $video_id = uniqid('video-');

        // Define custom css classes for videojs player
        $class = !empty($atts['class']) ? $atts['class'] : 'video-js vjs-fluid';

        // Controls
        $controls = $atts['controls'] == 'false' ? '' : ' controls';

        // Preload
        $preload = $atts['preload'] == 'metadata' ? ' preload="metadata"' : ($atts['preload'] == 'none' ? ' preload="none"' : ' preload="auto"');

        // Autoplay
        $autoplay = $atts['autoplay'] == 'true' ? ' autoplay' : '';

        // Loop
        $loop = $atts['loop'] == 'true' ? ' loop' : '';

        // Muted
        $muted = $atts['muted'] == 'true' ? ' muted' : '';

        // Poster
        $poster = !empty($atts['poster']) ? ' poster="' . $atts['poster'] . '"' : '';

        // Extract the url attribute
        $url = $atts['url'];

        // Check the file extension of the url
        $fileparts = pathinfo($url);
        $extension = $fileparts['extension'];

        // Set the type attribute according to the file extension
        switch ($extension) {
            case 'm3u8':
                $type = 'application/x-mpegURL';
                break;
            case 'mpd':
                $type = 'application/dash+xml';
                break;
            case 'mp4':
                $type = 'video/mp4';
                break;
            default:
                $type = '';
        }

        // Extract the captions attribute
        $captions = isset($atts['captions']) ? $atts['captions'] : '';

        // Parse the captions attribute to support multiple languages
        $captions_data = array();
        if (!empty($captions)) {
            $captions_arr = explode(',', $captions);
            foreach ($captions_arr as $caption) {
                $caption_parts = explode('|', $caption);
                if (count($caption_parts) === 3) {
                    $captions_data[] = array(
                        'src' => trim($caption_parts[0]),
                        'srclang' => trim($caption_parts[1]),
                        'label' => trim($caption_parts[2]),
                        'default' => (count($caption_parts) > 3 && trim($caption_parts[3]) === 'default') ? 'true' : 'false',
                    );
                }
            }
        }

        $video_html = '
        <div style="position: relative;">
            <video id="' . $video_id . '" class="' . $class . '" ' . $controls . $preload . $autoplay . $loop . $muted . $poster . ' width="' . $atts['width'] . '" height="' . $atts['height'] . '">
            </video>
        </div>';

        $script_data = array(
            'video_id' => $video_id,
            'src' => $url,
            'type' => $type,
            'captions_data' => $captions_data,
        );

        if (!isset($GLOBALS['hlsPlayerData'])) {
            $GLOBALS['hlsPlayerData'] = array();
        }
        $GLOBALS['hlsPlayerData'][] = $script_data;

        wp_enqueue_script('hls-player-script', plugins_url('public/js/hls-player.js', __FILE__), array('videojs'), $this->plugin_version, true);

        return $video_html;
    }
}

// Initialize the plugin
$hls_player = new HLSPlayer();
