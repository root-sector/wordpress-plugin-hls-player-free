(function ($) {
  "use strict";

  const onReady = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  };

  onReady(() => {
    $("video.video-js").each(function () {
      var videoId = $(this).attr("id");
      var localizedName = "hlsPlayerData_" + videoId;

      if (typeof window[localizedName] !== "undefined") {
        // Decode base64-encoded data
        let playerData = JSON.parse(atob(window[localizedName]));

        let player = videojs(playerData.video_id);
        player.src({
          src: playerData.src,
          type: playerData.type,
        });

        playerData.captions_data.forEach((caption) => {
          player.addRemoteTextTrack(
            {
              kind: "subtitles",
              src: caption.src,
              srclang: caption.srclang,
              label: caption.label,
              default: caption.default,
            },
            false
          );
        });

        player.load();
      } else {
        console.log("No localized data found for " + localizedName);
      }
    });
  });
})(jQuery);
