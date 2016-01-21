
var language_selected = decodeURIComponent(location.search.split('language_selected=')[1]);
var language=language_selected;
var text = window[language];
var obj = JSON.parse(text);


for(var i=0; i<obj.languages.length; i++)
{
var url = '../html/game.html?alphabet_selected=' +encodeURIComponent(obj.languages[i].type);
if(i%3==0)
{
document.getElementById("one").innerHTML +="</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"<a class='lang0' href='"+url+"'>"+ obj.languages[i].type+"</a>";}
if(i%3==1)
{
document.getElementById("one").innerHTML +="<a class='lang1' href='"+url+"'>"+ obj.languages[i].type+"</a>";
}
if(i%3==2)
{
document.getElementById("one").innerHTML +="<a class='lang2' href='"+url+"'>"+ obj.languages[i].type+"</a>";
}
}
alert("Select alphabet to play \n             Piclrn");

