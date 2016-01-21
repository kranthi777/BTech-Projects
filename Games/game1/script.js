var obj = JSON.parse(text);
/*--------------------------------test whether page is working or not--------------*/
alert("    Ready to play \n The Blinking game");
alert(" Learn How to \n      SPELL");
/*-------------------------------intialize the initial variables--------------------*/
var check=0;
var count=0;
var score=0;
var x;

/*-------------------------onload of the game------------------------------------------*/
function start()
{
document.getElementById("two").style.marginTop="20%";

var x = Math.floor((Math.random() * 25) + 1);     // to display the fist word and this word will change after every 3 second...

document.getElementById("two").innerHTML =obj.spellings[x].word;

setInterval(function() {game()},4000);  // changing word after every 3 se....
}
/*---------------------to change the word after every 4 sec----------------------------------------------------------------*/
function game()
{

document.getElementById("two").style.marginTop="20%";

 x = Math.floor((Math.random() * 25) + 1); 
check=0;
count=count+1;
if(count>=25)
{
localStorage.setItem("score", score);
window.location.assign("over.html")
}
document.getElementById("count").innerHTML =count;
document.getElementById("two").style.backgroundColor="black";
document.getElementById("two").innerHTML =obj.spellings[x].word;

}
/*-----------------------------------on answer of a question--------------------------------------------*/
function Correct()
{
if(obj.spellings[x].correct=="1")
{right();}
else
{wrong();}
}
function InCorrect()
{
if(obj.spellings[x].correct=="0")
{right();}
else
{wrong();}
}
/*-------------------------------if the answer is wrong------------------------------------------------*/
function wrong()
{
if(check==1)
{
alert("Reattempt:Not Now!!");
}
else
{
check=1;
score=score-1;
document.getElementById("score").innerHTML =score;
document.getElementById("two").style.backgroundColor="red";
}
}
/*----------------------------------if the answer is right--------------------------------------------------------*/
function right()
{
if(check==1)
{
alert("Reattempt:Not Now!!");
}
else
{
check=1;
score=score+1;
document.getElementById("score").innerHTML =score;
document.getElementById("two").style.backgroundColor="green";
}
}
/*----------------------------------------------------------------------------*/
