<?php get_header(); ?>

<?php the_post(); ?>
<h1><?php the_title(); ?></h1>

<div id="page-<?php the_ID(); ?>" class="post clearfix <?php echo has_post_thumbnail() == true ? 'has-thumbnail' : 'no-thumbnail'; ?>">

	<?php if (has_post_thumbnail()): ?>
		<div class="thumbnail">
  			<?php the_post_thumbnail('home_thumbnail'); ?>
	  	</div>
	<?php endif; ?>
	<div class="content"><?php the_content(); ?></div>
</div>
<?php comments_template( '', true ); ?>
<?php get_footer(); ?>