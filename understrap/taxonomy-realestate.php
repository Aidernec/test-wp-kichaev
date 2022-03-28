<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container           = get_theme_mod( 'understrap_container_type' );
$taxonomy_realestate = get_terms( array( 'taxonomy' => 'realestate_category' ) );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

				<section id="tax_realestate_wrap" class="row">
					<?php if ( $taxonomy_realestate && ! is_wp_error( $taxonomy_realestate ) ) : ?>
						<?php foreach ( $taxonomy_realestate as $term_item ) : ?>
							<?php $img = get_field( 'изображение', $term_item ); ?>
							
							<div class="col-12 col-sm-6 col-lg-4 mb-4">
								<a href="<?php echo get_term_link( $term_item->term_id ); ?>" class="card">
									<div class="card-image"><?php echo wp_get_attachment_image( $img, 'large' ); ?></div>
									<div class="card-body">
										<h5 class="card-title"><?php echo esc_html( $term_item->name ); ?></h5>
										<p class="card-text"><?php echo esc_html( $term_item->description ); ?></p>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</section>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
