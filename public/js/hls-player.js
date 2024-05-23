(function ($) {
  "use strict";

  const onReady = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  };

  onReady(() => {
    let player = videojs(hlsPlayerData.video_id);
    player.src({
      src: hlsPlayerData.src,
      type: hlsPlayerData.type,
    });

    hlsPlayerData.captions_data.forEach((caption) => {
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
})(jQuery);
