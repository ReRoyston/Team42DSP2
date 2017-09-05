/*global angular */
(function () {
	"use strict";
	/*
		Lines 1 to 3 and the last line in this file are added to address the warnings in Brackets
		Note that there must be no space between * and g in line 1
		
		In addition, config only works for AngularJS 1.5
				
	*/

	var app = angular.module("myApp", ["ngRoute"]);


	app.controller("sampleCtrl", function ($scope, $routeParams) {
		$scope.viewInfoID = $routeParams.idVar;
	});

	/* Sample Filter */
	app.filter("isRoman", function () {
		return function (myParam) {
			var i, c, txt = "";
            var Roman = [["","I","II","III","IV","V","VI","VII","VIII","IX"],
             ["","X","XX","XXX","XL","L","LX","LXX","LXXX","XC"],
             ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM"],
             ["","M","MM","MMM","  "," ","  ","   ","    ","  "]];
            var CorrectArr = [];
            var ReverseArr = myParam.toString().split("").reverse();
            for (var i = 0; i < ReverseArr.length; i++) {
                    CorrectArr.unshift(Roman[i][ReverseArr[i]]);
                }
        if((0 < myParam)&&(myParam<100)) {
            if(myParam == 1){txt = CorrectArr.join(" ") }
            else{txt = CorrectArr.join(" ")}
        }
        return txt;
		};
	});


	/* Sample Controller */
	app.controller("myCtrl", function ($scope) {

	});

/* end of module */
}());
