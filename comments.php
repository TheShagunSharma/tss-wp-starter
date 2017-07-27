<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<ol class="commentlist">
	<?php wp_list_comments('avatar_size=60'); ?>
	</ol>

 <?php else : ?>

	<?php if ( comments_open() ) : ?>

	 <?php else : ?>
		<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>
<?php global $trackbacks; ?>
<?php if ($trackbacks) : ?>
<?php $comments = $trackbacks; ?>
<div id="pingback-trackback">
<h3 id="trackbacks"><?php echo sizeof($trackbacks); ?> Trackbacks/Pingbacks</h3>
	<ol class="pings">
 
	<?php foreach ($comments as $comment) : ?>
		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<cite><?php comment_author_link() ?></cite>
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>  
 		</li>

	<?php
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
 
	<?php endforeach; ?>
 
	</ol>
</div>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">
    
    <div class="cancel-comment-reply">
    	<small><?php cancel_comment_reply_link(); ?></small>
    </div>
    
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
    
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    
        <?php if ( is_user_logged_in() ) : ?>
        
        <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
        
        <?php else : ?>
        
        <div class="column">
            <label for="author">Name*</label>
            <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1"/>
        </div>
        
        <div class="column">
            <label for="email">Email*</label>
            <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
        </div>
        
        <div class="column">
            <label for="url">Website</label>
            <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
        </div>
        
        <?php endif; ?>
        
        <div class="comment-field">
            <label for="comment">Comment*</label>
            <textarea name="comment" id="comment" cols="70" rows="10" tabindex="4"></textarea>
        </div>
        
        <input class="btn" name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
        <?php comment_id_fields(); ?>
        
        <?php do_action('comment_form', $post->ID); ?>
    
    </form>
    
    <?php endif; ?>
</div>

<?php endif; ?>
