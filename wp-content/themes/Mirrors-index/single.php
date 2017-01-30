<?php get_header();?>
	<div id="main">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<div class="row content single">
			<h2><?php the_title_attribute(); ?></h2>
			<span>by <?php the_author_link(); ?> - <?php the_time('m/d/y') ?></span>
			<?php the_content("Read More..."); ?>

		</div>
		<?php endwhile; ?>
		<?php else : ?>
		<?php endif; ?>

<?php get_footer();?>