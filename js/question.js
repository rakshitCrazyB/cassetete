
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

var app = angular.module('question', []);


app.directive("questionDisplay", function() {
    return {
        restrict: 'E',
        templateUrl: 'question-display.html',
        controller: function() {
            this.text = question.text;
            this.image = "images/" + question.image;

            this.showText = (question.type & 1) == 1;
            this.showImage = (question.type & 2) == 2;

            switch (question.type) {
                case 1: this.qtypeString = "question-text"; break;
                case 2: this.qtypeString = "question-image"; break;
                case 3: this.qtypeString = "question-both"; break;
            }

        },
        controllerAs: 'question'
    };
});


app.directive("formWrapper", function() {
    return {
        restrict: 'E',
        templateUrl: 'question-form.html'
    };
});

app.controller("SubmitAnswerController", function() {
    this.answer = "";
    this.submit = function () {
        alert("Your answer is " + this.answer);
    };
});

app.controller("TauntController", function() {
    this.get = function () {
        return taunts[0];
    };
});

var question = {
    type: 3,
    id: 123,
    text: "Who am i?",
    image: '0Wcc.png'
};

var taunts = [
    "Are you sure??",
    "May I lock it?",
    "Double check!!",
    "Easy, aint it?",
    "Very peculiar!"
];

})();