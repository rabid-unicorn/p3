<?php

// social sharing
if (!function_exists('pipdig_p3_comment_count')) {
	function p3_social_shares() {
		
		if (get_the_post_thumbnail() != '') {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id());
			$img = $thumb['0'];
		} else {
			$img = pipdig_p3_catch_that_image();
		}
		$link = rawurlencode(get_the_permalink());
		$title = urlencode(get_the_title());
		
		$twitter_handle = get_option('p3_twitter_handle');
		$via_handle = '';
		if (!empty($twitter_handle)) {
			$via_handle = '&via='.$twitter_handle;
		}
		
		$output = '';
		$output .= '<a href="//www.facebook.com/sharer.php?u='.$link.'" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>';
		$output .= '<a href="//twitter.com/share?url='.$link.'&text='.$title.$via_handle.'" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>';
		$output .= '<a href="//pinterest.com/pin/create/link/?url='.$link.'&media='.$img.'&description='.$title.'" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a>';
		$output .= '<a href="//plus.google.com/share?url='.$link.'" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a>';
		$output .= '<a href="//www.tumblr.com/widgets/share/tool?canonicalUrl='.$link.'&title='.$title.'" target="_blank" rel="nofollow"><i class="fa fa-tumblr"></i></a>';
		//$output .= '<a href="//www.stumbleupon.com/submit?url='.$link.'&title='.$title.'" target="_blank" rel="nofollow"><i class="fa fa-stumbleupon"></i></a>';
		
		echo '<div class="addthis_toolbox">'.__('Share:', 'p3').' '.$output.'</div>';
	}
}

// comments count
if (!function_exists('pipdig_p3_comment_count')) {
	function pipdig_p3_comment_count() {
		if (!post_password_required()) {
			$comment_count = get_comments_number();
			if ($comment_count == 1 ) {
				$comments_text = __('1 Comment', 'p3');
			} else {
				$comments_text = number_format_i18n($comment_count).' '.__('Comments', 'p3');
			}
			echo $comments_text;
		}
	}
}

// comments nav
if (!function_exists('pipdig_p3_comment_nav')) {
	function pipdig_p3_comment_nav() {
		echo '<div class="nav-previous">'.previous_comments_link('<i class="fa fa-arrow-left"></i> '.__('Older Comments', 'p3')).'</div>';
		echo '<div class="nav-next">'.next_comments_link(__('Newer Comments', 'p3').' <i class="fa fa-arrow-right"></i>').'</div>';
	}
}


function pipdig_p3_social_footer() {
	
	$links = get_option('pipdig_links');
	
	pipdig_p3_scrapey_scrapes();
	
	$count = 0;
	$twitter_count = get_option('p3_twitter_count');
	$facebook_count = get_option('p3_facebook_count');
	$instagram_count = get_option('p3_instagram_count');
	$youtube_count = get_option('p3_youtube_count');
	$pinterest_count = get_option('p3_pinterest_count');
	$bloglovin_count = get_option('p3_bloglovin_count');
	
	if (get_theme_mod('disable_responsive')) {
		$sm = $md = 'xs';
	} else {
		$sm = 'sm';
		$md = 'md';
	}

	if ( $twitter_count )
		$count++;

	if ( $facebook_count )
		$count++;

	if ( $instagram_count )
		$count++;

	if ( $youtube_count )
		$count++;
	
	if ( $pinterest_count )
		$count++;
	
	if ( $bloglovin_count )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'col-xs-12';
			break;
		case '2':
			$class = 'col-'.$sm.'-6';
			break;
		case '3':
			$class = 'col-'.$sm.'-4';
			break;
		case '4':
			$class = 'col-'.$sm.'-3';
			break;
		case '5':
			$class = 'col-'.$sm.'-5ths';
			break;
		case '6':
			$class = 'col-'.$md.'-2';
			break;
	}

	if ( $class ) {
		$colz = 'class="' . $class . '"';
	}

	$output = '<div class="clearfix extra-footer-outer social-footer-outer">';
	$output .= '<div class="container">';
	$output .= '<div class="row social-footer">';
	
	$total_count = $twitter_count + $facebook_count + $instagram_count + $youtube_count + $bloglovin_count + $pinterest_count;
	
	if ($total_count) {
	
		if(!empty($twitter_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['twitter'].'" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i> Twitter | '.$twitter_count.'</a>';
		$output .= '</div>';
		}
		
		if(!empty($facebook_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['facebook'].'" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i> Facebook | '.$facebook_count.'</a>';
		$output .= '</div>';
		}
		
		if(!empty($instagram_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['instagram'].'" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i> Instagram | '.$instagram_count.'</a>';
		$output .= '</div>';
		}
		
		if(!empty($youtube_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['youtube'].'" target="_blank" rel="nofollow"><i class="fa fa-youtube-play"></i> YouTube | '.$youtube_count.'</a>';
		$output .= '</div>';
		}
		
		if(!empty($pinterest_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['pinterest'].'" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i> Pinterest | '.$pinterest_count.'</a>';
		$output .= '</div>';
		}
		
		if(!empty($bloglovin_count)) {
		$output .='<div '.$colz.'>';
		$output .= '<a href="'.$links['bloglovin'].'" target="_blank" rel="nofollow"><i class="fa fa-plus"></i> Bloglovin | '.$bloglovin_count.'</a>';
		$output .= '</div>';
		}
		
	}
		
	$output .= '</div>	
</div>
</div>
<style scoped>#instagramz{margin-top:0}</style>';
	
	echo $output;

}

/*
function pipdig_p3_instagram_feed() {
	//if ( false === ( $result = get_transient( 'p3_instagram_feed' ) )) {		
		$userid = '240996866';
		$accessToken = '2165912485.ee7687e.b66a7b1e71c84d30ae087f963c7a3aaa';
		$url = "https://api.instagram.com/v1/users/".$userid."/media/recent/?access_token=".$accessToken."&count=1";
		$result = wp_remote_fopen($url);
		//set_transient( 'p3_instagram_feed', $result, 1 * HOUR_IN_SECONDS );
	//}

    $result = json_decode($result);

	//print_r ($result);
	
	$img_1_src = esc_url($result->data[0]->images->standard_resolution->url);
	$img_1_lks = intval($result->data[0]->likes->count);
	$img_1_cmt = intval($result->data[0]->comments->count);
	$img_1_cap = strip_tags($result->data[0]->caption->text);
	
	echo '<img src="'.$img_1_src.'"/>';
}
*/

/* Add socialz, super search and cart to navbar -------------------------------------------------*/
if (!function_exists('add_socialz_to_menu')) { // change this check to pipdig_p3_social_navbar by Dec 2015
	function pipdig_p3_social_navbar( $items, $args ) {
		
		$navbar_icons = '';
		
		$links = get_option('pipdig_links');
		if (!empty($links)) {
			$twitter = $links['twitter'];
			$instagram = $links['instagram'];
			$facebook = $links['facebook'];
			$google = $links['google_plus'];
			$bloglovin = $links['bloglovin'];
			$pinterest = $links['pinterest'];
			$youtube = $links['youtube'];
			$tumblr = $links['tumblr'];
			$linkedin = $links['linkedin'];
			$soundcloud = $links['soundcloud'];
			$flickr = $links['flickr'];
			$email = $links['email'];
		}
		if(get_theme_mod('show_socialz_navbar')) {
			if($twitter) $navbar_icons .= '<a href="' . $twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>';
			if($instagram) $navbar_icons .= '<a href="' . $instagram . '" target="_blank"><i class="fa fa-instagram"></i></a>';
			if($facebook) $navbar_icons .= '<a href="' . $facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>';
			if($google) $navbar_icons .= '<a href="' . $google . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
			if($bloglovin) $navbar_icons .= '<a href="' . $bloglovin . '" target="_blank"><i class="fa fa-plus"></i></a>';
			if($pinterest) $navbar_icons .= '<a href="' . $pinterest . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
			if($youtube) $navbar_icons .= '<a href="' . $youtube . '" target="_blank"><i class="fa fa-youtube-play"></i></a>';
			if($tumblr) $navbar_icons .= '<a href="' . $tumblr . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
			if($linkedin) $navbar_icons .= '<a href="' . $linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
			if($soundcloud) $navbar_icons .= '<a href="' . $soundcloud . '" target="_blank"><i class="fa fa-soundcloud"></i></a>';
			if($flickr) $navbar_icons .= '<a href="' . $flickr . '" target="_blank"><i class="fa fa-flickr"></i></a>';
			if($email) $navbar_icons .= '<a href="mailto:' . $email . '" target="_blank"><i class="fa fa-envelope"></i></a>';
		}
		
		if(get_theme_mod('site_top_search')) $navbar_icons .= '<a class="toggle-search" href="#"><i class="fa fa-search"></i></a>';
		
		if (class_exists('Woocommerce')) {
			global $woocommerce;
			$navbar_icons .= '<a href="' . $woocommerce->cart->get_cart_url() . '" rel="nofollow"><i class="fa fa-shopping-cart"></i></a>';
		}
		
		if( $args->theme_location == 'primary' ) {
			return $items.'<li class="socialz top-socialz">' . $navbar_icons . '</li>';
		}
		return $items;
	}
	add_filter('wp_nav_menu_items','pipdig_p3_social_navbar', 10, 2);
}

	