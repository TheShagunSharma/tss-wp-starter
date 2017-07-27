<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<body <?php body_class(); ?>>

		<!--Header-->
	
		<header>
			<div class="container">
				<h1 class="logo"><a class="logo" href="<?php bloginfo('url');?>"><?php bloginfo('title');?></a></h1>
				<nav><?php wp_nav_menu( array('menu' => 'Main', 'container' => false, )); ?></nav>
			</div>
		</header>
