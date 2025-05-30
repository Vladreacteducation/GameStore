
        jQuery(document).ready(function($){
            function mediaUploader(buttonClass) {
                var mediaUploader;
               $(buttonClass).on('click', function(e){
                    e.preventDefault();
                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }
                    mediaUploader = wp.media.frames.file_frame=wp.media({
                        title: 'Choose Icon',
                        button: {
                            text: 'Use Icon'
                        },
                        multiple: false
                    });

                    mediaUploader.on('select', function(){
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                         $('.news-category-upload').val(attachment.url);
                    });
                    mediaUploader.open();
                });
            }
            mediaUploader($('.upload-icon-button'));
        });
