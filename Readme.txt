=== HLS Player ===
Contributors: r00tsector
Tags: video player, hls, streaming, videojs, video embedding
Donate link: https://donate.stripe.com/5kA7w2bRl3KN7qU3cd
Requires at least: 6.4
Tested up to: 6.5.4
Requires PHP: 8.1
Stable tag: 1.0.6
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

= HLS Player Plugin Usage =

To embed a video, create a new post/page and use the following shortcode:

`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8"]`

Specify the "url" parameter with the location of the HLS video package file. Supported formats include .m3u8 (application/x-mpegURL), .mpd (application/dash+xml), and .mp4 (video/mp4).

= Video Shortcode Options =

The shortcode supports the following options:

* **class**: Define the Video.js player's CSS class (Default: video-js). Additional classes listed at https://videojs.com/guides/layout/#classes
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" class="video-js vjs-fluid vjs-16-9"]`

* **width**: Defines the width of the video player.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" width="480"]`

* **height**: Defines the height of the video player.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" height="264"]`

* **controls**: Specify whether video controls should be displayed (Default: "true"). Use "false" to hide controls.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" controls="false"]`
When you disable controls, users will not be able to interact with your videos. So it is recommended that you enable autoplay for a video with no controls.

* **preload**: Specify how the video should be loaded when the page loads (Default: "auto"). Options include "metadata," "none," and "auto."
  - "metadata" - Load only the metadata of the video, which includes information like the duration and dimensions of the video. Sometimes, the metadata will be loaded by downloading a few frames of video.
  - "none" - Don't preload any data. The browser will wait until the user hits "play" to begin downloading.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" preload="metadata"]`

* **autoplay**: Cause the video to play automatically when the page loads.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" autoplay="true"]`

* **loop**: Set the video to automatically loop back to the beginning and continue playing after it finishes.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" loop="true"]`

* **poster**: Define an image as a placeholder before the video plays.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" poster="http://example.com/wp-content/uploads/poster.jpg"]`

* **muted**: Specify that the audio output of the video should be muted.
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" muted="true"]`

* **captions**: Add captions or subtitles to the video in multiple languages. Provide the captions in the format: `"path/to/captions1.vtt|lang1|label1|default,path/to/captions2.vtt|lang2|label2"`.
provide the lang in two character language code format. For example de-de, en-us
`[hls_player url="https://example.com/external/xxxxxxxxx.m3u8" captions="path/to/captions-en.vtt|en-EN|English,path/to/captions-es.vtt|en-us|English|default"]`

== Get more advanced features with HLS Player PRO ==

AWS CloudFront Integration:
=> Global low-latency content delivery network support.
=> Secure videos with CloudFront Signed Cookies against unauthorized downloads.
=> Easy setup with step-by-step instructions for configuring CloudFront and signed cookies.

Subscription Management:
=> Seamlessly integrate aMember and Wordpress roles for membership subscription management.
=> Restrict video access to active subscribers only.

Analytics Integration:
=> Google Tag Manager and Google Analytics support.
=> Track comprehensive video statistics, including playback duration and timing.

Streaming Optimization:
=> Convert .mp4 videos into .m3u8 streaming format effortlessly on Windows or macOS.
=> Converting and AWS S3 Upload script for Windows and macOS is also included.
=> Detailed step-by-step configuration and converting guides included.

[Check out HLS Player PRO >](https://hls-player-pro.root-sector.com/)

== Installation ==

1. Navigate to the `Add New` plugins screen in your WordPress Dashboard.
2. Click the `Upload` tab.
3. Browse for the plugin file (hls-player.zip) on your computer.
4. Click `Install Now` and then activate the plugin.

== Changelog ==
= 1.0.6 =
* Improved: Compatibility for multiple themes and plugins.

= 1.0.5 =
* Added: Support for multiple video players on one post/page.

= 1.0.4 =
* Added: Wordpress v6.5.4 compatibility.

= 1.0.3 =
* Improved: Minor changes.

= 1.0.2 =
* Improved: Minor changes.

= 1.0.2 =
* Changed: Updated dependencies to newer versions for improved performance and security.
* Changed: Refactoring the hls_player_shortcode function to pass data to the JavaScript code.
* Changed: Moving the JavaScript code to a separate file for better organization.

= 1.0.1 =
* Added: vjs-fluid class as default to adjust player size automatically.
* Improved: Removed CDN for video.js css and js file
* Improved: Prevent direct module access.

= 1.0.0 =
* Released: Initial version of the software.
