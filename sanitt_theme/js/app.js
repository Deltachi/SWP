// AngularJS App Modul enthält die Controller und Directives (Template-Verweise)
console.log("..loading AngularJS App");

var app = angular.module('app', [
		'controllers.animation',
		'controllers.contact',
		'controllers.course',
		'controllers.fixed-navbar',
		'controllers.header',
		'controllers.logo',
		'controllers.main',
		'controllers.pz',
		'directives.main'
	]);


// Extra Filter für angular.js templating
// @input(String): Input String das gesplittet werden soll
// @splitChar(char): Zeichen, an deren Stelle der Input geteilt werden soll
// @splitIndex(integer): Auswahl, welcher Teil des gesplitteten Strings zurückgeliefert werden soll 
// @description: ng-filter - Filter um String Eingaben innerhalb HTML zu splitten
// 
app.filter('split', function() {
        return function(input, splitChar, splitIndex) {
            // do some bounds checking here to ensure it has that index
            return input.split(splitChar)[splitIndex];
        }
    });


