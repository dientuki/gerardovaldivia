<?php
	/* Template Name: Contactame */
	get_header();
?>
<?php the_post(); ?>
<h1><?php the_title(); ?></h1>

<form id="contact-form" class="alignleft form" method="post" action="mail">
	<input type="hidden" name="referer" value="<?php the_permalink(); ?>" />
	<ul>
		<li>
			<label for="form[Name]"><strong class="required">*</strong>Nombre:</label>
			<input type="text" id="form[Name]" name="form[Name]" value="" class="required" />		
		</li>
		<li>
			<label for="form[Email]"><strong class="required">*</strong>Correo:</label>
			<input type="text" id="form[Email]" name="form[Email]" value="" class="required" />				
		</li>
		<li>
			<label for="form[Phone]">Telefóno:</label>
			<input type="text" id="form[Phone]" name="form[Phone]" value="" class="required" />			
		</li>
		<li class="textarea">
			<label for="form[Comment]"><strong class="required">*</strong>Interes o Comentario</label>
			<textarea id="form[Comment]" name="form[Comment]"></textarea>					
		</li>
		<li class="submit"><input type="submit" class="submit" value="Enviar" /></li>
	</ul>
</form>

<div class="alignright">

	<div class="contact-data">
		<?php $image = get_random_image();?>
		<p>Correo: <a href="mailto:<?php echo 'gerardo@gerardovaldivia.com.ar'; // bloginfo('admin_email')?>" title="Gerardo Valdivia"><?php echo 'gerardo@gerardovaldivia.com.ar'; // bloginfo('admin_email')?></a></p>
		<div class="thumbnail"><img alt="<?php echo $image[3]; ?>" title="<?php echo $image[4]; ?>" src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" /></div>
	</div>

</div>

<div class="clearfix"></div>
<?php get_footer(); ?>