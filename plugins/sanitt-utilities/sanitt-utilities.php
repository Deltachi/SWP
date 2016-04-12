<?php
/**
* Plugin Name: SANITT Utilities | Flipcards and Panels
* Plugin URI: http://deltachi.de/sanitt_utilities
* Description: [This Utility Package contains:] Flipcards: Information Card with an front-sided image + sub-heading and a description on the backside. The card flips on hovering. (CSS animated) Panels: Stylized Information Panels for quick and easy editing. 
* Version: 1.1 
* Author: Dominik Scheffler
* Author URI: http://deltachi.de/
* License: GPL12
*/

//#################################################################
// Creating the Flipcard widget 
//#################################################################
class wp_flipcards_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'wp_flipcards_widget', 

		// Widget name will appear in UI
		__('Flipcard Widget', 'wp_flipcards_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Information card that flips on hovering. Front contains an image plus sub-heading, backside contains a description', 'wp_flipcards_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];
		$icon_selection = $instance['icon_selection'];
		$link = $instance['link'];
		$plugin_url = plugin_dir_url( __FILE__ );
		// $textarea = $instance['textarea'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo '
					<a href="
		';

		echo $link; 

		echo'" class="col-md-4 col-sm-6 col-xs-12 card">
						<div class="back">
							<p>
		';
		echo $description;
		//Sie möchten, dass Ihre IT-Trainingsmaßnahmen oder IT-Schulungsprojekte mit kompetenten und praxisorientierten IT-Trainern erfolgreich umgesetzt werden?
		echo '
							</p>
						</div>
						<div class="front">
							<img src="
		';
		if ($icon_selection == "Avatar"){echo $plugin_url . '/images/avatar';}
		if ($icon_selection == "Computer"){echo $plugin_url . '/images/computer';}
		if ($icon_selection == "Hantel"){echo $plugin_url . '/images/hantel';}
		if ($icon_selection == "Klammern"){echo $plugin_url . '/images/klammern';}
		if ($icon_selection == "Papier"){echo $plugin_url . '/images/paper';}
		if ($icon_selection == "Pfeil"){echo $plugin_url . '/images/pfeil';}
		echo '
							.svg" alt="icon" class="icon">
							<h3>
		';
		echo $title;
		//IT - Training
		echo '
							</h3>
						</div>
					</a>
		';

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'New title', 'wp_flipcards_widget_domain' );
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : __( 'New description', 'wp_flipcards_widget_domain' );
		$icon_selection = isset( $instance['icon_selection'] ) ? esc_attr( $instance['icon_selection'] ) : __( 'Avatar', 'wp_flipcards_widget_domain' );
		$link = isset( $instance['link'] ) ? esc_attr( $instance['link'] ) : __( '#', 'wp_flipcards_widget_domain' );
		// $textarea = isset( $instance['textarea'] ) ? esc_attr( $instance['textarea'] ) : __( 'New textarea', 'wp_flipcards_widget_domain' );
		
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '(Front) Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( '(Backside) Text:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
		</p>
		<!-- <p>
			<label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e('This is a textarea:'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>"><?php echo $textarea; ?></textarea>
		</p> -->
		<p>
			<label for="<?php echo $this->get_field_id('icon_selection'); ?>"><?php _e('This is a icon_selection menu'); ?></label>
			<select name="<?php echo $this->get_field_name('icon_selection'); ?>" id="<?php echo $this->get_field_id('icon_selection'); ?>" class="widefat">
			    <?php
			    $options = array('Avatar','Computer','Hantel','Klammern','Papier','Pfeil');
			    foreach ($options as $option) {
			        echo '<option value="' . $option . '" id="' . $option . '"', $icon_selection == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			    }
			    ?>
			</select>
	    </p>
	    <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['icon_selection'] = ( ! empty( $new_instance['icon_selection'] ) ) ? strip_tags( $new_instance['icon_selection'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		// $instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';
		return $instance;
	}
} // Class wp_flipcards_widget ends here


//#################################################################
// Creating the Panel widget 
//#################################################################
class wp_customPanels_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'wp_customPanels_widget', 

		// Widget name will appear in UI
		__('Sanitt Project Panels Widget', 'wp_customPanels_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Display Panel for Reference-Projects', 'wp_customPanels_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];
		$branche = $instance['branche'];
		$technologien = $instance['technologien'];
		$plugin_url = plugin_dir_url( __FILE__ );
		// $textarea = $instance['textarea'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo '
					<div class="col-sm-12 referenz-modul">
						<div class="col-sm-12">
							<h3><strong>
		';
		echo $title;
		echo '
							</strong></h3>
						</div>
						<div class="col-sm-4">
							<p>
								<strong>Branche:</strong> 
		';
		echo $branche;
		echo '
							</p>
							<p>
								<strong>Technologien:</strong>
		';
		echo $technologien;
		echo '
							</p>
						</div>
						<div class="col-sm-8">
							<p>
		';
		echo $description;
		echo '
							</p>
						</div>
					</div> <!-- .referenz-modul -->
		';

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'New title', 'wp_customPanels_widget_domain' );
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : __( 'Neue Beschreibung', 'wp_customPanels_widget_domain' );
		$branche = isset( $instance['branche'] ) ? esc_attr( $instance['branche'] ) : __( 'Neue Branche', 'wp_customPanels_widget_domain' );
		$technologien = isset( $instance['technologien'] ) ? esc_attr( $instance['technologien'] ) : __( 'Neue Technologien', 'wp_customPanels_widget_domain' );
		
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'branche' ); ?>"><?php _e( 'Branche:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'branche' ); ?>" name="<?php echo $this->get_field_name( 'branche' ); ?>" type="text" value="<?php echo $branche; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'technologien' ); ?>"><?php _e( 'Technologien:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'technologien' ); ?>" name="<?php echo $this->get_field_name( 'technologien' ); ?>" type="text" value="<?php echo $technologien; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Text:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['branche'] = ( ! empty( $new_instance['branche'] ) ) ? strip_tags( $new_instance['branche'] ) : '';
		$instance['technologien'] = ( ! empty( $new_instance['technologien'] ) ) ? strip_tags( $new_instance['technologien'] ) : '';
		return $instance;
	}
} // Class wp_customPanels_widget ends here



//#################################################################
// Creating the IT-Schulungen widget 
//#################################################################
class wp_it_schulungen_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'wp_it_schulungen_widget', 

		// Widget name will appear in UI
		__('Sanitt IT-Schulungen Loader Widget', 'wp_it_schulungen_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Loads active IT-Courses from a JSON file', 'wp_it_schulungen_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// $description = $instance['description'];
		// $branche = $instance['branche'];
		// $technologien = $instance['technologien'];
		$plugin_url = plugin_dir_url( __FILE__ );
		// $textarea = $instance['textarea'];
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo '
			<section ng-controller="courseCtrl">
				<div class="container">
					<!-- Template for courses created for angular repeat function -->
					<div ng-repeat="course in courses" id="{{course.id}}" class="col-md-12">
						<button class="collapse-btn" ng-class="{collapsed:!$first}" ng-click="toggleCollapse(course.id);"><strong>{{course.name}}</strong> Schulungen <img class="glyphicon" src="images/icons/chevron_down.svg" alt=""></button>
						<p class="text-muted" style="padding-top: 10px;"><small>{{course.description}}</small></p>
						<div class="collapseable" ng-class="{collapsed:!$first}">
							<ng-form name="form_{{course.id}}" action="submit">
								<div class="list col-md-4 col-sm-4">
									<h3>Wählen Sie einen Kurs:</h3>
									<ul style="list-style: none;">
										<li ng-repeat="item in course.list">
											<label for="{{course.id}}-{{$index}}">
												<input id="{{course.id}}-{{$index}}" type="radio" ng-model="$parent.course.active" name="{{course.id}}-selected" ng-value="$index">
												{{item.name}}<br>
											</label>	
										</li>
									</ul>
								</div>
								<div class="details col-md-8 col-sm-8">
									<div class="col-md-12">
										<h2>{{course.list[course.active].name}}</h2>
									</div>
									<div class="details col-md-5 col-sm-5">
										<div class="card"  style="background-color: {{course.list[course.active].color}}">
											<h1 style="color:white; position: absolute; margin: 0; padding: 0; font-size: 330%; font-weight: 700; top:50%; left:50%; transform: translate(-50%,-50%);">
												<strong>{{course.list[course.active].shortcut}}</strong>
											</h1>
										</div>
									</div>
									<div class="details col-md-7 col-sm-7">
										<p>Sie haben <strong>{{course.list[course.active].name}}</strong> als Kurs ausgewählt.</p>
										<p class="text-muted">
											<small>{{course.list[course.active].details}}</small>
										</p>
									</div>
								</div>
								<input type="submit" class="submit" value="ANMELDEN" ng-click="openForm(course.name, course.active);">
							</ng-form>
						</div>
						<hr>
					</div>
				</div>
				<div id="caution1" class="container">
					<div class="caution animate col-md-12" style="margin-top: 25px; border: 1px solid rgb(200,200,200); background-color: rgb(230,230,230); border-radius: 8px; padding: 15px; text-align: center;">
						<div><strong>Haben Sie nichts passendes gefunden?</strong> Gerne unterbreiten wir Ihnen ein Angebot zu Ihrem firmenindividuellen Seminar oder Einzelschulung. <br> Schicken Sie uns doch eine <button ng-click="openRequest();">Angebotsanfrage</button> .</div> 
						
					</div>
				</div>
				<!-- OVERLAY Formulare die eingeblendet werden, sobald der User auf einen der Anmeldebuttons klickt -->
				<formular-course-default></formular-course-default>
				<formular-course-request></formular-course-request>
			</section>
		';

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'New title', 'wp_it_schulungen_widget_domain' );
		// $description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : __( 'Neue Beschreibung', 'wp_it_schulungen_widget_domain' );
		// $branche = isset( $instance['branche'] ) ? esc_attr( $instance['branche'] ) : __( 'Neue Branche', 'wp_it_schulungen_widget_domain' );
		// $technologien = isset( $instance['technologien'] ) ? esc_attr( $instance['technologien'] ) : __( 'Neue Technologien', 'wp_it_schulungen_widget_domain' );
		
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<hr>
		<h3>Benutzung:</h3>
		<p>
			Damit das Widget die Daten zum Anzeigen laden kann, stellen Sie sicher, dass die courses.json Datei sich in <code>ROOT/json/it-schulungen/courses.json</code> befindet.
		</p>
		<!-- <p>
			<label for="<?php echo $this->get_field_id( 'branche' ); ?>"><?php _e( 'Branche:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'branche' ); ?>" name="<?php echo $this->get_field_name( 'branche' ); ?>" type="text" value="<?php echo $branche; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'technologien' ); ?>"><?php _e( 'Technologien:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'technologien' ); ?>" name="<?php echo $this->get_field_name( 'technologien' ); ?>" type="text" value="<?php echo $technologien; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Text:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
		</p> -->
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		// $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		// $instance['branche'] = ( ! empty( $new_instance['branche'] ) ) ? strip_tags( $new_instance['branche'] ) : '';
		// $instance['technologien'] = ( ! empty( $new_instance['technologien'] ) ) ? strip_tags( $new_instance['technologien'] ) : '';
		return $instance;
	}
} // Class wp_it_schulungen_widget ends here



// Register and load the widget
function wp_sanittUtilities_load_widgets() {
	register_widget( 'wp_flipcards_widget' );
	register_widget( 'wp_customPanels_widget' );
	register_widget( 'wp_it_schulungen_widget' );
}
add_action( 'widgets_init', 'wp_sanittUtilities_load_widgets' );

function wp_sanittUtilities_load_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'flipcard-styles', plugins_url( '/css/delta-flipcards.css', __FILE__ ), array(), '20120208', 'all' );
    wp_register_style( 'panel-styles', plugins_url( '/css/delta-panels.css', __FILE__ ), array(), '20120208', 'all' );
    wp_register_style( 'schulungen-styles', plugins_url( '/css/wp_it_schulungen_widget.css', __FILE__ ), array(), '20120208', 'all' );
    // or
    // Register the style like this for a theme:
    // wp_register_style( 'custom-styles', get_template_directory_uri() . '/css/custom-styles.css', array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'flipcard-styles' );
    wp_enqueue_style( 'panel-styles' );
    wp_enqueue_style( 'schulungen-styles' );
}
add_action( 'wp_enqueue_scripts', 'wp_sanittUtilities_load_styles' );

/* Stop Adding Functions Below this Line */
?>