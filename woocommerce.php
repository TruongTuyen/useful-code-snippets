<?php
/** UPDATE MINICART VIA AJAX **/
//JS code
/**
$.post(
    woocommerce_params.ajax_url,
    {'action': 'mode_theme_update_mini_cart'},
    function(response) {
		$('#mode-mini-cart').html(response);
    }
);
**/
//PHP

function mode_theme_update_mini_cart() {
    echo wc_get_template( 'cart/mini-cart.php' );
    die();
}
add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
/**======= END =======**/