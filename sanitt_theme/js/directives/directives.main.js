angular.module('directives.main',[])


// ####################################
// ###Directive Header/Navbar Loader###
// ####################################
// Usage:
// 			Inline HTML --> <main-header></main-header>
// 
// Description:
// 			Loads header (HTML), then initializes the headerCtrl (Controller)
//
.directive('mainHeader',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + "/ng-templates/header.php",
		scope: {
			activeTab: '@activeTab'
		},
		controller: 'headerCtrl'
	};
})

// #################################
// ###Directive Fix-Navbar Loader###
// #################################
// Usage:
// 			Inline HTML --> <fixed-navbar></fixed-navbar>
// 
// Description:
// 			Loads fixedNavbar (HTML), then initializes the navCtrl (Controller)
//
.directive('fixedNavbar',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + "/ng-templates/fixed-navbar.php",
		scope: {
			activeTab: '@activeTab'
		},
		controller: 'navCtrl'
	};
})

// #############################
// ###Directive Footer Loader###
// #############################
// Usage:
// 			Inline HTML --> <my-footer></my-footer>
// 
// Description:
// 			Loads sanitt_logo.svg, then starts GSAP animation (Controller)
//
.directive('myFooter',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + "/ng-templates/footer.php",
		controller: ["$scope",function($scope){
			$scope.wp_templateUrl = wp_templateUrl;
			console.debug("footer template loaded!");
		}]
	};
})

// ##########################
// ###Directive SVG Loader###
// ##########################
// Usage:
// 			HTML --> <sannit-logo></sanitt-logo> 
// 
// Description:
// 			Loads sanitt_logo.svg, then starts GSAP animation (Controller)
// 
.directive('sanittLogo',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/images/content/sanitt_logo.svg',
		controller: 'logoCtrl'
	}
})
.directive('contractingGraphics',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/images/content/contracting-graphics.svg',
		controller: 'arrowAnimationCtrl'
	}
})
.directive('arbeitnehmerueberlassungGraphics',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/images/content/arbeitnehmerueberlassung-graphics.svg',
		controller: 'arrowAnimationCtrl'
	}
})
.directive('personalvermittlungGraphics',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/images/content/personalvermittlung-graphics.svg',
		controller: 'arrowAnimationCtrl'
	}
})

// ################################
// ###Directive Formular Loaders###
// ################################
// Usage:
// 			Inline HTML --> <formular-course-default></formular-course-default>
// 			Inline HTML --> <formular-course-request></formular-course-request>
// 			Inline HTML --> <formular-course-request></formular-pz>
// 
// Description:
// 			Loads the form (HTML), then activates the datepicker gui-plugin
//
.directive('formularCourseDefault',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/ng-templates/formular-course-default.php',
		controller: function(){
			jQuery(function($) {
				$('#register_datepicker1').datepicker({dateFormat: "dd. mm. yy"});
				$('#register_datepicker2').datepicker({dateFormat: "dd. mm. yy"});
			});
		}
	}
})
.directive('formularCourseRequest',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/ng-templates/formular-course-request.php',
		controller: function(){
			jQuery(function($) {
				$('#request_datepicker1').datepicker({dateFormat: "dd. mm. yy"});
				$('#request_datepicker2').datepicker({dateFormat: "dd. mm. yy"});
			});
		}
	}
})
.directive('formularPz',function(){
	return{
		restrict: "E",
		templateUrl: wp_templateUrl + '/ng-templates/formular-pz.php',
		controller: function(){
			jQuery(function($) {
				$('#istqb_datepicker1').datepicker({dateFormat: "dd. mm. yy"});
			});
		}
	}
});
