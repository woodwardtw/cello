<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="course-cat">
			<?php echo show_card_categories();?>
		</div>

		<div class="entry-meta">

			<?php //understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content course">

		<?php the_content(); ?>
		<?php 
		$dir = get_stylesheet_directory_uri();
		echo "<img src='{$dir}/imgs/super.svg' alt='Superperson icon.' class='hero-img'>";?>
		<h2>Lead ID: <?php echo the_instructional_designer();?></h2>
		<div class="row card-details">
			<?php echo the_notes();?>
			<?php echo the_timeline();?>
		</div>
		<h3>Shared Drive</h3>
		<?php echo the_google_folder();?>
		<div class="update-box">
			<h3>Updates</h3>
			<div class="update-scroller">
				<?php echo updates_query_loop(get_post_field( 'post_name' ));?>
			</div>
		</div>

		<?php update_form_creation(get_the_title());?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
