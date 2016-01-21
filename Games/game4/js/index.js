//var ashish="textee";
//var ash=window[ashish];
//var ash=window["text"];
var obj = JSON.parse(text);
alert("Ready to play \n     Piclrn");
if(obj.languages.length>2)
alert("part done");
for(var i=0; i<obj.languages.length; i++)
{
var url = 'html/alphabets.html?language_selected=' +encodeURIComponent(obj.languages[i].type);
document.getElementById("one").innerHTML +="<a class='lang' href='"+url+"'>"+ obj.languages[i].type+"</a>"+"</br></br></br></br></br></br>";
}
