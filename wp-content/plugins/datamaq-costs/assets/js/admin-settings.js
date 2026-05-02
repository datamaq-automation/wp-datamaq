jQuery(document).ready(function($) {
    $('#datamaq-test-google-key').on('click', function(e) {
        e.preventDefault();
        
        const btn = $(this);
        const apiKey = $('input[name="datamaq_costs_google_api_key"]').val();
        const address = $('input[name="datamaq_costs_origin_address"]').val();
        const feedback = $('#datamaq-google-key-feedback');

        if (!apiKey) {
            alert('Por favor, ingresa una API Key primero.');
            return;
        }

        btn.prop('disabled', true).text('Probando...');
        feedback.text('').removeClass('success error');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'datamaq_test_google_key',
                security: datamaq_costs_params.nonce,
                api_key: apiKey,
                address: address
            },
            success: function(response) {
                if (response.success) {
                    feedback.text(response.data.message).addClass('success');
                } else {
                    feedback.text(response.data.message).addClass('error');
                }
            },
            error: function() {
                feedback.text('Error de comunicación con el servidor.').addClass('error');
            },
            complete: function() {
                btn.prop('disabled', false).text('Probar API Key');
            }
        });
    });
});
