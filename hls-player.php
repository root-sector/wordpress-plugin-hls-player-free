<?php
/**
 * Plugin Name: HLS Player
 * Plugin URI: https://github.com/root-sector/wordpress-plugin-hls-player-free
 * Description: HLS Player is a simple, lightweight HTTP Live Streaming player for WordPress. Leveraging video.js, the leading open-source HTML5 player, it enables effortless embedding of both responsive and fixed-width .m3u8 or .mpd HLS videos into posts and pages.
 * Version: 1.0.11
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

define('HLS_PLAYER_VERSION', '1.0.11');

class HLSPlayer
{
    private $plugin_version;

    public function __construct()
    {
        $this->plugin_version = HLS_PLAYER_VERSION;

        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_and_styles'));

        // Shortcodes and filters
        add_shortcode('hls_player', array($this, 'hls_player_shortcode'));
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_excerpt', 'do_shortcode', 11);
        add_filter('the_content', 'do_shortcode', 11);
    }

    // Enqueue Video.js script and styles
    public function enqueue_scripts_and_styles()
    {
        if (!is_admin()) {
            wp_enqueue_script('videojs', plugins_url('public/js/video.min.js', __FILE__), array(), $this->plugin_version, false);
            wp_enqueue_style('videojs', plugins_url('public/css/video-js.min.css', __FILE__), array(), $this->plugin_version);
        }
    }

    public function hls_player_shortcode($atts)
    {
        // Prevent parsing of the shortcode if admin
        if (is_admin()) {
            return;
        }

        // Define allowed shortcode attributes with defaults
        $allowed_atts = array(
            'url' => '',
            'class' => 'video-js vjs-fluid',
            'width' => '',
            'height' => '',
            'controls' => '',
            'preload' => 'auto',
            'autoplay' => 'false',
            'loop' => '',
            'muted' => '',
            'poster' => '',
            'captions' => '',
            'protected' => 'false',
            'withcredentials' => 'false',
            'kinesis_video_stream' => 'false',
            'cloudfront_signed_cookies' => 'false',
            'videojs_custom_options_json' => '{}',
        );

        // Only use attributes that are explicitly defined in allowed_atts
        $filtered_atts = is_array($atts) ? array_intersect_key($atts, $allowed_atts) : array();
        
        // Parse shortcode attributes with our filtered attributes
        $atts = shortcode_atts($allowed_atts, $filtered_atts, 'videojs_hls');

        // Generate a unique id for the video element
        $video_id = uniqid('video_');

        // Generate video tag attributes
        $class = !empty($atts['class']) ? esc_attr($atts['class']) : 'video-js vjs-fluid';
        $controls = $atts['controls'] == 'false' ? '' : ' controls';
        $preload = $atts['preload'] == 'metadata' ? ' preload="metadata"' : ($atts['preload'] == 'none' ? ' preload="none"' : ' preload="auto"');
        $autoplay = $atts['autoplay'] == 'true' ? ' autoplay' : '';
        $loop = $atts['loop'] == 'true' ? ' loop' : '';
        $muted = $atts['muted'] == 'true' ? ' muted' : '';
        $poster = !empty($atts['poster']) ? ' poster="' . esc_url($atts['poster']) . '"' : '';

        $type = ''; // Initialize with empty type

        // Extract the url attribute
        $url = $atts['url'];
        if (!empty($url)) {
            $fileparts = pathinfo($url);
            $extension = $fileparts['extension'];
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
        }

        // Extract the captions attribute
        $captions = isset($atts['captions']) ? $atts['captions'] : '';

        // Parse the captions attribute to support multiple languages and detect the default
        $captions_data = array();
        if (!empty($captions)) {
            $captions_arr = explode(',', $captions);
            foreach ($captions_arr as $caption) {
                $caption_parts = explode('|', $caption);
                if (count($caption_parts) >= 3) {
                    $captions_data[] = array(
                        'src' => trim($caption_parts[0]),
                        'srclang' => trim($caption_parts[1]),
                        'label' => trim($caption_parts[2]),
                        'default' => (count($caption_parts) > 3 && trim($caption_parts[3]) === 'default') ? 'true' : 'false',
                    );
                }
            }
        }

        $video_html = sprintf(
            '<div style="position: relative;"><video id="%s" class="%s"%s%s%s%s%s%s%s%s></video></div>',
            esc_attr($video_id),
            $class,
            $controls,
            $preload,
            $autoplay,
            $loop,
            $muted,
            $poster,
            !empty($atts['width']) ? ' width="' . esc_attr($atts['width']) . '"' : '',
            !empty($atts['height']) ? ' height="' . esc_attr($atts['height']) . '"' : ''
        );

        $script_data = array(
            'video_id' => $video_id,
            'src' => esc_url_raw($url),
            'type' => $type,
            'captions_data' => $captions_data,
            'videojs_custom_options_json' => $atts['videojs_custom_options_json'],
        );

        $encoded_data = base64_encode(json_encode($script_data));
        $inline_script = "var hlsPlayerData_{$video_id} = '" . esc_js($encoded_data) . "';";

        // Enqueue the main script and add the inline script
        wp_enqueue_script('hls-player-script', plugins_url('public/js/hls-player.min.js', __FILE__), array('videojs'), $this->plugin_version, true);
        wp_add_inline_script('hls-player-script', $inline_script);

        return $video_html;
    }
}

// Initialize the plugin
$hls_player = new HLSPlayer();
