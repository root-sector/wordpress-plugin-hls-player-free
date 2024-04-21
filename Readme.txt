=== HLS Player ===
Contributors: r00tsector
Tags: video player, hls, streaming, video.js, video embedding, hls video, m3u8, mpd
Donate link: https://donate.stripe.com/5kA7w2bRl3KN7qU3cd
Requires at least: 6.4
Tested up to: 6.5.2
Requires PHP: 8.1
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0

Wordpress HLS Player is a video player plugin designed to seamlessly embed responsive/fluid or fixed-width HTTP Live Streaming (HLS) videos into WordPress posts and pages using the powerful Video.js player from videojs.com. Whether you\'re embedding locally hosted or externally hosted .m3u8 or .mpd HLS video files, this plugin makes the process effortless.

== Description ==

HLS Player Video Plugin, the ultimate solution for embedding HLS video content. Utilizing the robust Video.js player, this plugin offers a seamless integration of HLS videos, ensuring a top-notch viewing experience for your audience.

Key Features:

**Easy Embedding**: Place HLS video packages into posts, pages, or anywhere on your site.
**Mobile Responsive**: Enjoy a flawless user experience on mobile devices with responsive video design.
**Browser Compatibility**: Full HTML5 support for compatibility with all major web browsers.
**Video Posters**: Enhance your videos with attractive poster images.
**Automatic Playback**: Videos start playing automatically as the page loads.
**Fallback Support**: Use direct links to embed fallback videos from your WordPress media library.
**No Setup Hassle**: Install the plugin and start embedding without any complex setup.
**Lightweight Design**: A lightweight plugin that won’t slow down your site.
**Sleek Player**: A clean and modern player interface with no watermark.
**HTML5 Fallback**: Supports other HTML5 file types like MP4, WebM, and Ogv for maximum flexibility.

The WordPress HLS Player Plugin is designed for versatility, allowing you to embed both locally and externally hosted .m3u8 or .mpd HLS video files with ease. Whether you’re aiming for a responsive layout or a fixed-width display, this plugin adapts to your needs, making the embedding process as effortless as possible.

Experience the power of professional-grade video streaming on your WordPress site with the WordPress HLS Player Plugin.

= HLS Player Plugin Usage =

To embed a video, create a new post/page and use the following shortcode:

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8"]`

Specify the "url" parameter with the location of the HLS video package file. Supported formats include .m3u8 (application/x-mpegURL), .mpd (application/dash+xml), and .mp4 (video/mp4).

= Video Shortcode Options =

The shortcode supports the following options:

**class**: Define the Video.js player's CSS class (Default: video-js). Additional classes listed at https://videojs.com/guides/layout/#classes

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" class="video-js vjs-fluid vjs-16-9"]`

**width**: Defines the width of the video file.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" width="480"]`

**height**: Defines the height of the video file.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" height="264"]`

**controls**: Specify whether video controls should be displayed (Default: "true"). Use "false" to hide controls.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" controls="false"]`

When you disable controls users will not be able to interact with your videos. So It is recommended that you enable autoplay for a video with no controls.

**Preload**: Specify how the video should be loaded when the page loads (Default: "auto"). Options include "metadata," "none," and "auto."

* "metadata" - Load only the meta data of the video, which includes information like the duration and dimensions of the video. Sometimes, the meta data will be loaded by downloading a few frames of video.
* "none" - Don't preload any data. The browser will wait until the user hits "play" to begin downloading.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" preload="metadata"]`

**Autoplay**: Cause the video to play automatically when the page loads.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" autoplay="true"]`

**Loop**: Make the video loop to the beginning when finished and automatically continue playing.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" loop="true"]`

**Poster**: Define an image as a placeholder before the video plays.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" poster="http://example.com/wp-content/uploads/poster.jpg"]`

**Muted**: Specify that the audio output of the video should be muted.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" muted="true"]`

**Withcredentials**: Disable withCredentials for a single video. The value for this parameter is true by default.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" withcredentials="false"]`

**Protected**: Disable check active subscription protection for this single video. The value for this parameter is true by default.

`[hls_player url="https://player.vimeo.com/external/xxxxxxxxx.m3u8" protected="false"]`

== Get more advanced features with HLS Player PRO ==

+ AWS Cloudfront signed cookies support: Secure your videos from unauthorized downloads.
+ Step-by-step instructions for AWS Cloudfront setup: Easily configure signed cookies for added security.
+ aMember and Wordpress user role support: Integrate with aMember and Wordpress for a membership subscription check. Restrict video access only for active subscribers.
+ Google Tag Manager / Google Analytics support: Track video statistics - know what, when, and how long your videos are being played.
+ BONUS: Step-by-step instructions on converting videos into .m3u8 streaming using Mac OS.
* [Check out HLS Player PRO >](https://hls-player-pro.root-sector.com/)

== Installation ==
1. Navigate to the `Add New` plugins screen in your WordPress Dashboard.
2. Click the `Upload` tab.
3. Browse for the plugin file (hls-player.zip) on your computer.
4. Click `Install Now` and then activate the plugin.

== Changelog ==
= 1.0.0 =
* Initial release
