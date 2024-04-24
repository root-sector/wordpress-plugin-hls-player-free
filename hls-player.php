<?php
/**
 * Plugin Name: HLS Player
 * Plugin URI: https://github.com/root-sector/wordpress-plugin-hls-player-free
 * Description: HLS Player is a simple, lightweight HTTP Live Streaming player for WordPress. Leveraging video.js, the leading open-source HTML5 player, it enables effortless embedding of both responsive and fixed-width .m3u8 or .mpd HLS videos into posts and pages.
 * Version: 1.0.0
 * Requires at least: 6.4
 * Requires PHP: 8.1
 * Author: Root Sector Ltd. & Co. KG
 * Author URI: https://root-sector.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */
class HLSPlayer {
    private $plugin_version;

    public function __construct() {
        $this->plugin_version = '1.0.0';

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

    }

    // Enqueue Video.js script and styles
    public function enqueue_scripts_and_styles() {
        wp_enqueue_script('hlsplayer', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/8.10.0/video.min.js', array(), $this->plugin_version, false);
        wp_enqueue_style('hlsplayer', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/8.10.0/video-js.min.css', array(), $this->plugin_version);
    }

    // Returns the video element HTML code for the shortcode
    public function hls_player_shortcode($atts) {
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
        if (!empty($atts['class'])) $class = $atts['class'];
        else $class = 'video-js';

        // Controls
        if ($atts['controls'] == 'false') $controls = '';
        else $controls = ' controls';

        // Preload
        if ($atts['preload'] == 'metadata') $preload = ' preload="metadata"';
        else if ($atts['preload'] == 'none') $preload = ' preload="none"';
        else $preload = ' preload="auto"';

        // Autoplay
        if ($atts['autoplay'] == 'true') $autoplay = ' autoplay';
        else $autoplay = '';

        // Loop
        if ($atts['loop'] == 'true') $loop = ' loop';
        else $loop = '';

        // Muted
        if ($atts['muted'] == 'true') $muted = ' muted';
        else $muted = '';

        // Poster
        if (!empty($atts['poster'])) $poster = ' poster="' . $atts['poster'] . '"';
        else $poster = '';

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
            <video id="' . $video_id . '" class="' . $class . '" ' . $controls . $preload . $autoplay . $loop . $muted . $poster . ' width="'. $atts['width'] .'" height="'. $atts['height'] .'">
            </video>
            </div>
            <script>
            // Run the code after the document is ready
            const onReady = (callback) => {
                if (document.readyState != \'loading\') callback();
                else document.addEventListener(\'DOMContentLoaded\', callback);
            };
            onReady(() => {
                // Set the video source using the player.src method and reload the videojs player
                let src = "' . $url . '";
                let player = videojs(\'' . $video_id . '\');
                // Set the video source using the player.src method
                player.src(' . wp_json_encode(array(
                'src' => $url,
                'type' => $type,
                )) . ');
                ';
        // Add remote text tracks for captions
        foreach ($captions_data as $caption) {
            $video_html .= '
                player.addRemoteTextTrack({
                    kind: "subtitles",
                    src: "' . $caption['src'] . '",
                    srclang: "' . $caption['srclang'] . '",
                    label: "' . $caption['label'] . '",
                    default: ' . $caption['default'] . '
                }, false);
                ';
        }
        $video_html .= 'player.load();
            });</script>';

        // Return the video element HTML code
        return $video_html;
    }
}

// Initialize the plugin
$hls_player = new HLSPlayer();
