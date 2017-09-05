/*global angular */
(function () {
	"use strict";
	/*
		Lines 1 to 3 and the last line in this file are added to address the warnings in Brackets
		Note that there must be no space between * and g in line 1
		
		In addition, config only works for AngularJS 1.5
				
	*/

	var app = angular.module("myApp", ["ngRoute"]);

	/* Sample config */
	app.config(["$routeProvider",
		function ($routeProvider) {
			$routeProvider.
				when("/sample/:idVar", {
					templateUrl: "templates/info.html",
					controller: "sampleCtrl"
				});
		}]);

	app.controller("sampleCtrl", function ($scope, $routeParams) {
		$scope.viewInfoID = $routeParams.idVar;
	});

	/* Sample Filter */
	app.filter("isEven", function () {
		return function (myParam) {
			var ans = "false";
			if ((myParam % 2) === 0) {
				ans = "true";
			}
			return ans;
		};
	});

	/* Sample Directive */
	app.directive("ngDemo", function ($parse) {
		var direc = {},
			linkFunction = function (scope, element, attributes) {
				/* Evaluates attribute before assigning it into a model */
				scope.items = scope.$eval(attributes.ngDemo);
			};

		direc.restrict = "A";
		direc.link = linkFunction;
		direc.template = '<div><p ng-repeat="item in items">{{item}}</p></div>';
		return direc;
	});

	/* Sample Controller */
	app.controller("myCtrl", function ($scope) {

	});

/* end of module */
}());
