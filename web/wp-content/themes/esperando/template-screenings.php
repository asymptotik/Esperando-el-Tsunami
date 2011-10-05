<?php
/**
 * Template Name: Screenings Template
 *
 * A custom page template for a screenings page.
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
	
<div class="post screenings" id="post-<?php the_ID(); ?>">
	<h2><?php the_title(); ?></h2>
	<hr>
	<div class="entry">
		<?php the_content(); ?>
		<div class="clear"></div>
	</div>
	
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>

<?php endwhile; endif; ?>

<script>
(function($) {
	
})(jQuery);
</script>

<?php get_footer(); ?>