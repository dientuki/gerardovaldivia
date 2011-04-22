<?php get_header(); ?>
<?php the_post(); ?>
		<div class="post">
			<div class="clearfix <?php echo has_post_thumbnail() == true ? 'has-thumbnail' : 'no-thumbnail'; ?>">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" /><?php the_title(); ?></a></h3>
				<?php if (has_post_thumbnail()): ?>
					<div class="obra_thumbnail thumbnail">
			  			<?php the_post_thumbnail('obra_thumbnail'); ?>
			  		</div>
				<?php endif; ?>
				<div class="content"><?php the_content('... seguir leyendo'); ?></div>
				<?php include dirname(__FILE__) . '/share.php';?>
			</div>	
		</div>
		<?php $gallery = get_gallery(get_the_ID()); ?>
		<?php if ($gallery): ?>
			<ul id="galleryview">
			<?php $size = 'large'; ?>
			<?php foreach($gallery as $item): ?>
				<li>
					<img width="<?php echo $item[$size][1]; ?>" height="<?php echo $item[$size][2]; ?>" alt="<?php echo $item['alt']; ?>" title="<?php echo $item['title']; ?>" src="<?php echo $item[$size][0]; ?>" />
					<?php if($item['desc']):?><span class="panel-overlay"><?php echo $item['desc']; ?> </span><?php endif;?>					
				</li>
			<?php endforeach; ?>			
			</ul>
		<?php endif; ?>
<?php get_footer(); ?>