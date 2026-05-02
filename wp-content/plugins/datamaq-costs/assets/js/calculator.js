/**
 * Datamaq Costs - Frontend Calculator Logic (Clean & Observable version)
 */

(function($) {
    'use strict';

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
        const MAX_RETRIES = 50; // ~5 segundos

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
         * Inicialización de funcionalidades con protección de dependencias
         */
        function initCalculatorFeatures() {
            DMLog.info('Inicializando funcionalidades de la calculadora...');

            // Protección contra carga asíncrona de Google Maps
            if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
                DMLog.warn('Google Maps no está disponible aún. Reintentando en 500ms...');
                setTimeout(initCalculatorFeatures, 500);
                return;
            }

            const $addressInput = $('#dm-address-input');
            const $resultsContainer = $('#dm-calculator-results');
            const $loader = $('#dm-calculator-loader');
            const $priceValue = $('#dm-result-price');
            const $distanceValue = $('#dm-result-distance');
            const $addToCartBtn = $('#dm-add-to-cart-trigger');

            if (!$addressInput.length) {
                DMLog.error('No se encontró el input de dirección tras la teletransportación.');
                return;
            }

            DMLog.info('Google Maps detectado. Configurando Autocomplete...');

            const autocomplete = new google.maps.places.Autocomplete($addressInput[0], {
                types: ['address'],
                componentRestrictions: { country: 'ar' },
                fields: ['formatted_address', 'geometry']
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (place.geometry) {
                    DMLog.info('Dirección seleccionada:', place.formatted_address);
                    calculate(place.formatted_address);
                } else {
                    DMLog.warn('La dirección seleccionada no tiene geometría válida.');
                }
            });

            function calculate(address) {
                $resultsContainer.hide();
                $loader.show();
                $addToCartBtn.prop('disabled', true);

                DMLog.info('Solicitando cálculo al servidor para:', address);

                $.post(datamaq_costs.ajax_url, {
                    action: 'datamaq_calculate_costs',
                    address: address,
                    _ajax_nonce: datamaq_costs.nonce
                }, function(response) {
                    $loader.hide();
                    if (response.success) {
                        DMLog.info('Cálculo recibido exitosamente:', response.data);
                        $distanceValue.text(response.data.distance);
                        $priceValue.text('$' + response.data.price);
                        $resultsContainer.fadeIn();
                        $addToCartBtn.prop('disabled', false)
                                     .data('price', response.data.price)
                                     .data('address', address);
                    } else {
                        DMLog.error('Error en el cálculo del servidor:', response.data);
                        alert('Error: ' + response.data);
                    }
                });
            }

            $addToCartBtn.on('click', function() {
                DMLog.info('Procesando reserva para:', $(this).data('address'));
                
                const data = {
                    action: 'datamaq_add_to_cart',
                    product_id: datamaq_costs.product_id,
                    custom_price: $(this).data('price'),
                    custom_address: $(this).data('address'),
                    _ajax_nonce: datamaq_costs.nonce
                };

                $addToCartBtn.text('Procesando...').prop('disabled', true);
                $.post(datamaq_costs.ajax_url, data, function(response) {
                    if (response.success) {
                        DMLog.info('Producto añadido al carrito con precio dinámico.');
                        window.location.href = '/cart/';
                    } else {
                        DMLog.error('Fallo al añadir al carrito:', response.data);
                        alert(response.data);
                        $addToCartBtn.text('Reservar Relevamiento Técnico').prop('disabled', false);
                    }
                });
            });
        }
    });

})(jQuery);
