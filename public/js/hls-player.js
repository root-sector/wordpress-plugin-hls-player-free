(function () {
  "use strict";

  const onReady = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  };

  onReady(() => {
    const videos = document.querySelectorAll("video.video-js");

    videos.forEach((video) => {
      const videoId = video.getAttribute("id");
      const localizedName = "hlsPlayerData_" + videoId;

      if (typeof window[localizedName] !== "undefined") {
        // Decode base64-encoded data
        const playerData = JSON.parse(atob(window[localizedName]));

        // Parse the player custom options JSON and merge with default options
        const customOptions = JSON.parse(
          playerData.videojs_custom_options_json
        );
        const options = { ...customOptions };

        // Initialize the player with options
        const player = videojs(playerData.video_id, options);

        player.src({
          src: playerData.src,
          type: playerData.type,
        });

        // Track if a default caption exists
        let defaultCaptionExists = false;

        playerData.captions_data.forEach((caption) => {
          player.addRemoteTextTrack(
            {
              kind: "subtitles",
              src: caption.src,
              srclang: caption.srclang,
              label: caption.label,
              default: caption.default === 'true',
            },
            false
          );
          if (caption.default === 'true') {
            defaultCaptionExists = true;
          }
        });

        // If no default caption, disable captions by default
        if (!defaultCaptionExists) {
          const tracks = player.textTracks();
          for (let i = 0; i < tracks.length; i++) {
            tracks[i].mode = 'disabled';
          }
        }

        player.load();
      } else {
        console.log("No localized data found for " + localizedName);
      }
    });
  });
})();
