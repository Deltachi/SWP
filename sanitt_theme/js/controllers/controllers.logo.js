angular.module('controllers.logo',[])

// ###############
// Logo controller
// @description:
// svg GSAP animation of the sanitt-logo
// ###############

.controller('logoCtrl', ['$scope', function ($scope) {
	jQuery(function($){
		timeline = new TimelineMax()
			.from($(".title-logo"), 1.5, {yPercent:"-100", opacity:0, ease: Power3.easeInOut}, 'klammern += 0')
			.from($("#main5"), 0.5, {xPercent:50, ease: Power3.easeInOut}, 'klammern += 1')
			.from($("#main1"), 0.5, {xPercent:'-50', ease: Power3.easeInOut}, 'klammern += 1')
			.from($("#main6, #main7, #main8, #main9"), 1, {opacity:'0', ease: Power3.easeInOut}, 'rest-=0.5')
			.staggerFrom($("#sub1, #sub2, #sub3"), 0.5, {opacity:0, xPercent:'50', ease: Power3.easeInOut}, 0.1, 'rest+=0');
		console.debug("logo controller loaded!");
	});
		
}])