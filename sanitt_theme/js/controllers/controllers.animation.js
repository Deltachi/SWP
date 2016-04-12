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

		// init scrollmagic controller_caution
		var controller_caution = new ScrollMagic.Controller();

		// build tween1
		var trigger_caution1 = document.getElementById("caution1");
		if(trigger_caution1 != undefined){
			var timeline_caution1 = new TimelineMax();
			$caution_item1 = ('#caution1 .animate.caution');
			timeline_caution1.from($caution_item1, 1,{xPercent: -120, opacity:0.5, ease: Power2.easeOut}, '-=0.5');
			
			var scene_caution1 = new ScrollMagic.Scene({ triggerElement: trigger_caution1, reverse: false, triggerHook: 'onEnter', offset: 200})
				.setTween(timeline_caution1)
				//.addIndicators({name: "Caution Animation 1"}) // add indicators (requires plugin)
				.addTo(controller_caution);
		}

		// build tween2
		var trigger_caution2 = document.getElementById("caution2");
		if(trigger_caution2 != undefined){
			var timeline_caution2 = new TimelineMax();
			$caution_item2 = ('#caution2 .animate.caution');
			timeline_caution2.from($caution_item2, 1,{xPercent: -120, opacity:0.5, ease: Power2.easeOut}, '-=0.5');
			
			var scene_caution2 = new ScrollMagic.Scene({ triggerElement: trigger_caution2, reverse: false, triggerHook: 'onEnter', offset: 200})
				.setTween(timeline_caution2)
				//.addIndicators({name: "Caution Animation 2"}) // add indicators (requires plugin)
				.addTo(controller_caution);
		}	
		// Verzögerte Modul-Einblendung für die "Nichts gefunden"-Initiativbewerbung
		// var slideIn_tween = new TweenMax.from('.slide-in', 2, {height:0, padding:0, ease: Power3.easeInOut, delay:4});

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



