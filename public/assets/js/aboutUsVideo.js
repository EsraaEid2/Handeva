// Initiate the video and stop it at 26 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById("customVideo");

        // Event listener to stop the video at 26 seconds
        video.onloadedmetadata = function () {
            const maxTime = 26; // 26 seconds
            video.addEventListener("timeupdate", function () {
                if (video.currentTime >= maxTime) {
                    video.pause();
                    video.currentTime = 0; // Reset to the beginning
                    video.play(); // Replay the video automatically
                }
            });
        };
    });
