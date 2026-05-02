/**
 * Datamaq Costs - Frontend Calculator Logic (Clean & Observable version)
 */

(function($) {
    'use strict';

    console.log('%c[DataMaq] SCRIPT CARGADO CORRECTAMENTE (V1.0.3)', 'background: #000; color: #0f0; font-size: 14px; padding: 5px;');

    const DM_DEBUG = true;

    /**
     * Logger estructurado para observabilidad técnica
     */
    const DMLog = {
        info: (msg, data = '') => DM_DEBUG && console.log(`%c[DataMaq Info]: ${msg}`, 'color: #2563eb; font-weight: bold;', data),
        error: (msg, data = '') => console.error(`%c[DataMaq Error]: ${msg}`, 'color: #dc2626; font-weight: bold;', data),
        warn: (msg, data = '') => console.warn(`%c[DataMaq Warn]: ${msg}`, 'color: #d97706; font-weight: bold;', data)
    };

    $(document).ready(function() {
        let isTeleported = false;
        let retryCount = 0;
        const MAX_RETRIES = 50; 

        /**
         * Lógica de Teletransportación con reintentos para entornos dinámicos (Vue/React)
         */
        function teleportCalculator() {
            if (isTeleported) return;

            const $transport = $('#dm-calculator-transport');
            if (!$transport.length) return;

            const target = document.evaluate(
                "//text()[contains(., '[datamaq_presupuesto_relevamiento]')]",
                document.body,
                null,
                XPathResult.FIRST_ORDERED_NODE_TYPE,
                null
            ).singleNodeValue;
            
            if (target && target.parentElement) {
                DMLog.info('Shortcode detectado en el DOM. Iniciando teletransportación...');
                isTeleported = true;
                const $parent = $(target.parentElement);
                const html = $parent.html().replace('[datamaq_presupuesto_relevamiento]', $transport.html());
                $parent.html(html);
                $transport.remove();
                
                initCalculatorFeatures();
            } else if (retryCount < MAX_RETRIES) {
                retryCount++;
            }
        }

        const observer = new MutationObserver(() => teleportCalculator());
        observer.observe(document.body, { childList: true, subtree: true });
        teleportCalculator();

        /**
         * Lógica de Debug y Guía (Global para resistir re-renders)
         */
        $(document).on('click', '#dm-debug-trigger', function(e) {
            e.preventDefault();
            const dummyDistance = 15;
            console.log('%c[DataMaq Debug] Botón pulsado!', 'color: orange; font-weight: bold;');
            DMLog.info('VALOR DE DISTANCIA (DEBUG):', dummyDistance + ' km');
            
            const $addressInput = $('#dm-address-input');
            const $distanceValue = $('#dm-result-distance');
            const $priceValue = $('#dm-result-price');
            const $resultsContainer = $('#dm-calculator-results');
            const $addToCartBtn = $('.single_add_to_cart_button');

            $addressInput.val('Obelisco, CABA (Simulado)');
            $distanceValue.text(dummyDistance + ' km');
            $priceValue.text('$99.99'); 
            $resultsContainer.fadeIn();
            
            updateHiddenFields('99.99', 'Obelisco, CABA (Simulado)');
            
            $addToCartBtn.prop('disabled', false).css('opacity', '1');
            $('#dm-calculator-guide').fadeOut();

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $addToCartBtn.offset().top - 150
                }, 800);
            }, 300);
        });

        function updateHiddenFields(price, address) {
            const $form = $('.single_add_to_cart_button').closest('form.cart');
            if (!$form.length) return;
            
            [['dm_calculated_price', price], ['dm_calculated_address', address]].forEach(([name, value]) => {
                let $field = $form.find(`input[name="${name}"]`);
                if (!$field.length) {
                    $field = $('<input>').attr({ type: 'hidden', name: name });
                    $form.append($field);
                }
                $field.val(value);
            });
        }

        /**
         * Inicialización de funcionalidades reales
         */
        function initCalculatorFeatures() {
            DMLog.info('Inicializando funcionalidades de la calculadora...');

            if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
                DMLog.warn('Google Maps no disponible aún. Reintentando...');
                setTimeout(initCalculatorFeatures, 500);
                return;
            }

            const $addressInput = $('#dm-address-input');
            const $resultsContainer = $('#dm-calculator-results');
            const $loader = $('#dm-calculator-loader');
            const $priceValue = $('#dm-result-price');
            const $distanceValue = $('#dm-result-distance');
            const $addToCartBtn = $('.single_add_to_cart_button');

            if (!$addressInput.length) return;

            $addToCartBtn.prop('disabled', true).css('opacity', '0.5');

            const autocomplete = new google.maps.places.Autocomplete($addressInput[0], {
                types: ['address'],
                componentRestrictions: { country: 'ar' },
                fields: ['formatted_address', 'geometry']
            });

            $addressInput.on('input', function() {
                $addToCartBtn.prop('disabled', true).css('opacity', '0.5');
                $resultsContainer.hide();
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (place.geometry) {
                    calculate(place.formatted_address);
                }
            });

            function calculate(address) {
                $resultsContainer.hide();
                $loader.show();
                $addToCartBtn.prop('disabled', true).css('opacity', '0.5');

                $.post(datamaq_costs.ajax_url, {
                    action: 'datamaq_calculate_costs',
                    address: address,
                    _ajax_nonce: datamaq_costs.nonce
                }, function(response) {
                    $loader.hide();
                    if (response.success) {
                        DMLog.info('DISTANCIA TÉCNICA DETECTADA:', response.data.distance + ' km');
                        $distanceValue.text(response.data.distance);
                        $priceValue.text('$' + response.data.price);
                        $resultsContainer.fadeIn();
                        
                        $('#dm-calculator-guide').fadeOut();
                        $addToCartBtn.prop('disabled', false).css('opacity', '1');
                        
                        updateHiddenFields(response.data.price, address);

                        setTimeout(() => {
                            $('html, body').animate({
                                scrollTop: $addToCartBtn.offset().top - 150
                            }, 800);
                        }, 500);
                    }
                });
            }
        }
    });

})(jQuery);
