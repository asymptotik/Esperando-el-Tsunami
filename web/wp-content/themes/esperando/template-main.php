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
				$innerArgs = array(
				  'post_type' => 'page',
				  'post_parent' => 2,
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

<noscript>
  <style>
    .latest-news{
      display:block;
    }
  </style>
</noscript>



<div class="best-things-wrapper">
  <div class="best-things-bg"></div>

  <ul class="best-things">

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
  		
  	  while($innerQuery->have_posts()) 
  	    {	
  	      $innerQuery->the_post();

  	      
  	      echo '  <li id="sec-' . $post->post_name . '"> ' . "\n";
  		    echo '    <a name="'. $post->post_name . '"></a>' . "\n";
  	      echo '    <div class="content">';

  	      if($post->post_content != '') :
  		the_content();
  	      endif;

  	      echo '</div>' . "\n";
  	       echo '  </li>' . "\n";
  	    }
  	  
  	 
  	}
      }
  ?>

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
	$('.menu-main-item').click(function(){
	    var currentId = $(this).attr('id');
	    var section = currentId.replace('btn-', 'sec-');
	    $('html,body').animate({scrollTop: $("#"+section).offset().top-100},'slow');
	    return false;
	  });
		  
	  things_bg_height = $('.best-things-bg').height() - 100;
	  things_height = $('.best-things').height();
				
	  $(window).resize(function(e){ mr_bg(); });
	  $(window).scroll(function() { mr_bg(); });

	// bind 'read more' functionality to its button
	$('.read-more').click(function(){
	    $('#welcome_content').toggle(300);
	  });

	// bind 'close' functionality to its button
	$('.close-button').click(function(){
	    $(this).parent().toggle(300);
	  });

	// bind 'play' to show appropriate container
	// jQuery cycle (see below) handles the paging
	$('.trailer-thumb').click(function(){
	    $('#trailer-container').show(300);
	  });


	//bind scroll to top to its buttons
	$('.btn-rnd-top').click(function(){
	    $('html,body').animate({scrollTop: 0},'slow');
	  });


    $('#trailers').cycle({
      fx: 'slideX',
      next:  '#next',
      prev: '#prev',
	  pager:'#trailer-thumb-container',
	  pagerAnchorBuilder: function(idx, slide) { 
	  // return selector string for existing anchor 
	  return '#trailer-thumb-container li:eq(' + idx + ') a'; 
	}
    });

    $('#trailers').cycle('pause');

	
      });

    $(window).load(function() {
    	$('.loading').animate({"top" : "100%"});
      });
    
})(jQuery);



</script>
<?php get_footer(); ?>
