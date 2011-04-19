<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!'); ?>

<?php if (!empty($post->post_password)): // if there's a password ?>
	<?php if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password):  // and it doesn't match the cookie ?>

		<p class="nocomments">Post protegido por contraseña.</p>

		<?php return; ?>
	<?php endif; ?>
<?php endif; ?>

<!-- You can start editing here. -->
<div id="comments">
	<?php if ($comments) : ?>
		<h2><?php comments_number('Ning&uacuten; comentario', '1 comentario', '% comentarios' );?></h2>
	
		<div class="comment-list">
	
			<?php foreach ($comments as $comment) : ?>
				<?php $isByAuthor = $comment->comment_author_email == get_bloginfo('admin_email') ? true : false; ?>
				<div class="<?php if($isByAuthor): ?> commentOfficialUser<?php endif; ?> item" id="comment-<?php comment_ID() ?>">
					<div class="comment-meta">
						<div class="cgravatar"><?php echo get_avatar( $comment, 60, get_bloginfo('template_directory') . '/images/gravatar-default.png'); ?> </div>
		         
						<div class="comment-author">
							<?php comment_author_link() ?><br /><div class="comment-date"><?php comment_date('M j, Y') ?></div>
		            	</div>
		                
		            </div>
					<?php if ($comment->comment_approved == '0') : ?>
						<em>Tu comentario esta siendo moderado.</em>
					<?php endif; ?>
		
					<?php comment_text() ?>
					<div class="clear"></div>
				</div>
			<?php endforeach; /* end for each comment */ ?>
	
		</div>
	
	<?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ('open' == $post->comment_status) : //If comments are open, but there are no comments. ?>
	
		 <?php else : // comments are closed ?>
			<p class="nocomments">No se puede comentar más.</p>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ('open' == $post->comment_status) : ?>
	
		<h2>Comentar</h2>
		
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">
		
		<?php if ( $user_ID ) : ?>
		
			<p>Logueado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>
		
		<?php else : ?>
		
			<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			<label for="author"><strong>Nombre</strong><?php if ($req): ?> (requerido) <?php endif;?></label></p>
			
			<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			<label for="email"><strong>E-mail</strong> <em>(No será publicado)</em><?php if ($req): ?> (requerido) <?php endif;?></label></p>
		
		<?php endif; ?>
		
		<p><textarea name="comment" id="comment" cols="40" rows="10" style="width:570px;" tabindex="4"></textarea></p>
		
		<p><input name="submit" type="submit" id="submit" tabindex="5" value="Comentar" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		</p>
		<?php do_action('comment_form', $post->ID); ?>
		
		</form>
	
	<?php endif; // if you delete this the sky will fall on your head ?>
</div>