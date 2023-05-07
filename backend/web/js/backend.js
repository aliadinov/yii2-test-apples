let Backend = {
    alertMessage: function (message) {
        jQuery('.alert-message span').text(message);
        jQuery(".alert-message").fadeIn("slow", function(){
            setTimeout(function(){
                jQuery(".alert-message").fadeOut("slow");
            },4000);
        });
    }
}

jQuery(document).on('submit', 'form.ajax-form', function() {
    let form = jQuery(this);
    form.find('button[type=submit], input[type=submit]').prop('disabled',true);
    jQuery.post(form.attr('action'),
        jQuery(this).serialize(),
        function(data) {
            form.find('button[type=submit], input[type=submit]').prop('disabled',false);
            if (data.success) {
                jQuery(data.html['cssClass']).replaceWith(data.html['layout']);
                Backend.alertMessage(data.message)
            } else {
                Backend.alertMessage(data.message)
            }
        },
        'json');
    return false;
});

jQuery(document).on('click', '#apples-generate-button', function(e) {
    jQuery.post('/apples/regenerate-random-apples', {}, function (data) {
        jQuery(data.html['cssClass']).replaceWith(data.html['layout']);
        Backend.alertMessage(data.message)
    }, 'json');
    return false;
});
