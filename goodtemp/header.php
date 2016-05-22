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

<!-- css -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

<!-- Favicon, Thumbnail image -->
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="clearfix" role="banner">
	<div id="wrapper" class="clearfix">
		<h1 class="head-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/header/head_logo.png" alt="<?php bloginfo( 'name' ); ?>"></a></h1>
		<h2 class="head-description">
			<?php bloginfo('description'); ?>
		</h2>
		<h2 class="head-tel"><img src="<?php echo get_template_directory_uri(); ?>/images/header/head_tel.png" alt="お気軽にお問い合わせください。"></h2>
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

<?php if( is_page( 'contact' ) ) : ?>
<?php //お問い合わせの時googlemap表示 ?>
<section class="main-img">
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6448.013375758283!2d136.234754!3d36.093325!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5da71f09bdd9aff4!2z5qCq5byP5Lya56S-44ON44OD44OI44K344K544OG44Og!5e0!3m2!1sja!2sus!4v1416877230342" width="100%" height="400" frameborder="0" style="border:0"></iframe>
</section>
<?php else: ?>
<div id="wrapper">
	<section class="main-img"> <?php echo do_shortcode("[metaslider id=149]"); ?> </section>
</div>
<!-- #wrapper -->

<?php endif; ?>
<div id="wrapper" class="clearfix">
<?php if(is_front_page() || is_page( 'contact' ) || is_page( 'home2' ) ) : ?>
	<?php //トップページ、お問い合わせ、home2の時1カラムに ?>
	<div id="main" class="site-main">
<?php else: ?>
	<?php //トップページじゃない時2カラム（右サイドバー）に ?>
	<div id="main-left" class="site-main">
<?php endif; ?>
