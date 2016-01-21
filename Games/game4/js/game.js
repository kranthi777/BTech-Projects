
var alphabet_selected = decodeURIComponent(location.search.split('alphabet_selected=')[1]);
var alphabet=alphabet_selected;
var text = window[alphabet];
var obj = JSON.parse(text);
var previous=0,score=0,count=0;
var pos=[20,20,30,30,40,40];
var pos2=[30,60,50,40,30,40];
function start()
{
setInterval(function() {game()},4000); 
//game();
}
function game()
{
var x = Math.floor((Math.random() *5) + 1);

for(a=1;a<=previous;a++)
{
//alert("previous");
stra="c";
ya=str.concat(a);
var parent = document.getElementById("new");
var child = document.getElementById(ya);
parent.removeChild(child);
}
 pos=[20,20,30,30,40,40];
 pos2=[30,60,50,40,30,40];
previous=x;
count=count+x;
document.getElementById("count").innerHTML=count;
for(i=1;i<=x;i++)
{
str="c";
y=str.concat(i);
var s = Math.floor((Math.random() *5) + 1);
document.getElementById("new").innerHTML +="<img onmousemove='check("+"this"+")' id='"+y+"' src='"+obj.images[s].sourc+"'"+ "width:60px;height:40px;"+"/>";
}
var movement = setInterval(function() {move(x)},2000); 
}



function move(x)
{
for(p=1;p<=x;p++)
{
pos[p]=pos[p]+Math.floor((Math.random() *5) + 1)-Math.floor((Math.random() *5) + 1);
b=pos[p];
pos2[p]=pos2[p]+Math.floor((Math.random() *5) + 1)-Math.floor((Math.random() *5) + 1);
d=pos2[p];
str="c";
y=str.concat(p);
//alert(y);

document.getElementById(y).style.marginTop = b+"%";
document.getElementById(y).style.marginLeft = d+"%";
}
}
function check(y)
{
//alert(y.src);
if(y.src=="../images/image8.png")
{alert("NO re attempt");
}
else if((y.src!="../images/image8.png"))//&&obj.images[s].type=="0")
{
y.src="../images/image8.png";
score=score+1;
document.getElementById("score").innerHTML=score; 
//document.getElementById(y).src="../images/image.gif";}
}
else
{
y.src="../images/images13.jpeg";
score=score-1;
document.getElementById("score").innerHTML=score; 
}
}
alert(" play \nPiclrn");

