jQuery(document).ready(function($) {

    // Update the client name.
    $('#testimonial_name').keyup(function() {
        $('#testimonial_name-preview').text( $(this).val() );
    });

    // Update the business name.
    $('#company_name').keyup(function() {
        $('#client_url-preview').text( $(this).val() );
    });

    // Update the business URL.
    $('#client_url').keyup(function() {
        $('#client_url-preview').attr( 'href', $(this).val() );
    });

    // Update the testimonial text.
    $('#testimonial_text').keyup(function() {
        $('#testimonial_text-preview').html( $(this).val() );
    });

});