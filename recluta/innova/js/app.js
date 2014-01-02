'use strict';


// Declare app level module which depends on filters, and services
angular.module('myApp', [
  'ngRoute',
  'myApp.filters',
  'myApp.services',
  'myApp.directives',
  'myApp.controllers'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/login', {templateUrl: 'partials/login.html', controller: 'MyCtrl1'});
  $routeProvider.when('/main', {templateUrl: 'partials/main.html', controller: 'MyCtrl2'});
  $routeProvider.otherwise({redirectTo: '/login'});
}]);
