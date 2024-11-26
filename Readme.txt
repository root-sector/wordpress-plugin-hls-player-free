=== HLS Player ===
Contributors: r00tsector
Tags: video player, hls, streaming, videojs, video embedding
Donate link: https://donate.stripe.com/5kA7w2bRl3KN7qU3cd
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 8.1
Stable tag: 1.0.11
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0

HLS Player is a lightweight HTTP Live Streaming player for WordPress, using video.js for easy embedding HLS videos into posts and pages.

== Description ==

HLS Player Video Plugin: Streamline your WordPress with the definitive HLS video embedding solution. Powered by the acclaimed Video.js player, this plugin guarantees an exceptional viewing experience.

Key Features:
* **Effortless Integration**: Embed HLS videos anywhere on your site with ease.
* **Adaptive Design**: Provides a seamless viewing experience on all devices.
* **Universal Compatibility**: Ensures full HTML5 support across all browsers.
* **Visual Appeal:** Customize with video posters for an engaging look.
* **Instant Play**: Auto-playback for immediate engagement.
* **Backup Options**: Embed fallback videos directly from your media library.
* **Simple Installation**: Get started quickly without complex configurations.
* **Performance-Focused**: Lightweight build for fast site performance.
* **Modern Interface**: Enjoy a sleek, watermark-free video player.
* **Versatile Playback**: Supports a range of HTML5 video formats.
* **Accessibility Features**: Include captions and subtitles for a wider audience.
* **Multilingual Support**: Offers captions in various languages.
* **Designed for flexibility**, the WordPress HLS Player Plugin simplifies embedding both local and external .m3u8 or .mpd HLS files. It’s tailored for both responsive and fixed-width layouts, ensuring a straightforward embedding process.

Elevate your WordPress site with the HLS Player Video Plugin – the pinnacle of professional-grade video streaming.

== HLS Player Plugin Usage ==

To embed a video, create a new post/page and use the following shortcode:

`[hls_player url="https://example.com/path/to/video_playlist.m3u8"]`

Specify the "url" parameter with the location of the HLS video package file. Supported formats include .m3u8 (application/x-mpegURL), .mpd (application/dash+xml), and .mp4 (video/mp4).

= Video Shortcode Options =

### General Options

**class**: Define the Video.js player's CSS class (Default: video-js). Additional classes listed at https://videojs.com/guides/layout/#classes

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" class="video-js vjs-fluid vjs-16-9"]`

**width**: Defines the width of the video file.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" width="480"]`

**height**: Defines the height of the video file.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" height="264"]`

**controls**: Specify whether video controls should be displayed (Default: "true"). Use "false" to hide controls. When you disable controls users will not be able to interact with your videos. So It is recommended that you enable autoplay for a video with no controls.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" controls="false"]`

**preload**: Specify how the video should be loaded when the page loads (Default: "auto"). Options include "metadata," "none," and "auto."
"metadata" - Load only the meta data of the video, which includes information like the duration and dimensions of the video. Sometimes, the meta data will be loaded by downloading a few frames of video.
"none" - Don't preload any data. The browser will wait until the user hits "play" to begin downloading.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" preload="metadata"]`

**autoplay**: Cause the video to play automatically when the page loads. Instead of using the autoplay attribute you maybe need to pass an autoplay option to videojs_custom_options_json. https://videojs.com/guides/options/#autoplay

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" autoplay="true"]`

**loop**: Make the video loop to the beginning when finished and automatically continue playing.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" loop="true"]`

**poster**: Define an image as a placeholder before the video plays.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" poster="http://example.com/wp-content/uploads/poster.jpg"]`

**muted**: Specify that the audio output of the video should be muted.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" muted="true"]`

**captions**: Add captions or subtitles to the video in multiple languages. Provide the captions in the format:

`"path/to/captions1.vtt|lang1|label1|default,path/to/captions2.vtt|lang2|label2"`

path/to/captions: The URL or path to the VTT file containing the subtitles.
lang: The two-character language code, followed by a hyphen and an optional country code (e.g., en, de, en-US, de-DE).
label: A user-friendly label for the caption (e.g., "English", "German").
default: (Optional) Use this keyword to specify which caption should be enabled by default when the video is loaded.

`[hls_player url="https://example.com/path/to/video_playlist.m3u8" captions="https://example.com/path/to/captions-en.vtt|en-EN|English|default,https://example.com/path/topath/to/captions-de.vtt|de-de|German"]`

**videojs_custom_options_json**: JSON format string for custom options (https://videojs.com/guides/options/) for the video.js player.

`
[hls_player url="https://example.com/path/to/video_playlist.m3u8" videojs_custom_options_json='{"autoplay": "muted"}']
or
[hls_player url="https://example.com/path/to/video_playlist.m3u8" videojs_custom_options_json='{"autoplay": true,"liveui": true,"liveTracker": {"trackingThreshold": 8}}']
`

== Get more advanced features with HLS Player PRO ==

=== AWS CloudFront Integration ===
**=> Global Reach**: Utilize the expansive AWS CloudFront network for low-latency streaming across the globe.
**=> Enhanced Security**: Protect your content with CloudFront Signed Cookies, ensuring that only authorized viewers can access your videos. This feature is particularly useful for preventing unauthorized sharing and downloads, as it ties the video access to specific, signed cookies that are difficult to replicate or redistribute.
**=> Simplified Configuration**: Follow our easy-to-understand instructions to set up CloudFront and implement signed cookies, making your videos secure and your setup hassle-free.

=== AWS Kinesis Video Streams Integration ===
**=> Flexible Streaming**: Leverage AWS Kinesis Video Streams for both live and on-demand video streaming.
**=> Direct Downloads**: Enable users to download clips directly from the player, enhancing the viewer experience.

=== Subscription Management ===
**=> Integrated Solution**: Combine aMember and WordPress roles for efficient subscription management.
**=> Exclusive Content**: Offer videos exclusively to active subscribers, adding value to your membership packages.

=== Analytics Integration ===
**=> In-depth Tracking**: Support for Google Tag Manager and Google Analytics allows you to monitor detailed video statistics.
**=> Viewer Insights**: Gain insights into playback duration and user engagement, helping you to optimize your content strategy.

=== Streaming Optimization ===
**=> Effortless Conversion**: Transform .mp4 files into the .m3u8 format with ease, using our tools for Windows or macOS.
**=> Comprehensive Guides**: Benefit from our in-depth guides for video file conversion, AWS S3 and CloudFront configuration and AWS Kinesis Video Stream integration, ensuring a smooth setup process.

[Check out HLS Player PRO >](https://hls-player-pro.root-sector.com/)

== Installation ==

1. Navigate to the `Add New` plugins screen in your WordPress Dashboard.
2. Click the `Upload` tab.
3. Browse for the plugin file (hls-player.zip) on your computer.
4. Click `Install Now` and then activate the plugin.

== Changelog ==
= 1.0.10 =
* Fixed: Improved captions functionality in the shortcode to clarify language codes and default settings for better user experience.

= 1.0.9 =
* Added: Wordpress v6.6 compatibility

= 1.0.8 =
* Added: videojs_custom_options_json shortcode
* Removed: jquery is no longer required

= 1.0.7 =
* Fixed: Include required jquery component for the player

= 1.0.6 =
* Improved: Compatibility for multiple themes and plugins

= 1.0.5 =
* Added: Support for multiple video players on one post/page

= 1.0.4 =
* Added: Wordpress v6.5.4 compatibility

= 1.0.3 =
* Improved: Minor changes

= 1.0.2 =
* Improved: Minor changes

= 1.0.2 =
* Changed: Updated dependencies to newer versions for improved performance and security
* Changed: Refactoring the hls_player_shortcode function to pass data to the JavaScript code
* Changed: Moving the JavaScript code to a separate file for better organization

= 1.0.1 =
* Added: vjs-fluid class as default to adjust player size automatically
* Improved: Removed CDN for video.js css and js file
* Improved: Prevent direct module access

= 1.0.0 =
* Released: Initial version of the software
