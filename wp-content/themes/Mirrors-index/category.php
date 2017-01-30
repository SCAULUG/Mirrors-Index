<?php get_header();?>
	<div id="main">
		<div class="row content category">
			<h2><?php single_cat_title(); ?></h2>
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a><span><?php the_time('Y-m-d') ?></span></li>
			<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>
		</div>
		<?php pagenav($query_string); ?>

<?php get_footer();?>