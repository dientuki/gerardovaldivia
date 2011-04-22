<!doctype html> 
<!--[if lt IE 7 ]> <html lang="es-AR" id="ie6" class="no-js ie"> <![endif]-->
<!--[if IE 7 ]> <html lang="es-AR" id="ie7" class="no-js ie"> <![endif]-->
<!--[if IE 8 ]> <html lang="es-AR" id="ie8" class="no-js ie"> <![endif]-->
<!--[if IE 9 ]> <html lang="es-AR" id="ie9" class="no-js ie"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es-AR" class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<base href="<?php bloginfo( 'url' ); ?>/" />

<title>

	<?php if (is_single()) :?>
		<?php wp_title('' , true); ?>
	<?php else:?>
		<?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . 'Pagina %s';
	
		?>
	<?php endif; ?></title>
<?php //Mobile viewport optimized: j.mp/bplateviewport ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php //<!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references ?>
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
<link rel="profile" href="http://gmpg.org/xfn/11" />

 
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/styles.css.php" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/jquery.galleryview-3.0.css" />
<?php //Uncomment if you are specifically targeting less enabled mobile browsers ?>
<link rel="stylesheet" media="handheld" href="<?php bloginfo( 'template_url' ); ?>/css/handheld.css">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" /><![endif]-->

<?php wp_head(); ?>

<script src="<?php bloginfo( 'template_url' ); ?>/js/modernizr-1.6.min.js"></script>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class="wrapper">
			<div id="logo"><a href="<?php bloginfo( 'url' ); ?>" title="<?php echo get_bloginfo() . ' - ' . get_bloginfo('description'); ?>"><span class="hidden"><?php bloginfo()?></span></a></div>
			<div id="tagline" class="hidden"><?php bloginfo('description'); ?></div>
			<?php wp_nav_menu( array( 'container' => 'none', 'menu_id' => 'primary-menu', 'theme_location' => 'primary', 'link_before' => '<span></span>') ); ?>
			<?php wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'secondary-menu', 'theme_location' => 'secondary' ) ); ?>
			<ul id="follow-me">
				<li class="facebook"><a href="#"><span class="hidden">Facebook</span></a></li>
				<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><span class="hidden">Rss</span></a></li>
			</ul>
			
		</div>
		<div class="gradient"></div>
	</header>

	<div id="main" class="wrapper">
