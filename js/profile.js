
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

var app = angular.module('profile', ['services']);

app.controller("ProfileController", ['$location','Profile', function($location, profile) {
    var buttonwrapper = this;
    this.openQuestion = function(qid) {
        $location.hash('/question/' + qid);
    };
    var setup = function(profileState) {
        buttonwrapper.level = profileState.level;
        buttonwrapper.questions = profileState.levelquestions;
        buttonwrapper.qimage = function(question) {
            switch (question.qstate) {
                case 0: return "images/quest2.png";
                case 1: return "images/exclaim.png";
                case 2: return "images/tick.png";
            }
        };
        buttonwrapper.qstateString = function(question) {
            switch (question.qstate) {
                case 0: return "unopened";
                case 1: return "opened";
                case 2: return "answered";
            }
        };
    };

    var future = profile.invoke().$promise;
    future.then(function(data) {
        var profileState = data;
        setup(profileState);
    }, function(error) {
        alert("Error: " + error.error);
        var profileState = {
            score: 560,
            username: 'radsaggi',
            level: 1,
            levelquestions: [
                {qid: 10, qstate: 0, qvalue: 100},
                {qid: 11, qstate: 1, qvalue: 100},
                {qid: 12, qstate: 2, qvalue: 100},
                {qid: 20, qstate: 0, qvalue: 100},
                {qid: 21, qstate: 1, qvalue: 100},
                {qid: 22, qstate: 2, qvalue: 100}
            ]
        };
        setup(profileState);
    });
}]);


/*app.directive("userInfo", function(){
    return{
        restrict: 'E',
        templateUrl: 'user-info.html',
        controller: function(){
            this.info = userInfo;
        },
        controllerAs: 'uinfo'
    };
});*/



})();
