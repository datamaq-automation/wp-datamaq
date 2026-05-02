<?php
namespace Datamaq\Costs\Infrastructure\UI\WooCommerce;

class CartHandler {
    
    public function init(): void {
        // Sobrescribir precio en el carrito
        add_action('woocommerce_before_calculate_totals', [$this, 'apply_custom_price'], 10, 1);
        
        // Mostrar dirección en el carrito
        add_filter('woocommerce_get_item_data', [$this, 'display_address_in_cart'], 10, 2);
        
        // Guardar dirección en el pedido
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'add_address_to_order_items'], 10, 4);

        // Capturar datos del formulario estándar
        add_filter('woocommerce_add_cart_item_data', [$this, 'capture_calculator_data'], 10, 2);
    }

    public function capture_calculator_data($cartItemData, $productId): array {
        if ($productId !== 251) return $cartItemData;

        $token = isset($_POST['dm_calculation_token']) ? sanitize_text_field($_POST['dm_calculation_token']) : '';

        if (!empty($token)) {
            // Soporte para MODO DEBUG
            if ($token === 'calc_debug_token') {
                $cartItemData['dm_custom_price'] = 99.99;
                $cartItemData['dm_custom_address'] = 'Obelisco, CABA (Simulado)';
                $cartItemData['dm_calculation_token'] = $token;
                return $cartItemData;
            }

            $data = get_transient('dm_calc_' . $token);
            
            if ($data) {
                $cartItemData['dm_custom_price'] = $data['price'];
                $cartItemData['dm_custom_address'] = $data['address'];
                $cartItemData['dm_calculation_token'] = $token;
                
                // Limpiar el transient para que no se use dos veces (opcional, pero más seguro)
                // delete_transient('dm_calc_' . $token);
            }
        }

        return $cartItemData;
    }

    public function apply_custom_price($cart): void {
        if (is_admin() && !defined('DOING_AJAX')) return;

        foreach ($cart->get_cart() as $cartItem) {
            if (isset($cartItem['dm_custom_price'])) {
                $cartItem['data']->set_price($cartItem['dm_custom_price']);
            }
        }
    }

    public function display_address_in_cart($itemData, $cartItem): array {
        if (isset($cartItem['dm_custom_address'])) {
            $itemData[] = [
                'key'   => 'Planta a relevar',
                'value' => $cartItem['dm_custom_address']
            ];
        }
        
        return $itemData;
    }

    public function add_address_to_order_items($item, $cartItemKey, $values, $order): void {
        if (isset($values['dm_custom_address'])) {
            $item->add_meta_data('Planta a relevar', $values['dm_custom_address']);
        }
    }
}
