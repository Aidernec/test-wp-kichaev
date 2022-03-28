<?php

/**
 * Single page realestate
 */ ?>

<?php get_header(); ?>

<?php
$post_id     = $post->ID;
$title       = get_the_title( $post_id );
$img         = get_the_post_thumbnail_url( $post_id, 'full' );
$description = get_queried_object()->post_content;
$description = apply_filters( 'the_content', $description );
$description = str_replace( ']]>', ']]&gt;', $description );
?>

<!-- Описание продукта -->
<div id="single-realestate" class="container mt-5">

	<main>
		<div class="single-realestate-image mb-5"><img src="<?php echo $img; ?>" alt=""></div>
		<h1 class="single-realestate-title mb-5"><?php echo $title; ?></h1>
		<div class="single-realestate-description"><?php echo $description; ?></div>
		<div class="row single-realestate-characteristics">
			<?php if ( ! empty( get_field( 'ploshhad' ) ) ) : ?> <div class="col-3 border border-dark"><?php echo 'Площадь: ' . get_field( 'ploshhad' ); ?></div> <?php endif; ?>
			<?php if ( ! empty( get_field( 'stoimost' ) ) ) : ?> <div class="col-3 border border-dark"><?php echo 'Стоимость: ' . get_field( 'stoimost' ); ?></div> <?php endif; ?>
			<?php if ( ! empty( get_field( 'adres' ) ) ) : ?> <div class="col-3 border border-dark"><?php echo 'Адрес: ' . get_field( 'adres' ); ?></div> <?php endif; ?>
			<?php if ( ! empty( get_field( 'zhilaya_ploshhad' ) ) ) : ?> <div class="col-3 border border-dark"><?php echo 'Жилая площадь: ' . get_field( 'zhilaya_ploshhad' ); ?></div> <?php endif; ?>
			<?php if ( ! empty( get_field( 'etazh' ) ) ) : ?> <div class="col-3 border border-dark"><?php echo 'Этаж: ' . get_field( 'etazh' ); ?></div> <?php endif; ?>
		</div>
	</main>

</div>


<!-- Подвал -->
<?php get_footer(); ?>
