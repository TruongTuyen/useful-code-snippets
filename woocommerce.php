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


//OR
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

/**======= END =======**/

/** Adding Items to the Sort **/
function patricks_woocommerce_catalog_orderby( $orderby ) {
	// Add "Sort by date: oldest to newest" to the menu
	// We still need to add the functionality that actually does the sorting
	$orderby['oldest_to_recent'] = __( 'Sort by date: oldest to newest', 'woocommerce' );

	// Change the default "Sort by newness" to "Sort by date: newest to oldest"
	$orderby["date"] = __('Sort by date: newest to oldest', 'woocommerce');

	// Remove price & price-desc
	unset($orderby["price"]);
	unset($orderby["price-desc"]);

	return $orderby;
}
add_filter( 'woocommerce_catalog_orderby', 'patricks_woocommerce_catalog_orderby', 20 );

// Add the ability to sort by oldest to newest
function patricks_woocommerce_get_catalog_ordering_args( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	if ( 'oldest_to_recent' == $orderby_value ) {
		$args['orderby'] = 'date';
		$args['order']   = 'ASC';
	}

	return $args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'patricks_woocommerce_get_catalog_ordering_args', 20 );
/**======= END =======**/


/** Display related products **/
woocommerce_related_products(4,2); // Display 4 products in rows of 2
/**======= END =======**/

/** Woocommerce Products Per Page Selector **/
// Products per page
function woocommerce_catalog_page_ordering()
{ ?>
    <form action="/shop" method="POST" name="results">
        <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
            <?php   
                $shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
                    ''  => __('Results per page', 'woocommerce'),
                    '2' => __('2 per page', 'woocommerce'),
                    '4' => __('4 per page', 'woocommerce'),
                    '6' => __('6 per page', 'woocommerce'),
                    '8' => __('8 per page', 'woocommerce'),
                ));
    
                foreach ($shopCatalog_orderby as $sort_id => $sort_name) {
                    $is_selected = (isset($_POST['woocommerce-sort-by-columns']) && (int) $_POST['woocommerce-sort-by-columns'] === (int) $sort_id) ? 'selected' : ((isset($_COOKIE['shop_pageResults']) && (int) $_COOKIE['shop_pageResults'] === (int) $sort_id) ? 'selected' : '');
                    echo '<option value="' . $sort_id . '" ' . selected( $_SESSION['sortby'], $sort_id, false ) . ' '.$is_selected.'>' . $sort_name . '</option>';
                }
            ?>
        </select>
    </form>
<?php } 

// Set Cookie
function dl_sort_by_page($count)
{
    if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
        $count = $_COOKIE['shop_pageResults'];
    }
    
    if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
        setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'keigan.dev', false); //this will fail if any part of page has been output- hope this works!
        $count = $_POST['woocommerce-sort-by-columns'];
    }
    
    // else normal page load and no cookie
    return $count;
}

add_filter('loop_shop_per_page','dl_sort_by_page');
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_page_ordering', 20);

/**======= END =======**/

/** Add a New Tab @ WooCommerce My Account Page **/
/**
 * @snippet       WooCommerce Add New Tab @ My Account
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21253
 * @credits       https://github.com/woothemes/woocommerce/wiki/2.6-Tabbed-My-Account-page
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.6.7
 */
 
 
// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error
 
function bbloomer_add_premium_support_endpoint() {
    add_rewrite_endpoint( 'premium-support', EP_ROOT | EP_PAGES );
}
 
add_action( 'init', 'bbloomer_add_premium_support_endpoint' );
 
 
// ------------------
// 2. Add new query var
 
function bbloomer_premium_support_query_vars( $vars ) {
    $vars[] = 'premium-support';
    return $vars;
}
 
add_filter( 'query_vars', 'bbloomer_premium_support_query_vars', 0 );
 
 
// ------------------
// 3. Insert the new endpoint into the My Account menu
 
function bbloomer_add_premium_support_link_my_account( $items ) {
    $items['premium-support'] = 'Premium Support';
    return $items;
}
 
add_filter( 'woocommerce_account_menu_items', 'bbloomer_add_premium_support_link_my_account' );
 
 
// ------------------
// 4. Add content to the new endpoint
 
function bbloomer_premium_support_content() {
echo '<h3>Premium WooCommerce Support</h3><p>Welcome to the WooCommerce support area. As a premium customer, you can submit a ticket should you have any WooCommerce issues with your website, snippets or customization. <i>Please contact your theme/plugin developer for theme/plugin-related support.</i></p>';
echo do_shortcode( ' /* your shortcode here */ ' );
}
 
add_action( 'woocommerce_account_premium-support_endpoint', 'bbloomer_premium_support_content' );
/**======= END =======**/

/** Add a custom search bar to your WooCommerce header/footer **/
/**
 * @snippet       WooCommerce Custom Search Bar
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21175
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.6.4
 */
 
 
// ----------------------------------
// 1. ADD SEARCH TO STOREFRONT FOOTER
 
add_action('storefront_footer','add_search_to_footer');
 
function add_search_to_footer() {
get_search_form();
}
 
 
// ----------------------------------
// 2. LIMIT SEARCH TO POSTS OR PRODUCTS ONLY
 
function SearchFilter($query) {
if ( !is_admin() && $query->is_search ) {
$query->set('post_type', 'post'); // OR USE 'PRODUCT'
}
return $query;
}
 
add_filter('pre_get_posts','SearchFilter');
 
 
// ----------------------------------
// 3. CHANGE PLACEHOLDER & BUTTON TEXT
 
function storefront_search_form_modify( $html ) {
    return str_replace( array('Search &hellip;','Search'), array('WooCommerce Hooks, Storefront Theme, Google AdWords...','Search Article'), $html );
}
 
add_filter( 'get_search_form', 'storefront_search_form_modify' );
 
 
// ------------------------------
// 4. ADD SEARCH ICON TO NAVIGATION MENU
 
function new_nav_menu_items($items) {
    $searchicon = '<li class="search"><a href="#colophon"><i class="fa fa-search" aria-hidden="true"></i></a></li>';
    $items = $items . $searchicon;
    return $items;
}
 
add_filter( 'wp_nav_menu_additional-resources_items', 'new_nav_menu_items' );
/**======= END =======**/


/** WooCommerce Holiday/Pause Mode **/
/**
 * @snippet       WooCommerce Holiday/Pause Mode
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=20862
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.6.4
 */
 
// Trigger Holiday Mode
 
add_action ('init', 'bbloomer_woocommerce_holiday_mode');
 
 
// Disable Cart, Checkout, Add Cart
 
function bbloomer_woocommerce_holiday_mode() {
 remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
 remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
 remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
 remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
 add_action( 'woocommerce_before_main_content', 'bbloomer_wc_shop_disabled', 5 );
 add_action( 'woocommerce_before_cart', 'bbloomer_wc_shop_disabled', 5 );
 add_action( 'woocommerce_before_checkout_form', 'bbloomer_wc_shop_disabled', 5 );
}
 
 
// Show Holiday Notice
 
function bbloomer_wc_shop_disabled() {
        wc_print_notice( 'Our Online Shop is Closed Today :)', 'error');
} 
/**======= END =======**/

/** Products types **/
if( $product->is_type( 'simple' ) ){
 // do something
} elseif( $product->is_type( 'variable' ) ){
 // do something
} elseif( $product->is_type( 'external' ) ){
 // do something
} elseif( $product->is_type( 'grouped' ) ){
 // do something
} 

if( $product->is_downloadable() ){
 // do something
} 

if ( $product->is_on_sale() ) {
 // do something
}

/**======= END =======**/