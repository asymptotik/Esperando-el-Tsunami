<?php
/**
 * Template Name: Screenings Template Wide
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
	
<div class="post lc-host wide" id="post-<?php the_ID(); ?>">
	<h2><?php the_title(); ?></h2>
	<div class="entry">
		<?php the_content(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php endwhile; endif; ?>

<script>
(function($) {
	
})(jQuery);
</script>

<?php get_footer(); ?>