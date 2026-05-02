/**
 * Datamaq Costs Admin Logic
 */
jQuery(document).ready(function($) {
    
    // 0. Toggle Edit Mode
    $('#datamaq-edit-mode').on('change', function() {
        const isChecked = $(this).is(':checked');
        const form = $('.datamaq-settings-form');
        
        if (isChecked) {
            form.removeClass('is-read-only');
        } else {
            form.addClass('is-read-only');
        }
    });

    // 1. Toggle API Key Visibility
    $('.toggle-visibility').on('click', function() {
        const input = $('#datamaq_costs_google_api_key');
        const icon = $(this).find('.dashicons');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('dashicons-visibility').addClass('dashicons-hidden');
        } else {
            input.attr('type', 'password');
            icon.removeClass('dashicons-hidden').addClass('dashicons-visibility');
        }
    });

    // 2. Test Google API Key
    $('#test-google-key').on('click', function(e) {
        e.preventDefault();
        
        const $btn = $(this);
        const $container = $('.api-key-container');
        const apiKey = $('#datamaq_costs_google_api_key').val();
        const address = $('#datamaq_costs_origin_address').val();
        const $result = $('#test-result-container');

        if (!apiKey) {
            alert('Por favor, ingresa una API Key primero.');
            return;
        }

        // Loading state
        $container.addClass('is-loading');
        $result.fadeOut(200, function() { $(this).empty(); });

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
                let html = '';
                const type = response.success ? 'success' : 'error';
                const icon = response.success ? 'yes' : 'no';
                const message = response.data.message || 'Error desconocido';

                html += `<div class="datamaq-feedback ${type}">`;
                html += `<span class="dashicons dashicons-${icon}"></span> <strong>${message}</strong>`;
                
                if (!response.success) {
                    if (response.data.suggestion) {
                        html += `<div class="suggestion-box">`;
                        html += `<strong>Solución sugerida:</strong> ${response.data.suggestion}`;
                        if (response.data.link) {
                            html += `<br><a href="${response.data.link}" target="_blank" class="suggestion-link">Abrir Consola de Google Cloud</a>`;
                        }
                        html += `</div>`;
                    }
                    
                    if (response.data.technical_details) {
                        html += `<code class="technical-box">Error técnico: ${response.data.technical_details}</code>`;
                    }
                }
                
                html += `</div>`;
                $result.html(html).fadeIn();
            },
            error: function() {
                $result.html('<div class="datamaq-feedback error"><span class="dashicons dashicons-no"></span> Error de comunicación con el servidor.</div>').fadeIn();
            },
            complete: function() {
                $container.removeClass('is-loading');
            }
        });
    });
});
