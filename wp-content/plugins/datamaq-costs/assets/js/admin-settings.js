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
                    feedback.html('<span class="msg">' + response.data.message + '</span>').addClass('success');
                } else {
                    let msg = '<span class="msg">' + response.data.message + '</span>';
                    
                    if (response.data.suggestion) {
                        msg += '<div class="suggestion"><strong>Sugerencia:</strong> ' + response.data.suggestion + '</div>';
                    }
                    
                    if (response.data.link) {
                        msg += '<a href="' + response.data.link + '" target="_blank" class="suggestion-link">Ir a la Consola de Google Cloud &rarr;</a>';
                    }

                    if (response.data.technical_details) {
                        msg += '<br><code class="technical">' + response.data.technical_details + '</code>';
                    }
                    feedback.html(msg).addClass('error');
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
