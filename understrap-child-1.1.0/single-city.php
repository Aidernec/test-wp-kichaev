<?php

/**
 * Single page city
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$category_title = get_queried_object()->name;
$container      = get_theme_mod( 'understrap_container_type' ); ?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<main class="site-main" id="main">

				<section id="tax_realestate_wrap" class="row">
					<?php
					$realestate = new WP_Query(
						array(
							'post_type'      => 'realestate',
							'post_parent'     => $post->ID,
							'posts_per_page' => 10,
						)
					);
					?>

					<?php if ( $realestate->have_posts() ) : ?>
						<?php
						while ( $realestate->have_posts() ) :
							$realestate->the_post();
							?>
							<?php
							$img         = get_the_post_thumbnail_url( $post->ID, 'large' );
							$link        = get_permalink( $post->ID );
							$name        = get_the_title( $post->ID );
							$description = get_post_field( 'post_content', $post->ID );
							$description = wp_strip_all_tags( $description );
							$description = mb_strimwidth( $description, 0, 150, '...' );
							?>

							<div class="col-12 col-sm-6 col-lg-4 mb-4">
								<a href="<?php echo $link; ?>" class="card">
									<div class="card-image"><img src="<?php echo $img; ?>" alt=""></div>
									<div class="card-body">
										<h5 class="card-title"><?php echo esc_html( $name ); ?></h5>
										<p class="card-text"><?php echo esc_html( $description ); ?></p>
									</div>
								</a>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</section>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
