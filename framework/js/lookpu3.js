var App = angular.module("App", []);

App.controller("FirstCtrl", function($scope,$http){
    $http.get('data/JSON.json')
.then (
function(response) {
$scope.persons = response.data;
},
function(response) {
// error handling routine
});
});