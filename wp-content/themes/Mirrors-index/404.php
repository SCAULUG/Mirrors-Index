<?php get_header();?>
	<div id="main">
		<div class="row content">
		<div class="col-md-8">
			<h2 style="width:190px;">您好像进入了异次元空间</h2>
			<table class="table">

				<tbody>
										<tr>
						<td>请确认您寻找的资源地址是否正确并重试。</td>
						
					</tr>

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