/*global angular */
(function () {
	"use strict";
	/*
		Lines 1 to 3 and the last line in this file are added to address the warnings in Brackets
		Note that there must be no space between * and g in line 1
		
		In addition, config only works for AngularJS 1.5
				
	*/

	var app = angular.module("myApp", ["ngRoute"]);

	/* Sample Directive */
	
	



	/* Sample Controller */
	app.controller("myCtrl", function ($scope) {

     $scope.list = [{name:'John'},
    {name:'Jessie'}];
        
    $scope.post = function (numVar) {
            $scope.list.push({name:$scope.numVar});

            };
    
    $scope.delete = function (index) {
              $scope.list.splice(index, 1)
            };

        
	});

/* end of module */
}());
