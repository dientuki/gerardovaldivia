<?php get_header(); ?>

<?php the_post(); ?>
	<div class="clearfix">
		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" /><?php the_title(); ?></a></h1>
		<?php $gallery = get_gallery(get_the_ID());?>
		<?php $image = $gallery[0];?>
		<div class="content">
			<img title="<?php echo $image['title'];?>" alt="<?php echo $image['title'];?>" class="obra" width="<?php echo $image['large'][1];?>" height="<?php echo $image['large'][2];?>" src="<?php echo $image['large'][0];?>" />
			<?php the_content(); ?>
		</div>
	</div>
<?php get_footer(); ?>