/* Da znamo na kojem smo siteu */

var siteLocation = window.location.pathname.split("/");


/* ovo je radi focusa*/

var keksi = document.cookie.split("; ");
var keksiSlozeni = {};

for(var i=0; i<keksi.length; i++)
{
	var odvajanje = keksi[i].split("=");
	if(odvajanje[0] == "idZaFocus")
	{
    document.getElementById(odvajanje[1]).focus();

	}
}


/* manager.php Ovdje koristimo AJAX da vidimo jel smo obavili zadatak */

/* Sve checkBoxove bacamo u varijablu */
var checkBoxes = document.getElementsByClassName("checkBox");

/* Te svakom checkboxu dajemo event listener sa funkcijom */
for(var i=0; i<checkBoxes.length; i++)
{
	checkBoxes[i].addEventListener("click", checkFunction);
}


/* Tu injektamo u sql jel chekirano ili nije */
function checkFunction() 
{ 

	var xhr = new XMLHttpRequest();

	var id = this.id;
	console.log(id.substring(0,5));

	if(this.checked == true)
	{
		xhr.open(
			"GET", 
			"ajaxInj.php?checkId=" + id.substring(5) + "&checked=yes" + "&checkSite=" + id.substring(0,5), 
			true);
	}
	else
	{
		xhr.open(
			"GET", 
			"ajaxInj.php?checkId=" + id.substring(5) + "&checked=no" + "&checkSite=" + id.substring(0,5), 
			true);
	}




	xhr.send();


}





/* manager.php Vracamo focus na input nakon entera !Trenutno nije u funkciji */

function putFocus($id) 
{
	document.getElementById($id).focus();
}



function tasksInj(task)
{	

	taskId = task.id.substring(7);
	taskInj = task.value;
	zadaciId = "zadaciGlobal" + taskId;
	cistiId = task.id;

	console.log("Proba: " + task.id);

	var zadGloId = "zadaciGlobal" + taskId;


	var xhr = new XMLHttpRequest();



	xhr.open("GET", "ajaxInj.php?taskGlobalValue=" + taskInj + "&taskGlobalId=" + taskId , true);

	xhr.send();

	var poruka = '<div class="divCheck"><input type="checkbox" name="zadatakPoj1" class="checkBox" id="zadatakPoj1"><label for="zadatakPoj1"><span></span>nekakav task</label><button class="deleteButton">Delete</button><br/>';
	


	document.cookie = "idZaFocus=" + cistiId;

	location.reload();



}

/* Ovo ispod je zbog entera */
var tasksUpis = document.getElementsByClassName("zadatakInput");
for(var i=0; i<tasksUpis.length; i++)
{

	tasksUpis[i].addEventListener("keydown", function(e) {
		if(e.keyCode === 13) {
			var id = this;
			tasksInj(id);
		}
	});
}


/* tasks.php delete button za pojednine mini zadatke*/

var deleteButtons = document.getElementsByClassName("deleteButton");

for(var i = 0; i<deleteButtons.length; i++) 
{
	deleteButtons[i].addEventListener("click", deleteTasks);
}

function deleteTasks() {
	var id = this.id;
	console.log(id);

	var xhr = new XMLHttpRequest();

	xhr.open("GET", "ajaxInj.php?deleteTasks=" + id.substring(6), true);

	xhr.send();

	location.reload();

}

/* tasks.php delete button za globalne zadatke */

function deleteGlobal(ajdi) {
	
	console.log("u delete globalu sam!");

	var id = ajdi;

	console.log(id.substring(11));

	var xhr = new XMLHttpRequest();

	xhr.open("GET", "ajaxInj.php?brisiGlobal=" + id.substring(11), true);

	xhr.send();

	location.reload();
	
}


/* tasks.php za otvaranje i zatvaranje diva */

function openClose(id) 
{

	console.log(id);
	var numId = id.substring(6);
	var zadId = document.getElementById("zadaciGlobal" + numId);
	var imeId = "zadaciGlobal" + numId;

	var xhr = new XMLHttpRequest();

	if(zadId.style.display == "none")
	{
		zadId.style.display = "block";
		xhr.open("GET", "ajaxInj.php?openClose=yes&openCloseId=" + numId);
	} else 
	{
		zadId.style.display = "none";
		xhr.open("GET", "ajaxInj.php?openClose=no&openCloseId=" + numId);

	}

	xhr.send();
	console.log(xhr);
}


/* tasks.php check for open and closed windows on load */

function checkOpenClose() 
{

	console.log("U check open closeu sam!");

	var prozori = document.getElementsByClassName("zadaciGlobal");

	var xhrCheck = new XMLHttpRequest();

	xhrCheck.open("GET", "ajaxInj.php?checkOpenClose='1'", true);

	xhrCheck.send();


	xhrCheck.onreadystatechange = function() 
	{
		if(this.readyState == 4  && this.status == 200)
		{
			var s = this.responseText;
			var arrOpenClose = JSON.parse(s);
			console.log(arrOpenClose);

			for(var i=0; i<arrOpenClose.length; i++)
			{
				var idZatvori = "zadaciGlobal" + arrOpenClose[i]["id"];

				if(arrOpenClose[i]["opened"] == "no")	
				{
					document.getElementById(idZatvori).style.display = "none";
				}
			}


		}
	}

}


/* Pokrecemo check close open ako smo u tasks.php */
if(siteLocation[siteLocation.length-1] == "tasks.php")
{
	checkOpenClose();
}