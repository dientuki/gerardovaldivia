<?php
	/* Template Name: Exposiciones */
	get_header();
?>
<?php the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
<?php query_posts('post_type=exposicion&post_status=publish&paged='.$page); ?>
<?php global $more; $more=0;?>

<div id="post-list">
<?php if (have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="post">
			<div class="clearfix <?php echo has_post_thumbnail() == true ? 'has-thumbnail' : 'no-thumbnail'; ?>">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" /><?php the_title(); ?></a></h3>
				<?php if (has_post_thumbnail()): ?>
					<div class="obra_thumbnail thumbnail">
						<a href="<?php echo get_image_link($id); ?>" title="<?php the_title(); ?>">
				  			<?php the_post_thumbnail('obra_thumbnail'); ?>
				  			<div>Click para agrandar</div>
			  			</a>
			  		</div>
				<?php endif; ?>
				<div class="content"><?php the_content('... ver fotos y seguir leyendo'); ?></div>
				<?php include dirname(__FILE__) . '/share.php';?>
			</div>	
		</div>
	<?php endwhile; ?>
<?php endif; ?>
</div>
<?php include dirname(__FILE__) . '/pagination-expo.php';?>

<?php get_footer(); ?>