<?php get_header(); ?>

<?php the_post(); ?>
<h1><?php the_title(); ?></h1>

<div class="content"><?php the_content(); ?></div>

<?php get_footer(); ?>