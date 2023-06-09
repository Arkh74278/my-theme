jQuery(document).ready(function($) {
    var file_frame;

    $(document).on('click', '#av-video-upload-btn', function(e) {
        e.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload a video',
            button: {
                text: 'Use this video'
            },
            library: {
                type: 'video'
            },
            multiple: false
        });

        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#av-video-url').val(attachment.url);
        });

        file_frame.open();
    });
});
