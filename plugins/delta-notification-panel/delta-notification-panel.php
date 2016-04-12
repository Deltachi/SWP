<?php
/**
* Plugin Name: Timed Notification Panels
* Plugin URI: http://deltachi.de/notification_panels
* Description: Create a panel with heading, body and a button that can be programmed with javascript. Choose a color and set a timer for the whole panel to animate-in.
* Version: 1.0 
* Author: Dominik Scheffler
* Author URI: http://deltachi.de/
* License: GPL12
*/

//#################################################################
// Creating the Notification widget 
//#################################################################
class wp_timed_notification_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'wp_timed_notification_widget', 

		// Widget name will appear in UI
		__('Timed Notification Widget', 'wp_timed_notification_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Panel with heading, body and a button. Choose a color and set an animation timer.', 'wp_timed_notification_widget_domain' ), ) 
		);
		//loads colorpicker API css and js
		add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
	}
	function my_custom_load() {    
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );    
    }
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = apply_filters( 'widget_subtitle', $instance['subtitle'] );
		$button_text = apply_filters( 'widget_button_text', $instance['button_text'] );
		$javascript_text = $instance['javascript_text'];
		$background_color = $instance['background_color'];
		$delay_time = $instance['delay_time'];
		$plugin_url = plugin_dir_url( __FILE__ );
		// $textarea = $instance['textarea'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo '
					<article class="green slide-in" style="overflow: hidden; background-color:'; echo $background_color; echo ';">
						<div class="container">
							<div class="col-sm-7" style="padding-left: 40px;">
								<h2>'; echo $title; echo '</h2>
								<p>'; echo $subtitle; echo '</p>
							</div>
							<div class="col-sm-5" style="text-align: center;">
								<button id="send-application" class="apply-btn">'; echo $button_text; echo '</button>
							</div>
						</div>
					</article>
					<script type="text/javascript">
			            jQuery(document).ready(function($) {
			            	//Animation
			                var slideIn_tween = new TweenMax.from(".slide-in", 2, {maxHeight:0, padding:0, ease: Power3.easeInOut, delay:'; echo $delay_time; echo '});
			                //Click Funktion
			                $("#send-application").click(function() {
			';
			echo $javascript_text;
			echo '
							});
			            });
			        </script>
		';

		// //Click Funktion
		// 					var email = "initiativbewerbung@sanitt.de";
		// 					var subject = "Initiativbewerbung";
		// 					$("#send-application").click(function() {
		// 						var mailto_link = "mailto:" + email + "?subject=" + subject;  //+ "&body=" + body_message
		// 						win = window.open(mailto_link, "emailWindow");
		// 						if (win && win.open && !win.closed) win.close();
		// 					});

		//echo $javascript_text;

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'New title', 'wp_timed_notification_widget_domain' );
		$subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : __( 'New subtitle', 'wp_timed_notification_widget_domain' );
		$button_text = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : __( 'New button_text', 'wp_timed_notification_widget_domain' );
		$javascript_text = isset( $instance['javascript_text'] ) ? esc_attr( $instance['javascript_text'] ) : __( '//Click Funktion
							var email = "initiativbewerbung@sanitt.de";
							var subject = "Initiativbewerbung";
							$("#send-application").click(function() {
								var mailto_link = "mailto:" + email + "?subject=" + subject;  //+ "&body=" + body_message
								win = window.open(mailto_link, "emailWindow");
								if (win && win.open && !win.closed) win.close();
							});', 'wp_timed_notification_widget_domain' );
		$background_color = isset( $instance['background_color'] ) ? esc_attr( $instance['background_color'] ) : __( '#e3e3e3', 'wp_timed_notification_widget_domain' );
		$delay_time = isset( $instance['delay_time'] ) ? esc_attr( $instance['delay_time'] ) : __( '4', 'wp_timed_notification_widget_domain' );
		// $textarea = isset( $instance['textarea'] ) ? esc_attr( $instance['textarea'] ) : __( 'New textarea', 'wp_timed_notification_widget_domain' );
		
		// Widget admin form
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.my-color-picker').wpColorPicker();
            });
        </script>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'javascript_text' ); ?>"><?php _e( 'Button Javascript:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'javascript_text' ); ?>" name="<?php echo $this->get_field_name( 'javascript_text' ); ?>"><?php echo $javascript_text; ?></textarea>
		</p>
		<p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color' ); ?></label><br>
            <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo $background_color; ?>" />                            
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'delay_time' ); ?>"><?php _e( 'Delay Time (in seconds):' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'delay_time' ); ?>" name="<?php echo $this->get_field_name( 'delay_time' ); ?>" type="number" value="<?php echo $delay_time; ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
		$instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';
		$instance['background_color'] = ( ! empty( $new_instance['background_color'] ) ) ? strip_tags( $new_instance['background_color'] ) : '';
		$instance['javascript_text'] = ( ! empty( $new_instance['javascript_text'] ) ) ? strip_tags( $new_instance['javascript_text'] ) : '';
		$instance['delay_time'] = ( ! empty( $new_instance['delay_time'] ) ) ? strip_tags( $new_instance['delay_time'] ) : '';
		return $instance;
	}
} // Class wp_timed_notification_widget ends here



// Register and load the widget
function wp_timed_notifications_load_widgets() {
	register_widget( 'wp_timed_notification_widget' );
}
add_action( 'widgets_init', 'wp_timed_notifications_load_widgets' );

function wp_timed_notifications_load_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'delta-notification-panel', plugins_url( '/css/delta-notification-panel.css', __FILE__ ), array(), '20120208', 'all' );
    // or
    // Register the style like this for a theme:
    // wp_register_style( 'custom-styles', get_template_directory_uri() . '/css/custom-styles.css', array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'delta-notification-panel' );
}
add_action( 'wp_enqueue_scripts', 'wp_timed_notifications_load_styles' );

/* Stop Adding Functions Below this Line */
?>