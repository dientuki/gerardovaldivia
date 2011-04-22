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
		<h2><?php comments_number('Ning&uacute;n comentario', '1 comentario', '% comentarios' );?></h2>
	
		<div class="comment-list">
	
			<?php foreach ($comments as $comment) : ?>
				<?php $isByAuthor = $comment->comment_author_email == get_bloginfo('admin_email') ? true : false; ?>
				<div class="<?php if($isByAuthor): ?> commentOfficialUser<?php endif; ?> item" id="comment-<?php comment_ID() ?>">
					<div class="comment-meta clearfix">
						<div class="cgravatar"><?php echo get_avatar( $comment, 60, get_bloginfo('template_directory') . '/images/gravatar-default.png'); ?> </div>
		         
						<div class="comment-author"><?php comment_author_link() ?> dijo:</div>
						<div class="comment-date"><?php comment_date('M j, Y') ?></div>
		            </div>
					<div class="comment">
						<?php if ($comment->comment_approved == '0') : ?>
							<em>Tu comentario esta siendo moderado.</em>
						<?php endif; ?>
			
						<?php comment_text() ?>
					</div>
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
		
		<form class="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			<ul>
				<?php if ( $user_ID ) : ?>
				
					<li class="logged">Logueado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></li>
				
				<?php else : ?>
				
					<li>
						<label for="author"><?php if ($req): ?><strong class="required">*</strong><?php endif;?>Nombre:</label>
						<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					</li>
					<li>
						<label for="email"><?php if ($req): ?><strong class="required">*</strong><?php endif;?>E-mail:</label>					
						<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<em>No será visible</em>
					</li>
								
				<?php endif; ?>
				
					<li class="textarea">
						<textarea name="comment" id="comment" tabindex="4"></textarea>
					</li>
					
					<li class="submit">
						<input class="submit"  name="submit" type="submit" id="submit" tabindex="5" value="Comentar" />
					</li>
			</ul>
			<?php do_action('comment_form', $post->ID); ?>
		</form>
	
	<?php endif; // if you delete this the sky will fall on your head ?>
</div>