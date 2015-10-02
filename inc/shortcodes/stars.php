<?php 

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// [stars rating="5"]
function pipdig_p3_star_rating_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'rating' => '5',
		'color' => '#fec400'
	), $atts ) );
	
	wp_enqueue_script( 'rateyo' );

	$post_id = get_the_ID();
	
	return '
	<div class="rateyo-'.$post_id.'" style="margin-top:5px;margin-bottom:10px;"></div>
	<script>
		jQuery(document).ready(function($) {
			$(".rateyo-'.$post_id.'").rateYo({
				rating: '.$rating.',
				normalFill: "#e8e8e8",
				ratedFill: "'.$color.'",
				readOnly: true
			});
		});
	</script>
	';
}
add_shortcode( 'pipdig_stars', 'pipdig_p3_star_rating_shortcode' );