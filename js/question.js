
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

var app = angular.module('question', ['services']);

var taunts = [
    "Are you sure??",
    "May I lock it?",
    "Double check!!",
    "Easy, aint it?",
    "Very peculiar!"
];


app.controller("QuestionController", ['$routeParams','Question', function($routeParams, question) {
    var display = this;
    var setup = function(question) {
        display.text = question.text;
        display.image = "images/" + question.image;

        display.showText = (question.type & 1) == 1;
        display.showImage = (question.type & 2) == 2;

        display.qtypeString = function() {
            switch (question.type) {
                case 1: return "question-text";
                case 2: return "question-image";
                case 3: return "question-both";
            }
        }
    }

    var handler = function(error) {
        alert(error.status + " " + error.statusText + ": " + error.data);
        var quest = {
            type: 3,
            id: 123,
            text: "Who am i?",
            image: '0Wcc.png'
        };
        setup(quest);
    };

    var future = question.invoke({qno: $routeParams.qno}).$promise;
    future.then(function(data) {
        var quest = data;
        setup(quest);
    }, handler);
}]);

app.controller("SubmitAnswerController", ['$routeParams', 'Answer', '$location', function($rp, ans, $location) {
    this.answer = "";
    this.submit = function () {
        alert("Your answer is " + this.answer);
        var future = ans.invoke({qno: $rp.qno, answer: this.answer}).$promise;
        future.then(function(data) {
            if (data.stat) {
                alert('Yeah Right!');
                $location.url('/profile');
            } else {
                alert('Incorrect Answer. Try again!');
            }
        }, function(error) {
            alert(error.status + " " + error.statusText + ": " + error.data);
        });
    };
}]);

app.controller("TauntController", function() {
    this.get = function () {
        return taunts[0];
    };
});

})();