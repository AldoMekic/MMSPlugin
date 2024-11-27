jQuery(document).ready(function($) {
    $('#written-work-form').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            'action': 'submit_written_work',
            'title': $('#title').val(),
            'content': $('#content').val(),
            'categories': $('#categories input:checked').map(function() {
                return this.value; // Send category name
            }).get(),
            'tags': $('#tags input:checked').map(function() {
                return this.value; // Send tag name
            }).get(),
            'reading_time': $('#reading_time').val(),
            'myplugin_nonce': $('#written-work-form input[name="myplugin_nonce"]').val() // Include nonce
        };

        $.ajax({
            url: ajaxurl, // Use the localized 'ajaxurl' variable
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#form-message').html('<p>' + response.data + '</p>');
                    $('#written-work-form')[0].reset(); // Clear form on success
                } else {
                    $('#form-message').html('<p>' + response.data + '</p>');
                }
            },
            error: function() {
                $('#form-message').html('<p>An error occurred. Please try again.</p>');
            }
        });
    });
});