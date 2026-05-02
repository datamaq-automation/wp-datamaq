/**
 * Datamaq Costs - Frontend Calculator Logic
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        const $addressInput = $('#dm-address-input');
        const $resultsContainer = $('#dm-calculator-results');
        const $loader = $('#dm-calculator-loader');
        const $priceValue = $('#dm-result-price');
        const $distanceValue = $('#dm-result-distance');
        const $addToCartBtn = $('#dm-add-to-cart-trigger');

        if (!$addressInput.length) return;

        // Inicializar Google Autocomplete
        const autocomplete = new google.maps.places.Autocomplete($addressInput[0], {
            types: ['address'],
            componentRestrictions: { country: 'ar' }, // Restringido a Argentina
            fields: ['address_components', 'geometry', 'formatted_address']
        });

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            
            if (!place.geometry) {
                window.alert("Por favor, selecciona una dirección sugerida de la lista.");
                return;
            }

            calculateCosts(place.formatted_address);
        });

        function calculateCosts(address) {
            $resultsContainer.hide();
            $loader.show();
            $addToCartBtn.prop('disabled', true);

            $.ajax({
                url: datamaq_costs.ajax_url,
                type: 'POST',
                data: {
                    action: 'datamaq_calculate_costs',
                    address: address,
                    _ajax_nonce: datamaq_costs.nonce
                },
                success: function(response) {
                    $loader.hide();
                    
                    if (response.success && response.data.distance) {
                        $distanceValue.text(response.data.distance);
                        $priceValue.text('$' + response.data.price);
                        
                        $resultsContainer.fadeIn();
                        $addToCartBtn.prop('disabled', false);

                        // Guardar datos en el botón para el carrito
                        $addToCartBtn.data('address', address);
                        $addToCartBtn.data('price', response.data.price);
                    } else {
                        alert('Error al calcular: ' + (response.data || 'Error desconocido'));
                    }
                },
                error: function() {
                    $loader.hide();
                    alert('Error técnico al conectar con el servidor.');
                }
            });
        }

        // Lógica de "Añadir al carrito" personalizada
        $addToCartBtn.on('click', function() {
            const price = $(this).data('price');
            const address = $(this).data('address');

            // Aquí dispararemos el proceso de añadir al carrito de WooCommerce
            // con los metadatos de precio y dirección.
            addToCart(price, address);
        });

        function addToCart(price, address) {
            $addToCartBtn.text('Procesando...').prop('disabled', true);

            $.ajax({
                url: datamaq_costs.ajax_url,
                type: 'POST',
                data: {
                    action: 'datamaq_add_to_cart',
                    product_id: datamaq_costs.product_id,
                    custom_price: price,
                    custom_address: address,
                    _ajax_nonce: datamaq_costs.nonce
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/cart/';
                    } else {
                        alert('No se pudo añadir al carrito: ' + response.data);
                        $addToCartBtn.text('Reservar Relevamiento Técnico').prop('disabled', false);
                    }
                }
            });
        }
    });

})(jQuery);
