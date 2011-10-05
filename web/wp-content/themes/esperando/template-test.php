<?php
/**
 * Template Name: Test Template
 *
 * A custom page template for the main screenings page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage esperando
 * @since esperando 1.0
 */
 get_header(); 
 ?>
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<div class="post home" id="post-<?php the_ID(); ?>">
	<table class="h2"><tr><td><hr></td><td width="0" class="h2-content"><h2><?php the_title(); ?></h2></td><td><hr></td></tr></table>
	<div class="entry">
		<hr>
		<?php the_content(); ?>
	</div>
	
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>

<?php endwhile; endif; ?>

<script>
(function($) {
	
})(jQuery);
</script>

<?php get_footer(); ?>