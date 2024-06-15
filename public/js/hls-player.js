(function ($) {
  "use strict";

  const onReady = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  };

  onReady(() => {
    hlsPlayerData.forEach((playerData) => {
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
    });
  });
})(jQuery);
