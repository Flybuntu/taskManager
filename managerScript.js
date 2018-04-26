

/* manager.php Ovdje koristimo AJAX da vidimo jel smo obavili zadatak */

var checkBoxes = document.getElementsByClassName("checkBox");

function checkFunction() 
{ 
	var xhr = new XMLHttpRequest();

	var id = this.id;

	if(this.checked == true)
	{
		xhr.open("GET", "ajaxInj.php?id=" + id.substring(5) + "&checked=yes", true);
	}
	else
	{
		xhr.open("GET", "ajaxInj.php?id=" + id.substring(5) + "&checked=no", true);
	}

	xhr.send();

}

for(var i=0; i<checkBoxes.length; i++)
{
	checkBoxes[i].addEventListener("click", checkFunction);
}


/* manager.php Vracamo focus na input nakon entera */

function putFocus($id) 
{
	document.getElementById($id).focus();
}

/* tasks.php */


/* za otvaranje i zatvaranje diva */

function openClose(id) 
{
	console.log(id);
	var numId = id.substring(6);
	var zadId = document.getElementById("zadaciGlobal" + numId);
	if(zadId.style.display == "none")
	{
		zadId.style.display = "block";
	} else 
	{
		zadId.style.display = "none";
	}
}