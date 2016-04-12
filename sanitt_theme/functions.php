<?php 

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'bootstrapjs-script', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'bootstrapjs-script' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css' );
	

	wp_enqueue_style( 'jqueryUI-css', 'http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );
	wp_register_script( 'jqueryUI-script', 'http://code.jquery.com/ui/1.11.4/jquery-ui.js', array(), null, false);
	wp_enqueue_script( 'jqueryUI-script' );
}
function wp_gsap_and_scrollmagic(){
	// wp_enqueue_script( 'gsap-js', 'http://cdnjs.cloudflare.com/ajax/libs/gsap/1.13.2/TweenMax.min.js', array(), false, false );

	// Greensock
	wp_register_script( 'TweenMaxMin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js', array(), null, false);
	wp_enqueue_script( 'TweenMaxMin' );
							
	//wp_deregister_script( 'ScrollMagic' );
	wp_register_script( 'ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array('TweenMaxMin', 'jquery'), null, false);
	wp_enqueue_script( 'ScrollMagic' );
			
	//wp_deregister_script( 'animationGsap' );
	wp_register_script( 'animationGsap', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js', array(), null, false);
	wp_enqueue_script( 'animationGsap' );
			
	//wp_deregister_script( 'debugAddIndicators' );
	wp_register_script( 'debugAddIndicators', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array(), null, false);
	wp_enqueue_script( 'debugAddIndicators' );
}
function wp_angular_js()
{
	//ANGULAR CORE
	wp_enqueue_script('angular-core', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.js', array('jquery'), null, false);
	wp_enqueue_script('angular-route', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.min.js', array('angular-core'), null, false);
	wp_enqueue_script('angular-resource', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-resource.min.js', array('angular-route'), null, false);

	// MY ANGULAR APP
	wp_enqueue_script('angular-app',  			get_template_directory_uri().'/js/app.js', 							array('angular-resource'), null, false);
	wp_enqueue_script('angular-directives',  	get_template_directory_uri().'/js/directives/directives.main.js', 	array('angular-app'), null, false);
	// wp_enqueue_script('angular-routes',  get_template_directory_uri().'/js/angular-routes.js', array('angular-app'), null, false);
	// wp_enqueue_script('angular-factories',  get_template_directory_uri().'/js/angular-factories.js', array('angular-app'), null, false);

	// ANGULAR CONTROLLERS
	wp_enqueue_script( 'angular-main',  		get_template_directory_uri().'/js/controllers/controllers.main.js', 		array('angular-app'), null, false);
	wp_enqueue_script( 'angular-animation', 	get_template_directory_uri().'/js/controllers/controllers.animation.js', 	array('angular-app'), null, false);
	wp_enqueue_script( 'angular-contact',  		get_template_directory_uri().'/js/controllers/controllers.contact.js', 		array('angular-app'), null, false);
	wp_enqueue_script( 'angular-course',  		get_template_directory_uri().'/js/controllers/controllers.course.js', 		array('angular-app'), null, false);
	wp_enqueue_script( 'angular-fixed-navbar',  get_template_directory_uri().'/js/controllers/controllers.fixed-navbar.js', array('angular-app'), null, false);
	wp_enqueue_script( 'angular-header',  		get_template_directory_uri().'/js/controllers/controllers.header.js', 		array('angular-app'), null, false);
	wp_enqueue_script( 'angular-logo',  		get_template_directory_uri().'/js/controllers/controllers.logo.js', 		array('angular-app'), null, false);
	wp_enqueue_script( 'angular-pz',  			get_template_directory_uri().'/js/controllers/controllers.pz.js', 			array('angular-app'), null, false);
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
add_action( 'wp_enqueue_scripts', 'wp_gsap_and_scrollmagic' );
add_action( 'wp_enqueue_scripts', 'wp_angular_js' );

?>