angular.module('controllers.animation',[])

// ###########
// CONTROLLERS
// Animation Ctrl
// @description:
// Controlling of all basic animations that can be used on every page
// 
// Available animations:
// -class:"heading animate" -> Animates 1 to n page headings with the given classes. Single headings fly in + fade in from the right
// -class:"animate_list" -> Animates 1 to n list element(s) with the given class. Single items fly in + fade in from the right
// -id:"caution1","caution2" -> Module slides in from the left, if user scrolled far enough (300px after module entering the screen)
// ###########
.controller('animationCtrl', ['$scope',function($scope){
	jQuery(function($) {
		// init title animation
		// var $title = $('.welcome .animate'); --> containers class is 'welcome' and headings class is 'animate'
		var $welcome = document.getElementsByClassName('welcome');
		if(($welcome[0])){var $title = $welcome[0].getElementsByClassName("animate");}
		TweenMax.staggerFrom($title, 1, {opacity:0, xPercent:'10', ease: Power3.easeInOut}, 1, '+=2');
		// init scrollmagic controller_listenanimation
		var controller_listenanimation = new ScrollMagic.Controller();
		// build tween
		var trigger_list = document.getElementsByClassName('animate_list')[0];
		var timeline_listenanimation = new TimelineMax();
		$('.animate_list').each(function(index, el) {
			$list_items = $(this).children('li');
			timeline_listenanimation.staggerFrom($list_items, 0.55,{x: 200, opacity:0, ease: Power2.easeOut},	0.1, '-=0.5');
			// build scene
		});
		var scene_listenanimation = new ScrollMagic.Scene({triggerElement: trigger_list, reverse: false, triggerHook: 'onEnter', offset: 300})
			.setTween(timeline_listenanimation)
			//.addIndicators({name: "Listenanimation"}) // add indicators (requires plugin)
			.addTo(controller_listenanimation);


		//Animation for caution divs
		// init scrollmagic controller_caution
		var controller_caution = new ScrollMagic.Controller();
		var caution_containers = document.getElementsByClassName("caution-container");
		var caution_items = {};
		var caution_timelines = {};
		var caution_scenes = {};
		console.log(caution_containers.length + " container(s) found");
		for(i = 0; i < caution_containers.length; i++){
			caution_timelines[i] = new TimelineMax();
			caution_items[i] = caution_containers[i];
			caution_timelines[i].from(caution_items[i], 1,{xPercent: -120, opacity:0.5, ease: Power2.easeOut}, '-=0.5');
			caution_scenes[i] = new ScrollMagic.Scene({ triggerElement: caution_containers[i], reverse: false, triggerHook: 'onEnter', offset: 200})
				.setTween(caution_timelines[i])
				//.addIndicators({name: "Caution Animation "+i}) // add indicators (requires plugin)
				.addTo(controller_caution);
		}

		console.debug("animation controller loaded!");
	});
}])

// ########
// arrowAnimationCtrl
// @description:
// A controller made for 3 specific svg files with the given id-names
// Animation of those elements:
// Arrows fly in ("-->" then "<--"), arrow heading slides/fades in from inside the arrows center 
.controller('arrowAnimationCtrl', ['$scope',function($scope){
	// delay=waitBeforeStart / repeat:-1=infinite / repeatDelay=waitBeforeRestart / yoyo=playbackEnabled
	arrow_timeline = new TimelineMax({delay:1});
	// Inition set of transform origins
	arrow_timeline.set('#arrow_x5F_left_x5F_top', {transformOrigin:"center center"});
	arrow_timeline.set('#arrow_x5F_left_x5F_bottom', {transformOrigin:"center center"});
	arrow_timeline.set('#arrow_x5F_right_x5F_top', {scaleOrigin:"center center"});
	arrow_timeline.set('#arrow_x5F_right_x5F_bottom', {scaleOrigin:"center center"});
	// first part of the animation (upper row)
	arrow_timeline.from('#arrow_x5F_right_x5F_top', 1.5, {xPercent:-60, scaleX:0.5, ease: Power3.easeOut},"stage1 += 0.2");
	arrow_timeline.from('#arrow_x5F_left_x5F_top', 1, {xPercent:10, scale:0, ease: Power3.easeInOut},"stage1 += 0.5");
	arrow_timeline.from('#text_x5F_upper', 0.75, {yPercent:50, opacity:0, ease: Power3.easeInOut},"stage1 += 1");
	// second part of the animation (lower row)
	arrow_timeline.from('#arrow_x5F_right_x5F_bottom', 1.5, {xPercent:-60, scaleX:0.5, ease: Power3.easeOut},"stage2 += 0.2");
	arrow_timeline.from('#arrow_x5F_left_x5F_bottom', 1, {xPercent:10, scale:0, ease: Power3.easeInOut},"stage2 += 0.5");
	arrow_timeline.from('#text_x5F_lower', 0.75, {yPercent:50, opacity:0, ease: Power3.easeInOut},"stage2 += 1");

	console.log("arrow-animation-graphics controller loaded!");
}])



