<?php
/**
 * Template Name: Main Template
 *
 * A custom page template for the main page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage esperando
 * @since esperando 1.0
 */
 get_header('main'); 
 ?>

<?php 
			while (have_posts())
			{
				the_post();
				$post_slug = $post->post_name;

				$innerQuery = new WP_Query();
				$theId = $post->ID;
				$innerArgs = array(
				  'post_type' => 'page',
				  'post_parent' => $theId,
				  'order_by' => 'order',
				  'order' => 'ASC'
				  );
			  
			  $innerQuery->query($innerArgs);
			  if($innerQuery->have_posts())
			  {
			  	echo '<div id="menu-main">' . "\n";
					
				  while($innerQuery->have_posts()) 
				  {	
				  	  $innerQuery->the_post();
				  	  echo '    <a id="btn-' . $post->post_name . '" class="menu-main-item" href="#">'.  strtoupper (the_title('', '', false)) . '</a>';
				  	  if ( $innerQuery->current_post + 1 < $innerQuery->post_count )
			  			{
					  		echo '<img class="menu-main-sep" src="' . mr_image_url("menu-sep.gif") . '"/>';
			  			}
				  }
				  
				  echo '</div>' . "\n";
			  }
			}
?>

<div class="loading"><span> <img src="<?php echo mr_image_url('loading.png') ?>" width="510" height="510"></span> </div>
<div id="counters">
	<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="ottonassar">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<div class="spacer-share"></div>
	<iframe src="http://www.facebook.com/plugins/like.php?app_id=143465975739444&amp;href=http%3A%2F%2Fesperando.cc&amp;send=false&amp;layout=box_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=60" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:60px; margin-left:2px;" allowTransparency="true"></iframe>
	<div class="spacer-share"></div>
	
	<!-- Place this tag where you want the +1 button to render -->
	<g:plusone size="tall"></g:plusone>
	
	<!-- Place this tag after the last plusone tag -->
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
</div>

<div class="best-things-wrapper">
	<div class="best-things-bg"></div>
	<ul class="best-things">
	  <li class="thing-one">
	    <div id="sec-film" class="content"><img src="<?php echo mr_image_url('01.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-two">
	    <div id="sec-trailer" class="content"><img src="<?php echo mr_image_url('02.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-three">
	    <div id="sec-album" class="content"><img src="<?php echo mr_image_url('03.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-four">
	    <div id="sec-screenings-concerts" class="content"><img src="<?php echo mr_image_url('04.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-five">
	    <div id="sec-out-takes" class="content"> <img src="<?php echo mr_image_url('05.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-six">
	    <div id="sec-credits" class="content"> <img src="<?php echo mr_image_url('06.png') ?>" width="1920" height="1200"></div>
	  </li>
	  <li class="thing-seven">
	    <div id="sec-contact" class="content"><img src="<?php echo mr_image_url('07.png') ?>" width="1920" height="1200"></div>
	  </li>
	</ul>
</div>

<script>

var things_bg_height = 0.0;
var things_height = 0.0;

function mr_bg()
{
	var offset = window.pageYOffset;
	var windowHeight = $(window).height();
	var things_pct_diff = (things_bg_height - windowHeight) / (things_height - windowHeight);
	var bg_offset = offset * things_pct_diff;
	
	$('.best-things-bg').css({
		"top" : (0 - bg_offset) +"px"
	});	  
}

(function($) {
	
    $(document).ready(function(){

    	  $('.menu-main-item').click(function()
    			  { 
    		      var currentId = $(this).attr('id');
    		      var section = currentId.replace('btn-', 'sec-');
    		      $('html,body').animate({scrollTop: $("#"+section).offset().top},'slow');
    		      return false;
    			  });
		  
				things_bg_height = $('.best-things-bg').height() - 10;
				things_height = $('.best-things').height();
				
				$(window).resize(function(e){ mr_bg(); });
      	$(window).scroll(function() { mr_bg(); });
    });

    $(window).load(function() {
    	$('.loading').animate({"top" : "100%"});
    });
    
})(jQuery);
</script>
<?php get_footer(); ?>
