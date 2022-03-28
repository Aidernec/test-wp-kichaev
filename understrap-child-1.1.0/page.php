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

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<main class="site-main" id="main">

				<section id="tax_realestate_wrap" class="row cards__wrap mb-5">
					<h2>Недвижимость</h2>
					<?php
					$realestate = new WP_Query(
						array(
							'post_type'      => 'realestate',
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
									<ul class="list-group list-group-flush">
										<?php
										if ( ! empty( get_field( 'ploshhad' ) ) ) :
											?>
											<li class="list-group-item"><?php echo 'Площадь: ' . get_field( 'ploshhad' ); ?></li> <?php endif; ?>
										<?php
										if ( ! empty( get_field( 'stoimost' ) ) ) :
											?>
											<li class="list-group-item"><?php echo 'Стоимость: ' . get_field( 'stoimost' ); ?></li> <?php endif; ?>
										<?php
										if ( ! empty( get_field( 'adres' ) ) ) :
											?>
											<li class="list-group-item"><?php echo 'Адрес: ' . get_field( 'adres' ); ?></li> <?php endif; ?>
										<?php
										if ( ! empty( get_field( 'zhilaya_ploshhad' ) ) ) :
											?>
											<li class="list-group-item"><?php echo 'Жилая площадь: ' . get_field( 'zhilaya_ploshhad' ); ?></li> <?php endif; ?>
										<?php
										if ( ! empty( get_field( 'etazh' ) ) ) :
											?>
											<li class="list-group-item"><?php echo 'Этаж: ' . get_field( 'etazh' ); ?></li> <?php endif; ?>
									</ul>
								</a>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</section>

				<section id="tax_city_wrap" class="row cards__wrap mb-5">
					<h2>Города</h2>
					<?php
					$cities = new WP_Query(
						array(
							'post_type' => 'city',
						)
					);
					?>
					<?php if ( $cities->have_posts() ) : ?>
						<?php
						while ( $cities->have_posts() ) :
							$cities->the_post();
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

				<section>
					<div class="form-title">Добавление недвижимости</div>
					<form class="form-add-realestate" action="<?php echo get_stylesheet_directory_uri() . '/inc/ajax-add-realestate.php'; ?>" enctype="multipart/form-data" method="POST">
						<div class="row">
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestTitle">Название</label>
								<input type="text" class="form-control" name="title" id="formAddRealestTitle" placeholder="Название недвижимости" required>
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestDescription">Описание</label>
								<input type="text" class="form-control" name="description" id="formAddRealestDescription" placeholder="Описание недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestSq">Площадь</label>
								<input type="text" class="form-control" name="square" id="formAddRealestSq" placeholder="Площадь недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestPrice">Стоимость</label>
								<input type="text" class="form-control" name="price" id="formAddRealestPrice" placeholder="Стоимость недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestAdress">Адрес</label>
								<input type="text" class="form-control" name="adress" id="formAddRealestAdress" placeholder="Password недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestLivSq">Жилая площадь</label>
								<input type="text" class="form-control" name="liveSq" id="formAddRealestLivSq" placeholder="Жилая площадь недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestFloor">Этаж</label>
								<input type="text" class="form-control" name="floor" id="formAddRealestFloor" placeholder="Этаж недвижимости">
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestType">Тип недвижимости</label>
								<select id="formAddRealestType" class="form-control" name="type">
									<option value="Офисы" selected>Офисы</option>
									<option value="Квартиры">Квартиры</option>
									<option value="Частные дома">Частные дома</option>
								</select>
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestCity">Город</label>
								<select id="formAddRealestCity" class="form-control" name="city">
									<option value="Москва" selected>Москва</option>
									<option value="Челябинск">Челябинск</option>
									<option value="Екатеринбург">Екатеринбург</option>
								</select>
							</div>
							<div class="form-group col-3 mb-3">
								<label for="formAddRealestImg">Изображение</label>
								<input type="file" class="form-control" id="formAddRealestImg" name="image" placeholder="Изображение недвижимости">
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</section>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
