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
    }

    public function apply_custom_price($cart): void {
        if (is_admin() && !defined('DOING_AJAX')) return;

        $customPrice = WC()->session->get('datamaq_custom_price');

        if (!$customPrice) return;

        foreach ($cart->get_cart() as $cartItem) {
            if ($cartItem['product_id'] === 251) {
                $cartItem['data']->set_price($customPrice);
            }
        }
    }

    public function display_address_in_cart($itemData, $cartItem): array {
        $address = WC()->session->get('datamaq_custom_address');
        
        if ($cartItem['product_id'] === 251 && $address) {
            $itemData[] = [
                'key'   => 'Planta a relevar',
                'value' => $address
            ];
        }
        
        return $itemData;
    }

    public function add_address_to_order_items($item, $cartItemKey, $values, $order): void {
        $address = WC()->session->get('datamaq_custom_address');
        
        if ($values['product_id'] === 251 && $address) {
            $item->add_meta_data('Planta a relevar', $address);
        }
    }
}
