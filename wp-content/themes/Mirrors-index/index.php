<?php get_header();?>
	<div id="main">
		<div class="row content">
		<div class="col-md-8">
			<h2 style="width:110px;">站点资源列表</h2>
			<table class="table table-hover">

				<tbody>
					<?php
					$args = array('orderby' => 'title','showposts' => 999,'cat' => 2,'order' => 'asc' );
					$query_posts = new WP_Query();
					$query_posts->query($args);
					while ($query_posts->have_posts()) : $query_posts->the_post();
					$img_title = get_post_meta($post->ID, 'xtitle'.'_value', true);
					$url = get_post_meta($post->ID, 'url'.'_value', true);
					?>  
					<tr>
						<td><a href="<?php echo $url; ?>"><?php echo $img_title; ?></a></td>
						<td><?php get_update_time($img_title); ?></td>
						<td><a href="<?php the_permalink(); ?>" target="_blank">HELP</a></td>
					</tr>
					
					<?php endwhile;?>
					<?php wp_reset_query(); ?>


				</tbody>
			</table>
			</div>

			<div class="col-md-4">
				<?php get_sidebar();?>
				<aside>
				<h2>站点动态</h2>
				<ul class="index-news">
					<?php
					$args = array('orderby' => 'title','showposts' => 5,'cat' => 1 );
					$query_posts = new WP_Query();
					$query_posts->query($args);
					while ($query_posts->have_posts()) : $query_posts->the_post();
					$img_title = get_post_meta($post->ID, 'xtitle'.'_value', true);
					$url = get_post_meta($post->ID, 'url'.'_value', true);
					?> 
					<li><span><?php the_time('m-d') ?></span><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
					<?php endwhile;?>
					<?php wp_reset_query(); ?>
				</ul>
				</aside>
			</div>



		</div>
<?php get_footer();?>