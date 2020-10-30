<?php
/**
 * Displays the featured image
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
if ( has_post_thumbnail() && ! post_password_required() ) {

	$featured_media = '';
	$featured_media_inner_classes = '';
	if(is_front_page()){
		$featured_media  .= ' front-image';
		$featured_media_inner_classes .= ' medium landing-page';
	}else{
		if ( ! is_singular() ) {
			$featured_media_inner_classes .= ' medium';
		}
	}
	// Make the featured media thinner on archive pages.
	?>

	<figure class="featured-media <?php echo $featured_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">


		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">

			<?php
			the_post_thumbnail();

			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				?>

				<figcaption class="wp-caption-text"><?php echo wp_kses_post( $caption ); ?></figcaption>

				<?php
			}
			?>

		</div><!-- .featured-media-inner -->

	</figure><!-- .featured-media -->

	<?php
}
