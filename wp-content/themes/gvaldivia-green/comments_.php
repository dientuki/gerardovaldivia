			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword">Este post esta protegido con contraseña</p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'Un comentario en %2$s', '%1$s Muchos comentarios to %2$s', get_comments_number(), 'twentyten' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

			<ul class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'gvaldivia_comment' ) ); ?>
			</ul>

<?php else : 
	if ( ! comments_open() ) :
?>
	<p class="nocomments">No se puede comentar</p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
