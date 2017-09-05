/*global angular */
(function () {
	'use strict';
	var app = angular.module ("myApp", ["ngRoute", 'angularModalService', "bootstrap-modal"]);
	
	// Pagination with Client-Side Data
	app.filter("offset", function() {
		return function(input, start) {
			start = parseInt(start, 10);
			return input.slice(start);
		};
	});
	
	app.controller("paginationCtrl1", function($scope) {
		$scope.studentsPerPage = 5;
		$scope.currentPage = 0;
		$scope.students = [];
		
		// Assumes entire dataset is loaded
		for (var i = 0; i < 50; i++) {
			$scope.students.push({id: i, name: "Student " + i });
		}

		$scope.range = function() { 
			var rangeSize = 5;
			var ret = [];
			var start = $scope.currentPage;
			if (start > $scope.pageCount() - rangeSize ) {
				start = $scope.pageCount() - rangeSize + 1;
			}
			for (var i=start; i<start + rangeSize; i++) {
				ret.push(i);
			}
			return ret;
		};
		$scope.prevPage = function() {
			if ($scope.currentPage > 0) {
				$scope.currentPage--;
			}
		};
		$scope.prevPageDisabled = function() {
			return $scope.currentPage === 0 ? "disabled" : "";
		};
		$scope.nextPage = function() {
			if ($scope.currentPage < $scope.pageCount()) {
				$scope.currentPage++;
			}
		};
		$scope.nextPageDisabled = function() {
			return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
		};
		$scope.pageCount = function() {
			return Math.ceil($scope.students.length/$scope.studentsPerPage) - 1;
		};
		$scope.setPage = function(n) { 
			$scope.currentPage = n; 
		}; 
	});
	
	
	
	
	// Pagination with Server-Side Data
	// Replace this factory with call to appropriate RESTful APIs
	app.factory("Student", function() {
		var students = [];
		var service = {};
		for (var i = 0; i < 50; i++) {
			students.push({id: i, name: "student " + i});
		}
		service = {
				get: function(offset, limit) {
					return students.slice(offset, offset+limit);
				},
				total: function() {
					return students.length;
				}
			};
		return service;
	});

	app.controller("paginationCtrl2", function($scope, Student) {
		$scope.studentsPerPage = 5;
		$scope.currentPage = 0;
		
		$scope.range = function() { 
			var rangeSize = 5; 
			var ret = []; 
			var start = $scope.currentPage; 
				if (start > $scope.pageCount() - rangeSize ) { 
					start = $scope.pageCount() - rangeSize; 
				} 
			for (var i=start; i<start + rangeSize; i++) { 
				ret.push(i); 
			} 
			return ret; 
		}; 

		$scope.prevPage = function() {
			if ($scope.currentPage > 0) {
				$scope.currentPage--;
			}
		};
		$scope.prevPageDisabled = function() {
			return $scope.currentPage === 0 ? "disabled" : "";
		};
		$scope.nextPage = function() {
			if ($scope.currentPage < $scope.pageCount() - 1) {
				$scope.currentPage++;
			}
		};
		$scope.nextPageDisabled = function() {
			return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : "";
		};
		$scope.pageCount = function() {
			return Math.ceil($scope.total/$scope.studentsPerPage);
		};
		$scope.setPage = function(n) { 
			if (n > 0 && n < $scope.pageCount()) { 
				$scope.currentPage = n; 
			} 
		}; 
		$scope.$watch("currentPage", function(newValue, oldValue) {
			$scope.pagedStudents = Student.get(newValue*$scope.studentsPerPage, $scope.studentsPerPage);
			$scope.total = Student.total();
		});
	});
	
	
	
	
	// Pagination with Server-Side Data using Load More
	app.controller("paginationCtrl3", function($scope, Student) {
		$scope.studentsPerPage = 5;
		$scope.currentPage = 0;
		$scope.total = Student.total();
		$scope.pagedStudents = Student.get($scope.currentPage*$scope.studentsPerPage,	$scope.studentsPerPage);
		$scope.loadMore = function() {
			$scope.currentPage++;
			var newStudents = Student.get($scope.currentPage*$scope.studentsPerPage, $scope.studentsPerPage);
			$scope.pagedStudents = $scope.pagedStudents.concat(newStudents);
		};
		$scope.nextPageDisabledClass = function() {
			return $scope.currentPage === $scope.pageCount()-1 ? "disabled" : "";
		};
		$scope.pageCount = function() {
			return Math.ceil($scope.total/$scope.studentsPerPage);
		};
	});
	
		
	
	// editable content
	app.directive("contenteditable", function() {
		var direc = {};
		direc.restrict = "A";
		direc.require = "ngModel";
		direc.link = function(scope, element, attrs, ngModel) {
				function read() {
						ngModel.$setViewValue(element.html());
				}
				ngModel.$render = function() {
					element.html(ngModel.$viewValue || "");
				};
				element.bind("blur keyup change", function() {
					scope.$apply(read);
				});
			};
		return direc;
	});
	
	
	// Modal Controllers
	app.controller("myModalCtrl1", function($scope) {
		$scope.showModal = false;
		$scope.open = function() 		{	$scope.showModal = true;	};
		$scope.ok = function() 			{ $scope.showModal = false; };
		$scope.cancel = function() 	{ $scope.showModal = false; };
	});
	
	app.controller('myModalCtrl2', function($scope, ModalService) {
			$scope.show = function() {
					ModalService.showModal({
							templateUrl: 'modal.html',
							controller: "modalController"
					}).then(function(modal) {
							modal.element.modal();
							modal.close.then(function(result) {
									$scope.message = "You said " + result;
							});
					});
			};
			
	});

	app.controller('modalController', function($scope, close) {
		$scope.close = function(result) {
			close(result, 500); // close, but give 500ms for bootstrap to animate
		};
	});
	
	
	
	// Others
	app.config(function($routeProvider) {
		$routeProvider.
			when("/home", { templateUrl: "home.html" }).
			when("/page", { templateUrl: "page.html" }).
			otherwise({ redirectTo: "/home" });
	});
	
	app.factory("flash", function($rootScope) {
		var queue = [];
		var currentMessage = "";
		$rootScope.$on("$routeChangeSuccess", function() {
			currentMessage = queue.shift() || "";
		});
		return {
			setMessage: function(message) {
					queue.push(message);
				},
			getMessage: function() {
					return currentMessage;
				}
		};
	});
	
	app.controller("myCtrl", function($scope, $location, flash) {
		$scope.flash = flash;
		$scope.message = "Hello World";
		$scope.submit = function(message) {
			flash.setMessage(message);
			$location.path("/page");
		};
	});
}());