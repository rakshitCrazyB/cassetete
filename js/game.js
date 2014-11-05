
/*
 * Copyright (C) 2014 radsaggi(ashutosh)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


(function(){

var app = angular.module('njath', ['ngRoute', 'profile', 'question']);

app.directive("navBar", function() {
    return {
        restrict: 'E',
        templateUrl: 'nav-bar.html',
        controller: 'NavBarController',
        controllerAs: 'navBarCtrl'
    };
});

app.config(['$routeProvider', function($rp) {
    $rp.when('/profile', {
        templateUrl: 'profile.html',
        controller: 'ProfileController',
        controllerAs: 'profile'
    }).when('/question/:qno', {
        templateUrl: 'question.html',
        controller: 'QuestionController',
        controllerAs: 'question'
    }).otherwise({
        redirectTo: '/profile'
    });
}]);

app.controller("NavBarController", ['$location', function($location) {
    var showProfileButton = function() {
        return $location.url() == '/profile';
    };
}]);



var userInfo = {name: "sunny" ,
    lscore: "450",
    tscore: "100",
    level: "3"
};

})();