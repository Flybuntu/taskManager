

/* manager.php Ovdje koristimo AJAX da vidimo jel smo obavili zadatak */

/* Sve checkBoxove bacamo u varijablu */
var checkBoxes = document.getElementsByClassName("checkBox");

/* Te svakom checkboxu dajemo event listener sa funkcijom */
for(var i=0; i<checkBoxes.length; i++)
{
	checkBoxes[i].addEventListener("click", checkFunction);
}


/* Tu injektamo u sql jer chekirano ili nije */
function checkFunction() 
{ 
	console.log("u check functionu sam!");
	var xhr = new XMLHttpRequest();

	var id = this.id;
	console.log(id);

	if(this.checked == true)
	{
		xhr.open("GET", "ajaxInj.php?manLinId=" + id.substring(5) + "&manLinChecked=yes", true);
	}
	else
	{
		xhr.open("GET", "ajaxInj.php?manLinId=" + id.substring(5) + "&manLinChecked=no", true);
	}

	xhr.send();

}





/* manager.php Vracamo focus na input nakon entera !Trenutno nije u funkciji*/

function putFocus($id) 
{
	document.getElementById($id).focus();
}


/* tasks.php za otvaranje i zatvaranje diva */

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

/* tasks.php upis podataka u bazu podataka pomocu ajax */

document.getElementsByClassName("zadatakInput");


function tasksInj(task)
{
	console.log("nes");
	taskId = task.id.substring(7);
	taskInj = task.value;
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "ajaxInj.php?taskGlobalValue=" + taskInj + "&taskGlobalId=" + taskId , true);

	xhr.send();


}