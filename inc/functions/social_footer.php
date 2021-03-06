<?php

if (!defined('ABSPATH')) die;

function pipdig_p3_social_footer() {
	
	$links = get_option('pipdig_links');
	
	pipdig_p3_scrapey_scrapes();
	
	$count = 0;
	$twitter_count = absint(get_option('p3_twitter_count'));
	$facebook_count = absint(get_option('p3_facebook_count'));
	$instagram_count = absint(get_option('p3_instagram_count'));
	$youtube_count = absint(get_option('p3_youtube_count'));
	$pinterest_count = absint(get_option('p3_pinterest_count'));
	$bloglovin_count = absint(get_option('p3_bloglovin_count'));
	
	if (get_theme_mod('disable_responsive')) {
		$sm = $md = 'xs';
	} else {
		$sm = 'sm';
		$md = 'md';
	}

	if ($twitter_count) {
		$count++;
	}
	
	if ($facebook_count) {
		$count++;
	}
	
	if ($instagram_count) {
		$count++;
	}
	
	if ($youtube_count) {
		$count++;
	}
	
	if ($pinterest_count) {
		$count++;
	}
	
	if ($bloglovin_count) {
		$count++;
	}
	
	$class = $colz = '';

	switch ($count) {
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

	if ($class) {
		$colz = 'class="'.$class.'"';
	}

	$output = '<div class="clearfix extra-footer-outer social-footer-outer">';
	$output .= '<div class="container">';
	$output .= '<div class="row social-footer">';
	
	$total_count = $twitter_count + $facebook_count + $instagram_count + $youtube_count + $bloglovin_count + $pinterest_count;
	
	if ($total_count) {
	
		if (!empty($twitter_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['twitter']).'" target="_blank" rel="nofollow noopener" aria-label="Twitter" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter<span class="social-footer-counters"> | '.$twitter_count.'</span></a>';
			$output .= '</div>';
		}
		
		if(!empty($instagram_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['instagram']).'" target="_blank" rel="nofollow noopener" aria-label="Instagram" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram<span class="social-footer-counters"> | '.$instagram_count.'</span></a>';
			$output .= '</div>';
		}
		
		if(!empty($facebook_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['facebook']).'" target="_blank" rel="nofollow noopener" aria-label="Facebook" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook<span class="social-footer-counters"> | '.$facebook_count.'</span></a>';
			$output .= '</div>';
		}
		
		if(!empty($pinterest_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['pinterest']).'" target="_blank" rel="nofollow noopener" aria-label="Pinterest" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest<span class="social-footer-counters"> | '.$pinterest_count.'</span></a>';
			$output .= '</div>';
		}
		
		if(!empty($youtube_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['youtube']).'" target="_blank" rel="nofollow noopener" aria-label="YouTube" title="YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i> YouTube<span class="social-footer-counters"> | '.$youtube_count.'</span></a>';
			$output .= '</div>';
		}
		
		if(!empty($bloglovin_count)) {
			$output .='<div '.$colz.'>';
			$output .= '<a href="'.esc_url($links['bloglovin']).'" target="_blank" rel="nofollow noopener" aria-label="Bloglovin" title="Bloglovin"><i class="fa fa-plus" aria-hidden="true"></i> Bloglovin<span class="social-footer-counters"> | '.$bloglovin_count.'</span></a>';
			$output .= '</div>';
		}
		
	}
		
	$output .= '</div>	
</div>
</div>
<style scoped>#instagramz{margin-top:0}</style>';
	
	echo $output;

}