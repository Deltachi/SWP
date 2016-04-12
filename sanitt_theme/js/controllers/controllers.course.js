angular.module('controllers.course',[])

// #####################
// CONTROLLER
// IT-Schulungen Ctrl
// description:
// Manages animations and data toggling of modules and
// processes and controls the registration for courses
// #####################

.controller('courseCtrl', ['$scope','$http',function($scope, $http){
	jQuery(function($) {
		// Liste aller verfügbaren Kurse
		$scope.activeTopic = "Adobe";
		$scope.courses = [];
		$http({
			method: 'GET',
			url: '/json/it-schulungen/courses.json'
			}).then(function successCallback(response) {
				$scope.courses = response.data;
			}, function errorCallback(response) {
				console.log(response);
			});

		// Aktive Anmeldedaten
		$scope.register_data = {
			"course_data":{
				"topic":"",
				"name":""
			},
			"course_members":[],
			"course_type":"business",
			"customer":{},
			"billing":{}
		};
		// Vorlage Wunschschulungsantrag
		$scope.request_data = {
			"course_data":{
				"topic":"",
				"name":""
			},
			"course_members":1,
			"course_type":"business",
			"customer":{},
			"billing":{}
		};

		// ###############
		// toggleCollapse()
		// @id:DOM selector div:id -> id of the whole div element containing the list and description
		// @description: 	Toggles the class "collapsed" of the given div:id -> button and div(list container) 
		// 					CSS collapses / expands the element
		$scope.toggleCollapse = function(id){
			$button = $('#'+id+ ' .collapse-btn');
			$list = $('#'+id+ ' .collapseable');

			//if button is deactivated -> deactivate all other before activating the new one
			if($button.hasClass('collapsed')){
				//collapse all other lists before enrolling a collapsed list
				$('.collapse-btn, .collapseable').addClass('collapsed');
			}
			//else and default toggle active button and list				
			
			$button.toggleClass('collapsed');
			$list.toggleClass('collapsed');
		};

		// ###########
		// openForm() for Courses
		// @activeTopic:String -> activeTopic points at an id of $scope.courses[activeTopic] --> json object containing all course data
		// @description: 	Animates in the overlay-form and de-activates scrolling of the main content
		// 					Fills in register_data with:
		// 					@$scope.register_data.course_data.name = course name : String
		// 					@$scope.register_data.course_data.topic = topic name (superior course name) : String
		$scope.openForm = function(activeTopic, activeCourse){
			$body = $('body');
			$form_window = $('#register-window');
			$form_parent = $('#register-container');
			$scope.activeTopic = activeTopic;
			$confirmation_parent = $('#confirmation-container, #confirmation-container-request'); //both confirmation windows at once

			// Adding data to register_data for registration
			$scope.register_data.course_data.topic = $scope.courses[activeTopic].name;
			$scope.register_data.course_data.name = $scope.courses[activeTopic].list[activeCourse].name;
			console.log($scope.courses[activeTopic].list[activeCourse]);
			console.log($scope.register_data.course_data.name);

			//Abdunkeln, dann hineinfliegen (Animation des Anmeldefensters) 
			var animate_in = new TimelineMax()
			.set($confirmation_parent, {display:'none', opacity:0})
			.to($form_window, 0.5, {display: 'inline', opacity:1, xPercent:0, ease: Power1.easeInOut})
			.fromTo($form_parent, 0.5, {xPercent:110}, {display: 'inherit', opacity:1, xPercent:0, ease: Back.easeOut});
			// Ende der Animation
			// Scrollen der Hauptseite (im Hintergrund) verhindern
			$body.addClass('noscroll');
		};

		// ###########
		// openRequest() for requesting a course
		// @description: 	Animates in the overlay-form and de-activates scrolling of the main content
		$scope.openRequest = function(){
			$body = $('body');
			$form_window = $('#request-course-window');
			$form_parent = $('#request-course-container');
			$confirmation_parent = $('#confirmation-container, #confirmation-container-request'); //both confirmation windows at once

			//Abdunkeln, dann hineinfliegen (Animation des Anmeldefensters) 
			var animate_in = new TimelineMax()
			.set($confirmation_parent, {display:'none', opacity:0})
			.to($form_window, 0.5, {display: 'inline', opacity:1, xPercent:0, ease: Power1.easeInOut})
			.fromTo($form_parent, 0.5, {xPercent:110}, {display: 'inherit', opacity:1, xPercent:0, ease: Back.easeOut});
			// Ende der Animation
			// Scrollen der Hauptseite (im Hintergrund) verhindern
			$body.addClass('noscroll');
		};
		
		// ###########
		// resetForm()
		// @form_window_id:DOM id selector -> Window to be closed
		// @description: 	Animates out the overlay-form and re-activates scrolling of the main content
		$scope.resetForm = function(form_window_id){
			$body = $('body');
			$form_window = $(form_window_id);
			$confirmation_parent = $('#confirmation-container, #confirmation-container-request');

			//Abdunkeln, dann hineinfliegen (Animation des Anmeldefensters) 
			var animate_out = new TimelineMax()
			.to($confirmation_parent, 1, {display: 'none', opacity:0, yPercent:100, ease: Back.easeIn})
			.to($form_window, 0.5, {display: 'none', opacity:0, xPercent:0, ease: Power1.easeInOut},"-=0.5");
			// Ende der Animation
			// Scrollen der Hauptseite erlauben
			$body.removeClass('noscroll');
		};

		// ###########
		// submitForm()
		// @validation:boolean -> validation variable of the form that called this function
		// @description: 	Animates in the confirmation-overlay if the validation variable==TRUE,
		// 					data handler for register_data.
		$scope.submitForm = function(validation){
			$body = $('body');
			$form_parent = $('#register-container');
			$confirmation_parent = $('#confirmation-container'); //both confirmation windows at once

			console.log("check data..");
			if (validation){
				if ($scope.register_data.alternative_billing == false) {$scope.register_data.billing = $scope.register_data.customer};
				console.log('Data input accepted. Data package:');
				// alert("Returned data: \n"+JSON.stringify($scope.register_data, null, 2));
				// HIER DATA HANDLER
				$post_data = $scope.register_data;
				postData = {};
				postData["Test"] = "My Name";
				console.log($post_data);
				// $http({
				// 	method: 'GET',
				// 	url: wp_templateUrl + '/175398426/factory/course_request',
				// 	data: $post_data
				// 	}).then(function successCallback(response) {
				// 		console.log('The AJAX response:')
				// 		console.log(response.data);
				// 	}, function errorCallback(response) {
				// 		console.log(response);
				// 	});

				$.ajax({
							type: "POST",
							async: false,
							url: wp_templateUrl + '/175398426/factory/course_request',
							data: postData, // serializes the form's elements.
							success: function(response){
				  				console.log("Successful service request: updateItemSync");
				  				console.log(response+ " rows where affected");
				  				// var responseData;
								// alert(response); // show response from the php script.
								// console.log(response);
								// responseData = jQuery.parseJSON(response);
								// console.log(responseData);

								
							},
							error: function(jqXHR, status, errors){
								console.log("Error service request");
								console.log(status);
							}
						});

				//Hinausfliegen der Anmeldung, dann hineinfliegen (Animation der Bestätigung) 
				var animate_in = new TimelineMax()
				.to($form_parent, 0.5, {display:'none', opacity:0, ease: Power3.easeOut})
				.fromTo($confirmation_parent, 1.2, {opacity:1, yPercent:60, xPercent:-50}, {display: 'inline', opacity:1,xPercent:-50, yPercent:-50, ease: Back.easeOut});
			}else{
				console.log($scope.register_data);
				alert("Invalid / incomplete data: \n"+JSON.stringify($scope.register_data, null, 2));
			}
		}
		// ###########
		// submitForm()
		// @validation:boolean -> validation variable of the form that called this function
		// @description: 	Animates in the confirmation-overlay if the validation variable==TRUE,
		// 					data handler for register_data.
		$scope.submitFormRequest = function(validation){
			$body = $('body');
			$form_parent = $('#request-course-container');
			$confirmation_parent = $('#confirmation-container-request'); //both confirmation windows at once

			console.log("check data..");
			if (validation){
				if ($scope.register_data.alternative_billing == false) {$scope.register_data.billing = $scope.register_data.customer};
				console.log($scope.request_data);
				// alert("Returned data: \n"+JSON.stringify($scope.register_data, null, 2));
				// HIER DATA HANDLER

				//Hinausfliegen der Anmeldung, dann hineinfliegen (Animation der Bestätigung) 
				var animate_in = new TimelineMax()
				.to($form_parent, 0.5, {display:'none', opacity:0, ease: Power3.easeOut})
				.fromTo($confirmation_parent, 1.2, {opacity:1, yPercent:60, xPercent:-50}, {display: 'inline', opacity:1,xPercent:-50, yPercent:-50, ease: Back.easeOut});
			}else{
				console.log($scope.register_data);
				alert("Invalid / incomplete data: \n"+JSON.stringify($scope.register_data, null, 2));
			}
		}
		console.debug("course controller loaded!");
	});
}])