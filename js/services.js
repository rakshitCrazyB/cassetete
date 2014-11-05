
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

(function() {

var app = angular.module('services', ['ngResource']);

app.factory('Profile', ['$resource', function($resource) {
    return $resource('profile.php', {}, {
      invoke: {method:'GET', isArray:false}
    });
}]);

app.factory('Question', ['$resource', function($resource) {
    return $resource('ques.php', {}, {
      invoke: {method:'GET', params:{qno: '@qno'}, isArray:false}
    });
}]);

app.factory('Answer', ['$resource', function($resource) {
    return $resource('answer.php', {}, {
      invoke: {method:'POST', params:{qno: '@qno', answer: '@answer'}, isArray:false}
    });
}]);

})();
