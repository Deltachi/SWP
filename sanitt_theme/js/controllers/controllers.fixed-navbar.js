angular.module('controllers.fixed-navbar',[])

// #####################
// CONTROLLER
// fixed-navbar Ctrl
// @description:
// Contains the sitemap as json object to locate page paths for css highlighting,
// Checkfunction for ng-class inside fixed-navbar.php
// Scrolltrigger function for switching between fixed top navbar and integrated navbar (fixed-navbar / header -> navbar)
// Dropdowntrigger function for displaying submenus in navbars (disables all remaining opened submenus)
// Menu-hide function for collapsing/expanding the whole navbars (mobile devices / x small screens only)
// #####################
.controller('navCtrl', ['$scope',function($scope){
	jQuery(function($) {
		$scope.wp_templateUrl = wp_templateUrl;
		$scope.wp_templateUrl_lupe = wp_templateUrl+"/images/icons/lupe.svg";
		
		var sitemap = {
			'unternehmen':['about','team','kooperationspartner','referenzen','referenzen-projekte'],
			'referenzen':['referenzen-projekte'],
			'it-services':['it-schulungen','raumvermietung','webprogrammierung','softwaretest','testmanagement','it-support','it-personaldienstleistungen','contracting','arbeitnehmerueberlassung','personalvermittlung'],
			'it-schulungen':['raumvermietung'],
			'it-personaldienstleistungen':['contracting','arbeitnehmerueberlassung','personalvermittlung'],
			'it-pz':['istqb','isaqb','lehrplaene'],
			'istqb':['anmelden','lehrplaene'],
			'isaqb':['anmelden','download'],
			'karriere':['stellenangebote','young-professionals','it-projektboerse','initiativbewerbung'],
		};
		$scope.tabContains = function(list, item){
			for(var i = 0; i < sitemap[list].length; i++){
				if (sitemap[list][i] == item) {return true};
			}
			return false;
		}
		
		var num = 90; //number of pixels before modifying styles -> header-banner (Logo)
		var $body = $('body');
		var $mainNav = $('#main-navigation');
		var $fixedNav = $('#fixed-navigation');
		

		var $navDropdowns_fixed = $('#fixed-navigation .toggleable a'); //geklickt werden die a-tags innerhalb der li elemente
		
		

		$(window).bind('scroll', function () {
			// fixed navbar show
		    if ($(window).scrollTop() > num) {
		    	$body.addClass('padding-before');
				$mainNav.addClass('hidden');
				$fixedNav.removeClass('hidden');
		    } else {
		    	$body.removeClass('padding-before');
				$mainNav.removeClass('hidden');
				$fixedNav.addClass('hidden');
		    }
		});

		$navDropdowns_fixed.click(function(e){
			if (e.target === this){
				console.log("..dropdown toggle-button [navbar,"+$(this).text()+"] was pressed.");
				console.log($(this).parent());
				$(this).parent().siblings().removeClass('active');
				$(this).parent().toggleClass('active'); //setze nicht den a-tag == 'active' sondern das li-element
			}
		});
		//Toggle die mobile Navbar und falls sie geschlossen wird, schließe alle Untermenüs
		$('#menu-hide').click(function(event) {
			if(!$fixedNav.hasClass('fade-out')){
				$navDropdowns_fixed.parent().removeClass('active');
			}
			$fixedNav.toggleClass('fade-out');
			
		});
		$('#menu-hide-seperate').click(function(event) {
			if(!$fixedNav.hasClass('fade-out')){
				$navDropdowns_fixed.parent().removeClass('active');
			}
			$fixedNav.toggleClass('fade-out');
			
		});
		console.debug("nav controller loaded!");
	});
}])