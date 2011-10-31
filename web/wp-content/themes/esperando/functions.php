<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

    	/* robotics functions */
	function mr_image_url($image)
	{
		return get_template_directory_uri() . '/img/' . $image;
	}
	
	function mr_protocol()
	{
		return (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https');
	}
	
		// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', (mr_protocol() . "://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"), false);
	   wp_enqueue_script('jquery');

	   wp_deregister_script('jquery-ui');
	   wp_register_script('jquery-ui', get_template_directory_uri() . '/js//jquery-ui-1.8.16.custom.min.js', array( 'jquery' ), '1.8.16', false);
	   wp_enqueue_script('jquery-ui');
	}
	
	wp_deregister_script('jquery-colorbox');
	wp_register_script('jquery-colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array( 'jquery' ), '1.3.17.2', true);
	
	wp_deregister_script('jquery-watermark');
	wp_register_script('jquery-watermark', get_template_directory_uri() . '/js/jquery.watermark-min.js', array( 'jquery' ), '3.1.3', true);
	
	 /*
   * lulacruza-icon shortcode
   * 
   * desc:
   * shows the lulacruza icons
   * 
   * args:
   * name - icon to show. values: circle-star, wave, shell, butterfly, arrow, ship, star, knot
   */
	function lc_icon_shortcode_handler( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'name' => 'star'
      ), $atts ) );
  
      $valid = true;
      
      	switch($name)
      	{
      	  case 'circle-star':
      			break;
				  case 'wave':
      			break;
					case 'shell':
      			break;
					case 'butterfly':
      			break;
					case 'arrow':
      			break;
					case 'ship':
      			break;
					case 'star':
      			break;
					case 'knot':
      			break;
      		default:
      			$valid = false;
      			break;
      	}
      	
      	if($valid)
      	{
      		return '<div class="icon icon-' . $name . '"></div>';
      	}
	}
	
  add_shortcode( 'lulacruza-icon', 'lc_icon_shortcode_handler' );
  
  /*
   * lulacruza-latest-news-item shortcode
   * 
   * desc:
   * shows the latest blog excerpt
   * 
   * args:
   * fallback - string to display when no news is available
   */
  function lc_latest_news_shortcode_handler( $atts, $content = null ) {
   extract( shortcode_atts( array(
   		'title' => __('title'),
      'fallback' => __('there are no news items at this time.'),
      'more' => __('more')
      ), $atts ) );
      
  	$query = array(
			'showposts' => 1,
			'cat' => 1
		);
		
		$ret = "";
		
		query_posts($query); 
		
		$title = str_replace(" ", "&nbsp;",  $title);
		
		$ret .= '<div class="latest-news">' . "\n";
		$ret .= '<hr/>';
		$ret .= '<table class="h3"><tr><td class="h3-left"><hr></td><td width="0" class="h3-content">' . $title . '</td><td class="h3-right"><hr></td></tr></table>';
		
		if(have_posts())
		{
			while (have_posts()) 
			{
				$ret .= '<div class="latest-news-excerpt">' . "\n";
				the_post(); 
		    $excerpt = get_the_excerpt();
		    $link = '<a href="' . get_permalink($post->ID) . '">' . $more . '</a>';
		    $ret .= $excerpt . ' ' . $link . "\n";
		    $ret .= '</div>' . "\n";
		    
		    $ret .= '<div class="latest-news-info">' . "\n";
		    $ret .= lc_get_the_post_time('F jS, Y') . ' ' . the_author( '', false ) ;
		    $ret .= '</div>' . "\n";
			} 
		}
		else
		{
			$ret .= '<div class="latest-news-item">' . $fallback . '</div>' . "\n";
		}
		
		$ret .= '<hr/>';
		$ret .= '</div>' . "\n";
		wp_reset_query() ;
		
		return $ret;
	}
	
  add_shortcode( 'lulacruza-latest-news-item', 'lc_latest_news_shortcode_handler' );
  
  function lc_get_the_post_time($d = '')
  {
  	return apply_filters('the_time', get_the_time( $d ), $d);
  }
  
  /*
   * lulacruza-h3
   * 
   * desc:
   * shows 3rd level header
   * 
   * args:
   * title - header title string to display
   */
  function lc_h3_shortcode_handler( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => __('title')
      ), $atts ) );
     
    $title = str_replace(" ", "&nbsp;",  $title);
    $ret .= '<table class="h3"><tr><td class="h3-left"><hr></td><td width="0" class="h3-content">' . $title . '</td><td class="h3-right"><hr></td></tr></table>';
		
		return $ret;
	}
	
  add_shortcode( 'lulacruza-h3', 'lc_h3_shortcode_handler' );
  
  /*
   * lulacruza-top-button
   * 
   * desc:
   * shows 3rd level header
   * 
   * args:
   * title - header title string to display
   */
  function lc_btn_top_shortcode_handler( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => __('title')
      ), $atts ) );
     
    $title = str_replace(" ", "&nbsp;",  $title);
    $button = '<div class="btn-rnd btn-rnd-top"><a class="btn-rnd-a" href="#top"><img src='. mr_image_url('clear.gif') .' width="40" height="40"></a><div class="btn-rnd-title">'. $title . '</div></div>';
		$ret .= '<table class="btn-wrapper btn-wrapper-rnd"><tr><td class="btn-wrapper-left"><hr></td><td width="0" class="btn-wrapper-content">' . $button . '</td><td class="btn-wrapper-right"><hr></td></tr></table>';
		
		return $ret;
	}
	
  add_shortcode( 'lulacruza-btn-top', 'lc_btn_top_shortcode_handler' );


?>