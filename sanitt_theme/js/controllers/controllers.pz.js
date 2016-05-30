angular.module('controllers.pz',[])

// #####################
// CONTROLLER
// Pruefungszentrum Ctrl
// description:
// Manages animations and data toggling of modules and
// processes and controls the registration for exams
// #####################

.controller('pzCtrl', ['$scope',function($scope){
	jQuery(function($) {	
		// Active Exam variable for formular initialization
		$scope.activeExam;
		// List of "what module-details have to be open / closed" (for ng-if conditions)
		$scope.moduleDetails = {
			"CTFL_details": false,
			"CAT_details": false,
			"CAST_details": false,
			"CTAL-TM_details": false,
			"CTAL-TA_details": false,
			"CTAL-TTA_details": false
		};
		// List & Details of all exams ISTQB & ISAQB
		$scope.exams = {
			"CTFL": {
				"name":"Certified Tester Foundation Level",
				"requirements":false,
				"version":[{"name":"CTFL Deutsch","language":"german"},{"name":"CTFL English","language":"english"}]
			},
			"CAT": {
				"name":"Certified Agile Tester",
				"requirements":true,
				"version":[{"name":"CAT Deutsch","language":"german"},{"name":"CAT English","language":"english"}]
			},
			"CAST": {
				"name":"Certified Automotive Software Tester",
				"requirements":true,
				"version":[{"name":"CAST Deutsch","language":"german"},{"name":"CAST English","language":"english"}]
			},
			"CTAL-TM": {
				"name":"Certified Tester Advanced Level - Testmanager",
				"requirements":true,
				"version":[{"name":"CTAL-TM Deutsch","language":"german"},{"name":"CTAL-TM English","language":"english"}]
			},
			"CTAL-TA": {
				"name":"Certified Tester Advanced Level - Test Analyst",
				"requirements":true,
				"version":[{"name":"CTAL-TA Deutsch","language":"german"},{"name":"CTAL-TA English","language":"english"}]
			},
			"CTAL-TTA": {
				"name":"Certified Tester Advanced Level - Technical Test Analyst",
				"requirements":true,
				"version":[{"name":"CTAL-TTA Deutsch","language":"german"},{"name":"CTAL-TTA English","language":"english"}]
			},
			"CPSA-FL": {
				"name":"Certified Professional for Software Architecture - Foundation Level",
				"requirements":false,
				"version":[{"name":"CPSA-FL Deutsch","language":"german"}]
			}
		};
		// ###############
		// toggleDetails()
		// @module:String -> module points at an id of $scope.moduleDetails
		// @description: 	Toggles the module variable in $scope.moduleDetails[module]
		// 					Resets every other module variable to FALSE
		$scope.toggleDetails = function(module){
			$scope.moduleDetails[module] = !$scope.moduleDetails[module];
			$.each($scope.moduleDetails, function(index, val) {
				 if(index != module){$scope.moduleDetails[index] = false;}
			});
		};
		// Initialisiere Anmeldedaten
		$scope.register_data = {
			"exam_data":{
				"name":"",
				"requirements":false
			},
			"exam_members":[],
			"exam_type":"business",
			"customer":{},
			"billing":{}
		};
		// ###############
		// removeLastMember()
		// @description: 	Removes last entry of $scope.register_data.exam_members[] IF more then 1
		// 					
		$scope.removeLastMember = function(){
			if($scope.register_data.exam_members.length > 1){
				$scope.register_data.exam_members.pop();
				console.log("Removed last member.");
			}else{console.log("Cannot remove last member!");}
		};
		// ###########
		// openForm() for ISTQB/ISAQB-exams
		// @_ActiveExam:String -> _Active_Exam points at an id of $scope.exams
		// @description: 	Animates in the overlay-form and de-activates scrolling of the main content
		// 					Fills in register_data with:
		// 					@$scope.register_data.exam_data.name = exam name & language : String
		// 					@$scope.register_data.exam_data.super = full name (superior exam name) : String
		// 					@$scope.register_data.exam_data.requirements = does the exam have extra requirements? : Boolean
		$scope.openForm = function(_ActiveExam){
			$body = $('body');
			$form_window = $('#register-window');
			$form_parent = $('#register-container');
			$confirmation_parent = $('#confirmation-container');
			$scope.activeExam = _ActiveExam;

			//Abdunkeln, dann hineinfliegen (Animation des Anmeldefensters) 
			var animate_in = new TimelineMax()
			.set($confirmation_parent, {opacity: 0, display:'none'})
			.to($form_window, 0.5, {display: 'inline', opacity:1, xPercent:0, ease: Power1.easeInOut})
			.fromTo($form_parent, 0.5, {xPercent:110}, {display: 'inherit', opacity:1, xPercent:0, ease: Back.easeOut});
			// Ende der Animation
			// Scrollen der Hauptseite (im Hintergrund) verhindern
			$body.addClass('noscroll');
			// Add data to register_form
			$scope.register_data.exam_data.name = $scope.exams[_ActiveExam].version[0].name;
			$scope.register_data.exam_data.super = $scope.exams[_ActiveExam].name;
			$scope.register_data.exam_data.requirements = $scope.exams[_ActiveExam].requirements;
		};

		// ###########
		// resetForm()
		// @form_window_id:DOM id selector -> Window to be closed
		// @forceDelete:boolean -> True=Delete formular data (can be left empty)
		// @description: 	Animates out the overlay-form and re-activates scrolling of the main content
		// 					optional: if forceDelete==TRUE or corfirmation is given the tiped-in 
		// 					user data will be deleted (or temporary kept)
		$scope.resetForm = function(form_window_id,forceDelete){
			$body = $('body');
			$form_window = $(form_window_id);
			$confirmation_parent = $('#confirmation-container');

			if (forceDelete || confirm('Anmeldedaten Verwerfen?')) {
				// Re-Initialisiere Anmeldedaten
				$scope.register_data = {
					"exam_data":{
						"name":"",
						"requirements":false
					},
					"exam_members":[],
					"exam_type":"business",
					"customer":{},
					"billing":{}
				};
				$scope.register_data.exam_members.push({'gender':'female','student':'false','timebonus':'false'})
			}

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
		// 					else: alert message & view temp-stored data
		$scope.submitForm = function(validation){
			$body = $('body');
			$form_window = $('#register-window');
			$form_parent = $('#register-container');
			$confirmation_parent = $('#confirmation-container');

			console.log("check data..");
			if (validation){
				if ($scope.register_data.alternative_billing == false) {$scope.register_data.billing = $scope.register_data.customer};
				
				//DEBUG 
				console.log($scope.register_data);
				// alert("Returned data: \n"+JSON.stringify($scope.register_data, null, 2));
				// HIER DATA HANDLER
				$post_data = $scope.register_data;
				if ($post_data.course_type == "private") {delete $post_data.customer};
				if ($post_data.alternative_billing == false) {delete $post_data.billing};
				console.log($post_data);
				$post_data['key']="sanitt_save";
				$post_data['zip']=true;
				$post_data['admin_email']=admin_emails;

				$.ajax({
							type: "POST",
							url: wp_templateUrl + '/175398426/factory/exam_registration.php',
							data: $post_data, // serializes the form's elements.
							success: function(response){
				  				console.log("Service request successful.");
				  				console.log("Response: "+response);
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


		console.debug("pz controller loaded!");
	});
}])



