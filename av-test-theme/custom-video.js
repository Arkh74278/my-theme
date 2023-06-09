document.addEventListener('DOMContentLoaded', function() {
    var videoThumbnail = document.querySelector('.video-thumbnail');
    var videoPlayer = document.querySelector('#product-video-player');

    if (videoThumbnail && videoPlayer) {
        videoThumbnail.addEventListener('click', function(event) {
            event.preventDefault();
            
            // hide all images
            var images = document.querySelectorAll('.woocommerce-product-gallery__image');
            for (var i = 0; i < images.length; i++) {
                if (!images[i].classList.contains('video-thumbnail')) {
                    images[i].style.display = 'none';
                }
            }

            // show and play the video
            videoPlayer.style.display = 'block';
            videoPlayer.play();
        });
    }
});
