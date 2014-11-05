<?
/*
 * Copyright (C) 2014 crazyb(Rakshit) , SageEx(Arindam) , Codez266()Sumit)
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

require_once("support/dbcon.php");
require_once("userclass.php");
require_once("Question.php");


function getQuestionCost()
{
	return 100;
}

function getQuestionCurrScore($question)
{
    return 100;
}

function getQuestionScore()
{
	return 100;
}
//this question opened first time by user . DO Stuff(like deduct cost)
function firstTimeQOpened()  
{
    
}
function questionAnsweredCorrect($question, $current)
{

}
function questionAnsweredIncorrect($question, $current)
{

}


?>
