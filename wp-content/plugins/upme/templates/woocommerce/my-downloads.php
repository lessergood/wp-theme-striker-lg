<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $upme_woo_myaccount_data;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$downloads = wc_get_customer_available_downloads( $upme_woo_myaccount_data['current_user']->ID );
$downloads = apply_filters( 'woocommerce_customer_get_downloadable_products', $downloads );

if ( $downloads  ) : ?>

	<?php do_action( 'woocommerce_before_available_downloads' ); ?>

	<h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available Downloads', 'woocommerce' ) ); ?></h2>

	<ul class="upme-woo-downloads digital-downloads">
		<?php foreach ( $downloads as $download ) : ?>
			<li>
				<?php
					do_action( 'woocommerce_available_download_start', $download );

					if ( is_numeric( $download['downloads_remaining'] ) )
						echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );

					echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );

					do_action( 'woocommerce_available_download_end', $download );
				?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php endif; ?>
