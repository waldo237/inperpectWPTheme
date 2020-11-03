<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	if(!is_front_page()){
			
		get_template_part( 'template-parts/entry-header' );
		if ( ! is_search() ) {
			get_template_part( 'template-parts/featured-image' );
		}
	?>
	
	<div class="post-inner lazy-effect <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">
		<div class="entry-content">
			
			<?php
				if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
					the_excerpt();
				} else {
					the_content( __( 'Continue reading', 'twentytwenty' ) );
				}
				?>

		</div><!-- .entry-content -->
	</div>


	<?php 
	}else{
	?>

	<div class="post-inner landing-page lazy-effect <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">
		<div class="entry-content  landing-page">
			
			<?php
				if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
					the_excerpt();
				} else {
					the_content( __( 'Continue reading', 'twentytwenty' ) );
				}
				?>

		</div><!-- .entry-content -->

		<div class="hero-image  landing-page lazy-effect">
			<?php
				if ( ! is_search() ) {
					get_template_part( 'template-parts/featured-image' );
				}
			?>
		</div>
	</div><!-- .post-inner -->

<!-- SECOND ROW -->
	<div class="post-inner second-row <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">
			<?php
		if ( ! is_search() ) {
					get_template_part( 'searchform' );
				}
		?>
	</div>
<!-- SECOND ENDS -->
<!-- THIRD STARTS -->
<div class="taxonomies">
	<?php 
		$icons = get_field('icons');
		$terms = $icons["taxonomies"];
		?>
			<div class='taxonomy_icon_one taxonomy lazy-effect'>
				<?php if( $terms ): ?>
					<a href="<?php echo get_term_link( $terms[0] ); ?>">
					<?php echo get_term_by('name', $term) ?>
					<img src=<?php echo $icons['taxonomy_icon_one'];?>>
				<h4 class="taxonomy__title"><?php echo $terms[0]->name ?></h4>	
				</a>
				<?php endif; ?>
			</div>
			<div class='taxonomy_icon_two taxonomy lazy-effect'>
				<?php if( $terms ): ?>
					<a href="<?php echo get_term_link( $terms[1] ); ?>">
						
						<img src=<?php echo $icons['taxonomy_icon_two'];?>>
						<h4 class="taxonomy__title"><?php echo $terms[1]->name ?></h4>	
					</a>
				<?php endif; ?>
			</div>
			<div class='taxonomy_icon_three taxonomy lazy-effect'>
				<?php if( $terms ): ?>
					<a href="<?php echo get_term_link( $terms[2] ); ?>">
						<?php echo get_term_by('slug', $term) ?>
					<img src=<?php echo $icons['taxonomy_icon_three'];?>>
					<h4 class="taxonomy__title"><?php echo $terms[2]->name ?></h4>	
					</a>
				<?php endif; ?>
			</div>
		</div>
	
	<!-- THIRD ENDS -->
	<!-- FOURTH STARTS -->
	<!-- "title": "The wonderful journey",
			"excerpt": "<p>This shares my experiences about the unforgetfull cities of the world</p>\n",
			"content": "This is content",
			"date": "2020-05-25T08:43:18",
			"uri": "/the-unforgetful-cities/",
			"featuredImage": -->
	<div class="latest">
		<h3 class="latest__heading">
	<?php	echo get_field('latest_post_title'); ?>
			</h3>
		
			<?php 
				$the_query = new WP_Query( 'posts_per_page=3' ); ?>

				<?php 
				while ($the_query -> have_posts()) : $the_query -> the_post(); 
				?>
				<div class="latest__post_wrapper lazy-effect">
					<div class="latest__post">
						<img class="latest__post__img" src="<?php the_post_thumbnail_url('medium' ) ?>"/>
						<div class="latest__post__inner">
							<h5 class="latest__post__title"><?php the_title(); ?></h5>
							<p class="latest__post__excerpt"><?php the_excerpt(__('(more…)')); ?></p>
							<a href="<?php the_permalink() ?>">	<button class="latest__post__btn">lire plus</button></a>
						</div>
					</div>

				</div>
				
				<?php 
				// Repeat the process and reset once it hits the limit
				endwhile;
				wp_reset_postdata();
			?>
 </div>

	<!-- FOURTH ENDS -->
	<?php 
		}
		?>





	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
