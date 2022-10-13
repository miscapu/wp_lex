<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>


<?php
echo 'Hello World<br>';

// Get 10 most recent order ids in date descending order.
//$query = new WC_Order_Query( array(
//	'limit' => 10,
//	'orderby' => 'date',
//	'order' => 'DESC',
//	'return' => 'ids',
//) );
//$orders = $query->get_orders();
//foreach ( $orders as $order):
//	var_dump($order);
//	endforeach;

global $wpdb;
$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type LIKE 'shop_order'");

?>




<?php


// Loop through each order post object
foreach( $results as $result ){
	$order_id = $result->ID; // The Order ID

	// Get an instance of the WC_Order Object
	$order    = wc_get_order( $result->ID );
	$items =	$order->get_items();
	?>
	<table>

	<?php foreach ( $items as $item ):?>

		<tr>
			<th scope="row"><?= $item->get_order_id();?></th>
			<td><?= $item->get_name();?></td>
			<td><?= $item->get_total();?></td>
			<td style="display:none!important;"><?= $total += $order->get_total();?></td>
		</tr>
	<?php endforeach;

	?>

	</table>
	<?php

}

echo $total;

/**
 * $sum = 0;
foreach($arrObj as $key=>$value){
if(isset($value->commission))
$sum += $value->commission;
}
echo $sum;
 */





/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>




<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
