'use strict';

/* Controllers */

angular.module('myApp.controllers', []).
    controller('MyCtrl1', ['$rootScope', '$scope', '$location', '$filter', function($rootScope, $scope, $location, $filter) {
        $scope.login = function() {
            $rootScope.user = $scope.user;
            $location.path('/main');
        }
        $scope.today = $filter('date')(new Date(), "EEEE d 'de' MMMM 'de' yyyy")
        $scope.user = {name: 'Prueba', password: 'Prueba'};
    }])
    .controller('MyCtrl2', ['$rootScope', '$scope', '$filter', function($rootScope, $scope, $filter) {
        $scope.today = $filter('date')(new Date(), "EEEE d 'de' MMMM 'de' yyyy");
        $scope.user = $rootScope.user;
        $scope.projects = [
            {
                position: '1',
                name: 'Idea 1',
                location: 'MTY',
                points: 20
            },
            {
                position: '2',
                name: 'Idea 2',
                location: 'MTY',
                points: 15
            },
            {
                position: '3',
                name: 'Idea 3',
                location: 'SLP',
                points: 10
            },
            {
                position: '4',
                name: 'Idea 4',
                location: 'TAM',
                points: 5
            }
        ];
    }]);