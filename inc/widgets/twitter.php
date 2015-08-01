<?php 
if ( !class_exists( 'pipdig_widget_twitter' ) ) {
	class pipdig_widget_twitter extends WP_Widget {
	 
	  public function __construct() {
		  $widget_ops = array('classname' => 'pipdig_widget_twitter', 'description' => __('Displays your latest Tweets.', 'pipdig-power-pack') );
		  $this->WP_Widget('pipdig_widget_twitter', 'pipdig - ' . __('Twitter Widget', 'pipdig-power-pack'), $widget_ops);
	  }
	  
	  function widget($args, $instance) {
		// PART 1: Extracting the arguments + getting the values
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['twitter_handle'])) { 
			$twitter_handle =	$instance['twitter_handle'];
		}

		// Before widget code, if any
		echo (isset($before_widget)?$before_widget:'');
	   
		// PART 2: The title and the text output
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		} else {
			echo $before_title . 'Twitter' . $after_title;
		}

		if (!empty($twitter_handle)) { ?>

			<?php
			$tweets = getTweets(2, $twitter_handle, array('exclude_replies' => true, 'include_rts' => false));
			if (!empty($tweets)) {
				foreach($tweets as $tweet){
					$tweet_text = $tweet['text'];
					$tweet_text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="nofollow">$1</a>', $tweet_text);
					$pattern = '/@([a-zA-Z0-9_]+)/';
					$replace = '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">@$1</a>';
					$tweet_text = preg_replace($pattern, $replace, $tweet_text);
					$pattern = '/#([a-zA-Z0-9_]+)/';
					$replace = '<a href="http://twitter.com/hashtag/$1" target="_blank" rel="nofollow">#$1</a>';
					$tweet_text = preg_replace($pattern, $replace, $tweet_text);
					// tweets looped into markup below:
					?>
					<p><?php echo $tweet_text; ?></p>
					<?php 
				}
			}
			?>

		<?php
		} else {
			_e('Setup not complete. Please add your Twitter username to the Twitter Widget in the dashboard.', 'pipdig-power-pack');
		}
		// After widget code, if any  
		echo (isset($after_widget)?$after_widget:'');
	  }
	 
	  public function form( $instance ) {
	   
		 // PART 1: Extract the data from the instance variable
		 $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		 $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['twitter_handle'])) { 
			$twitter_handle =	$instance['twitter_handle'];
		}
	   
		 // PART 2-3: Display the fields
		 ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'pipdig-power-pack'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
			name="<?php echo $this->get_field_name('title'); ?>" type="text" 
			value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>

		<p><?php _e('You will need to setup your Twitter account details on <a href="' . admin_url( 'options-general.php?page=tdf_settings' ) . '">this page</a> first.', 'pipdig-power-pack'); ?></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_handle'); ?>"><?php _e('Twitter Username:', 'pipdig-power-pack'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_handle'); ?>" 
			name="<?php echo $this->get_field_name('twitter_handle'); ?>" type="text" 
			value="<?php if (isset($instance['twitter_handle'])) { echo esc_attr($twitter_handle); } ?>" placeholder="e.g. ladygaga" />
			</label>
		</p>

		 <?php
	   
	  }
	 
	  function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_handle'] = strip_tags( $new_instance['twitter_handle'] );

		return $instance;
	  }
	  
	}
	//add_action( 'widgets_init', create_function('', 'return register_widget("pipdig_widget_twitter");') );
} // end class exists check