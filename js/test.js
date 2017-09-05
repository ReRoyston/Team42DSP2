/*global angular */
var app = angular.module("myApp", []);
app.controller ("myCtrl", function ($scope){
$scope.numVar = 0;
$scope.addValue = function (num2add) {
$scope.numVar = $scope.numVar + num2add;
};
$scope.incNum = function () {
$scope.numVar += 1;
};
$scope.isNumEven = function () {
return (($scope.numVar % 2) == 0);
};
});
