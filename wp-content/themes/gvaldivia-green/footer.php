
	</div><?php //main?>
	
	<footer>
		<div class="wrapper">
			<?php wp_nav_menu( array( 'container' => 'none', 'menu_id' => 'footer-menu', 'theme_location' => 'footer' ) ); ?>
		</div>
	</footer>
	
<script type="text/javascript">var base_url = '<?php bloginfo( 'template_url' ); ?>';</script>	
<script src="<?php bloginfo( 'template_url' ); ?>/js/myhead.js" type="text/javascript"></script>

<?php wp_footer(); ?>
</body>
</html>