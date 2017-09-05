
var myApp = angular.module("myApp", []);

app.controller ("myCtrl", function ($scope){
    $scope.numVar = [];
     $scope.z='Not start yet';
    $scope.setvalue = function () {
            $scope.z = 'now you can start guess'
            $scope.numVar = Math.floor(Math.random()*10)+0;
            };
    
    $scope.guess = function () {
            if($scope.x = $scope.numVar){$scope.z = 'Lucky guess!'}
            else if($scope.x > $scope.numVar){$scope.z ='Guess higher'}
            else if($scope.x< $scope.numVar){$scope.z ='Guess lower'}
            else{$scope.z = 'what you doing here?'}
            };
    
    $scope.giveup = function () {
       $scope.z ='You Give up';
        $scope.numVar = Math.floor((Math.random()*10)+1);
        };
   
});
    

