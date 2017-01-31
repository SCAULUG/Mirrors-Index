<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php if (is_home()||is_search()) { echo "华南农业大学Linux镜像源 - SCAU Mirrors"; } elseif (is_404()) {echo "哎呀，你找的东西不在这个次元喔"; print " - "; bloginfo('name'); } else { wp_title(''); print " - "; bloginfo('name'); } ?> </title>
	<meta name="applicable-device" content="mobile">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
</head>
<body>
	<div id="header">
		<div class="content">
			<div class="left">
				<a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
				<p>root@scau-mirrors:~#</p>
			</div>
			<ul class="right">
				<?php
				if (function_exists('wp_nav_menu')) {
				$wp_nav_menu_out = wp_nav_menu(array('theme_location'=>'main_nav_menu', 'container'=>false, 'echo'=>false));
				echo preg_replace(array('#^<ul[^>]*>#', '#</ul>$#'), '', $wp_nav_menu_out);
				} else {
				}
				?>
			</ul>
		</div>
	</div>