<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->

<!-- Favicon, Thumbnail image -->
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/webclip.png" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="clearfix" role="banner">
	<div id="wrapper" class="clearfix">
		<h1 class="head-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/header/title-head.jpg" alt="<?php bloginfo( 'name' ); ?>"></a></h1>
	</div>
	<!-- #wrapper -->
	
	<nav class="primary-navigation navigation both clearfix" role="navigation">
		<div id="wrapper">
			<div id="toggle" class="sp"><a href="#"></a></div>
			<?php wp_nav_menu( array('theme_location'  => 'primary', 'menu_class' => 'primary' ) ); ?>
		</div>
		<!-- #wrapper --> 
	</nav>
</header>
<!-- #masthead -->

<div id="wrapper" class="clearfix">
	<div id="main-left" class="site-main">