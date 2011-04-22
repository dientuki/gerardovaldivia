<?php get_header(); ?>

<?php query_posts( 'post_type=novedad&post_status=publish&posts_per_page=1'); ?>

<?php if (have_posts() ) : ?>
<div id="news" class="post">
	<?php the_post(); ?>
	<div class="news-inner clearfix <?php echo has_post_thumbnail() ? "has-thumbnail" : 'no-thumbnail'; ?>">
		<h2>Novedades</h2>
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" /><?php the_title(); ?></a></h3>
		<?php if (has_post_thumbnail()): ?>
			<div class="featured_thumbnail thumbnail">
				<a href="<?php echo get_image_link($id); ?>" title="<?php the_title(); ?>">
		  			<?php the_post_thumbnail('featured_thumbnail'); ?>
		  			<div>Click para agrandar</div>
	  			</a>
	  		</div>
		<?php endif; ?>
		<div class="content"><?php the_content('... seguir leyendo'); ?></div>
		<?php include dirname(__FILE__) . '/share.php';?>
	</div>
</div>
<?php endif; ?>

<div id="last-works">
	<h2>Ultimos Trabajos</h2>
	<ul class="clear clearfix">
		<?php $cats = array('vidrios', 'telas', 'dibujos'); ?>
		
		<?php foreach ($cats as $cat): ?>
			<?php query_posts( 'post_type=obra&post_status=publish&posts_per_page=1&category_name='.$cat); ?>
			<?php the_post(); ?>
			<li class="post-content <?php echo has_post_thumbnail() ? "has-thumbnail" : 'no-thumbnail'; ?>">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" /><?php the_title(); ?></a></h3>
				<?php if (has_post_thumbnail()): ?>
					<div class="home_thumbnail thumbnail">
						<a href="<?php echo get_image_link($id); ?>" title="<?php the_title(); ?>">
				  			<?php the_post_thumbnail('home_thumbnail'); ?>
				  			<div>Click para agrandar</div>
			  			</a>
			  		</div>
				<?php endif; ?>
				<?php the_excerpt(); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php get_footer(); ?>