
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

var app = angular.module('njath', ['profile', 'question']);

app.directive("navBar", function(){
    return {
        restrict: 'E',
        templateUrl: 'nav-bar.html'
    };
});

app.controller("DisplayController", function() {
    this.PAGES = PAGES;
    this.showing = PAGES.PROFILE_PAGE;

    this.showingProfilePage = function() {
        return this.showing == PAGES.PROFILE_PAGE;
    };
    this.showingQuestionPage = function() {
        return this.showing == PAGES.QUESTION_PAGE;
    }


    this.showPage = function(page) {
        this.showing = page;
    };
});

var PAGES = {
    PROFILE_PAGE: 0,
    QUESTION_PAGE: 1
};

var userInfo = {name: "sunny" ,
    lscore: "450",
    tscore: "100",
    level: "3"
};

})();