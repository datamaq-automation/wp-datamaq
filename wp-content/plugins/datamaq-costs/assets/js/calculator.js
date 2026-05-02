/**
 * Datamaq Costs - Frontend Calculator Logic (Vue-Friendly version)
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        let isTeleported = false;

        function teleportCalculator() {
            if (isTeleported) return;

            const $transport = $('#dm-calculator-transport');
            if (!$transport.length) return;

            // Buscamos el nodo que contiene el texto literal del shortcode
            // Usamos un selector que busque nodos de texto para mayor precisión
            const target = document.evaluate(
                "//text()[contains(., '[datamaq_presupuesto_relevamiento]')]",
                document.body,
                null,
                XPathResult.FIRST_ORDERED_NODE_TYPE,
                null
            ).singleNodeValue;
            
            if (target && target.parentElement) {
                isTeleported = true;
                const $parent = $(target.parentElement);
                const html = $parent.html().replace('[datamaq_presupuesto_relevamiento]', $transport.html());
                $parent.html(html);
                $transport.remove();
                
                initCalculatorFeatures();
            }
        }

        // Observador para cambios en el DOM (Vue rendering)
        const observer = new MutationObserver(() => teleportCalculator());
        observer.observe(document.body, { childList: true, subtree: true });
        
        // Intento inicial
        teleportCalculator();

        function initCalculatorFeatures() {
            const $addressInput = $('#dm-address-input');
            const $resultsContainer = $('#dm-calculator-results');
            const $loader = $('#dm-calculator-loader');
            const $priceValue = $('#dm-result-price');
            const $distanceValue = $('#dm-result-distance');
            const $addToCartBtn = $('#dm-add-to-cart-trigger');

            if (!$addressInput.length) return;

            // Google Autocomplete
            const autocomplete = new google.maps.places.Autocomplete($addressInput[0], {
                types: ['address'],
                componentRestrictions: { country: 'ar' },
                fields: ['formatted_address', 'geometry']
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
                $addToCartBtn.prop('disabled', true);

                $.post(datamaq_costs.ajax_url, {
                    action: 'datamaq_calculate_costs',
                    address: address,
                    _ajax_nonce: datamaq_costs.nonce
                }, function(response) {
                    $loader.hide();
                    if (response.success) {
                        $distanceValue.text(response.data.distance);
                        $priceValue.text('$' + response.data.price);
                        $resultsContainer.fadeIn();
                        $addToCartBtn.prop('disabled', false).data('price', response.data.price).data('address', address);
                    }
                });
            }

            $addToCartBtn.on('click', function() {
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
                        window.location.href = '/cart/';
                    } else {
                        alert(response.data);
                        $addToCartBtn.text('Reservar Relevamiento Técnico').prop('disabled', false);
                    }
                });
            });
        }
    });

})(jQuery);
