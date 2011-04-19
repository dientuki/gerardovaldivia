
	</div><?php //main?>
	
	<footer>
		<div class="wrapper">
			<?php wp_nav_menu( array( 'container' => 'none', 'menu_id' => 'footer-menu', 'theme_location' => 'footer' ) ); ?>
		</div>
	</footer>

<?php //Grab M$ CDN's jQuery. fall back to local if necessary ?>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.4.4.min.js"%3E%3C/script%3E'));</script>

<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.galleryview-2.1.1-pack.js" type="text/javascript"></script>

<script src="<?php bloginfo( 'template_url' ); ?>/js/script.js" type="text/javascript" defer="defer"></script>

<!--[if lt IE 7 ]>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/dd_belatedpng_script.js"></script>
<![endif]-->

<?php wp_footer(); ?>
</body>
</html>