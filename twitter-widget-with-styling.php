<?php
/*
Plugin Name: Twitter Widget with Styling
Plugin URI: http://products.zenoweb.nl/free-wordpress-plugins/twitter-widget-styling/
Description: A Twitter Widget that is easy to configure and easy to style.
Version: 2.1.2
Author: Marcel Pol
Author URI: http://zenoweb.nl
Text Domain: twitter-widget-with-styling
Domain Path: /lang/


Copyright 2013 - 2016  Marcel Pol  (email: marcel@timelord.nl)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*
 * TODO:
 *
 */


// Plugin Version
define('TL_TWITTER_STYLE_VER', '2.1.2');


class TL_Twitter extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'tl_twitter', 'description' => __('Twitter Widget with Styling.','twitter-widget-with-styling') );
		parent::__construct('tl_twitter', __('Twitter', 'twitter-widget-with-styling'), $widget_ops);
		$this->alt_option_name = 'tl_twitter';

		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {

		// find out if the template has a stylesheet, else use the one in the plugin
		$cssfile = get_theme_root() . "/" . get_stylesheet() . '/style_twitter.css'; // local file, support childthemes
		if ( file_exists( $cssfile ) ) {
			$css = get_stylesheet_directory_uri() . '/style_twitter.css'; // URI file, support childthemes
			$css_ver = date( 'ymd-Gis', filemtime( $cssfile ) ); // Create own version codes.
			$css = $css . '?ver=' . $css_ver;
		} else {
			$css = plugins_url( '/css/style_twitter.css', __FILE__ );
		}
		// Registers Style with WordPress to wp_footer().
		wp_register_script( 'tl_twitter', plugins_url( '/js/style_twitter.js', __FILE__ ), 'jquery', TL_TWITTER_STYLE_VER, true );
		wp_enqueue_script( 'tl_twitter' );
		$dataToBePassed = array(
			'style_twitter_css' => $css
		);
		wp_localize_script( 'tl_twitter', 'tl_twitter_localize', $dataToBePassed );


		$cache = wp_cache_get('tl_twitter', 'widget');

		if ( !is_array($cache) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title  = apply_filters('widget_title', empty($instance['title']) ? 'Twitter' : $instance['title'], $instance, $this->id_base);
		$name   = $instance['name'];
		$id     = $instance['id'];
		$height = $instance['height'];
		$border = $instance['border'];


		echo $before_widget;
		if ( $title ) { echo $before_title . $title . $after_title; }

		/*
		 * Support all Timeline attributes from:
		 * https://dev.twitter.com/web/embedded-timelines#customization
		 */
		$data_aria_live   = apply_filters( 'twitter_widget_with_styling_data_aria_live', 'polite' ); // Are the Twitter docs even correct?
		$data_chrome      = apply_filters( 'twitter_widget_with_styling_data_chrome', '' );
		$data_tweet_limit = (int) apply_filters( 'twitter_widget_with_styling_data_tweet_limit', '' );
		?>

		<a class="twitter-timeline"
			data-border-color="<?php echo $border; ?>"
			height="<?php echo $height; ?>"
			data-theme="light"
			href="https://twitter.com/<?php echo $name; ?>"
			data-widget-id="<?php echo $id; ?>"
			data-aria-polite="<?php echo $data_aria_live; ?>"
			data-aria-live="<?php echo $data_aria_live; ?>"
			data-chrome="<?php echo $data_chrome; ?>"
			<?php
			if ( $data_tweet_limit ) { ?>
				data-tweet-limit="<?php echo $data_tweet_limit; ?>" <?php
			} ?>
			>
			<?php __('Tweets of', 'twitter-widget-with-styling'); ?> @<?php echo $name; ?>
		</a>

		<?php echo $after_widget; ?>

		<?php
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('tl_twitter', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']  = strip_tags($new_instance['title']);
		$instance['name']   = strip_tags($new_instance['name']);
		$instance['id']     = strip_tags($new_instance['id']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['border'] = strip_tags($new_instance['border']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['tl_twitter']) ) {
			delete_option('tl_twitter');
		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('tl_twitter', 'widget');
	}

	function form( $instance ) {
    	/*
    	 * Set Default Value for widget form
    	 */
    	$default_value = array("title"=> "Twitter", "name" => "GNU Social", "id" => "673233459108818944", "height" => 400, "border" => "#f4f4f4");
    	$instance      = wp_parse_args( (array) $instance, $default_value );

		$title = isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'twitter-widget-with-styling'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p><?php

		$name = isset($instance['name']) ? esc_attr($instance['name']) : ''; ?>
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Twitter Name', 'twitter-widget-with-styling'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p><?php

		$id = isset($instance['id']) ? esc_attr($instance['id']) : ''; ?>
		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Twitter ID', 'twitter-widget-with-styling'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p><?php

		$height = isset($instance['height']) ? esc_attr($instance['height']) : ''; ?>
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'twitter-widget-with-styling'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" /></p><?php

		$border = isset($instance['border']) ? esc_attr($instance['border']) : ''; ?>
		<p><label for="<?php echo $this->get_field_id('border'); ?>"><?php _e('Border Color', 'twitter-widget-with-styling'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('border'); ?>" name="<?php echo $this->get_field_name('border'); ?>" type="text" value="<?php echo $border; ?>" /></p><?php

	}

}


function tl_twitter_lang() {
	load_plugin_textdomain('twitter-widget-with-styling', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/');
}
add_action('plugins_loaded', 'tl_twitter_lang');


function tl_twitter() {
	register_widget('TL_Twitter');
}
add_action('widgets_init', 'tl_twitter' );
