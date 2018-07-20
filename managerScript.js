/* Da znamo na kojem smo siteu */

var siteLocArr = window.location.pathname.split("/");
siteLocation = siteLocArr[siteLocArr.length-1];
console.log(siteLocation);



/* Vracamo focus na input nakon entera !Trenutno nije u funkciji */

function putFocus(id) 
{
	document.getElementById(id).focus();
}

/* manager.php sredivanje cookie-je za focus */

function setFocusCookie(id)
{
	/* Stvaramo cookie-je radi focus-a */

	document.cookie = "idZaFocusMan=" + id;
}

console.log(document.cookie);

/* ovo je radi focusa*/


if(siteLocation == "tasks.php"  || siteLocation == "manager.php")
{
	var keksi = document.cookie.split("; ");
	console.log("Ovo su keksi " + keksi);

	for(var i=0; i<keksi.length; i++)
	{
		var odvajanje = keksi[i].split("=");
		console.log(odvajanje);
		if(odvajanje[0] == "idZaFocus" && siteLocation[siteLocation.length-1] == "tasks.php")
		{
	    putFocus(odvajanje[1]);
		} 
		else if(odvajanje[0] == "idZaFocusMan" && siteLocation[siteLocation.length-1] == "manager.php" && odvajanje[1] != '')
		{
			console.log(odvajanje[1]);
			putFocus(odvajanje[1]);
		}
	}
}


/* Ovo je kod manager.php radi brisanje cookie da nas focus ne zajebava kad brisemo */
function clearCookieForm() {
	document.cookie = "idZaFocusMan=";
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


/* tasks.php dodajemo pojedinacne zadatke*/

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

	


	document.cookie = "idZaFocus=" + cistiId;

	/* Te reload da se tablica ispise*/
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

	var numId = id.substring(6);
	var zadId = document.getElementById("zadaciGlobal" + numId);
	var imeId = "zadaciGlobal" + numId;
	var goreDoleId = "upDown" + numId;

	var xhr = new XMLHttpRequest();

	if(zadId.style.display == "none")
	{
		zadId.style.display = "block";
		document.getElementById(goreDoleId).classList.add("upGumb");
		document.getElementById(goreDoleId).classList.remove("downGumb");
		xhr.open("GET", "ajaxInj.php?openClose=yes&openCloseId=" + numId);
	} else 
	{
		zadId.style.display = "none";
		document.getElementById(goreDoleId).classList.add("downGumb");
		document.getElementById(goreDoleId).classList.remove("upGumb");
		xhr.open("GET", "ajaxInj.php?openClose=no&openCloseId=" + numId);

	}

	xhr.send();
}


/* tasks.php check for open and closed windows on load */

function checkOpenClose() 
{


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

			for(var i=0; i<arrOpenClose.length; i++)
			{
				var idZatvori = "zadaciGlobal" + arrOpenClose[i]["id"];
				var idUpDown = "upDown" + arrOpenClose[i]["id"];

				if(arrOpenClose[i]["opened"] == "no")	
				{
					document.getElementById(idZatvori).style.display = "none";
					document.getElementById(idUpDown).classList.add("downGumb");
					document.getElementById(idUpDown).classList.remove("upGumb");

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


/* manager.php edit */

/* svim editima prvo dajemo evenet */

var editManager = document.getElementsByClassName("editDaily");

for(var i=0; i<editManager.length; i++)
{
	editManager[i].addEventListener("click", editMan);
}

/* manager.php za editiranje upisa prva faza formu mjenjamo u input */

function editMan()
{
	var idNum = this.id.slice(9);
	var divName = "zadaci" + idNum;

	var divEdit = document.getElementById(divName);

	

	document.getElementById(this.id).style.display = "none";

	var xhr = new XMLHttpRequest();

	xhr.open("GET", "ajaxInj.php?idEditMan=" + idNum, true );

	xhr.send()
	console.log(xhr);

	xhr.onreadystatechange = function() 
	{
		if(this.readyState == 4  && this.status == 200)
		{
			var s = this.responseText;
			var task = JSON.parse(s);
			var confirmId = "confirmDailyEdit" + idNum;

			var gumb = "<button id=" + confirmId + " class='confirmDailyEdit'>Confirm</button><br/><br/>";

			console.log(task[0].task);
	
			/* Pretvaramo form u input */

			var inputId = "editInputMan" + idNum;

			divEdit.innerHTML = "<input class='upisPodaci' id=" + inputId + "   type='text' value='" + task[0].task + "' maxlength='58' >" + gumb;
			document.getElementById(confirmId).style.display = "block";

			/* For event listeners, for input "enter" and for button "click" */
			
			var confirmId = "confirmDailyEdit" + idNum;
			document.getElementById(confirmId).addEventListener("click", editManCon);
			console.log("Firefox sta seres!");
			var idInput = "editInputMan" + idNum;
			var inputTrenutni = document.getElementById(idInput);
			inputTrenutni.addEventListener("keydown", function(e) {
			if(e.keyCode === 13 ) {
				editManCon(idNum);
			}
	});



		}

	}
}


/* manager.php druga faza editiranja upisa */

function editManCon(id) {

	/* Da znamo koji id trebamo promjeniti*/
	var idBroj = 0;
	var poslano = "";

	if(id)
	{
		idBroj = id;
	}

	if(this.id) {
		idBroj = this.id.slice(16);
	}

	/* Text koji mjenjamo */
	var textId = "editInputMan" + idBroj;
	var text = document.getElementById(textId).value;

	var xhr = new XMLHttpRequest();

	xhr.open("POST", "ajaxInj.php?editManChangeId=" + idBroj + "&textManChange=" + text, true);	
	
	xhr.send();
	
	
	/* Ovo sam morao radi firefoxa reloadao je prije neg sto bi AJAX obavio posao */
	xhr.onreadystatechange = function() 
	{
		if(this.readyState == 4  && this.status == 200)
		{
			location.reload();
		}
	}


}


/* tasks.php edit text */

if(siteLocation == "tasks.php") 
{
	var editGumbiGlobal = document.getElementsByClassName("editButton");
	for(var i=0; i<editGumbiGlobal.length; i++ )
	{
		editGumbiGlobal[i].addEventListener("click", editTasksGlobal, true);
	}
}

function editTasksGlobal() {
	var id = this.id.slice(10);
	var divId = "divCheckId" + id;
	var divGet = document.getElementById(divId);
	var inputId = "editInputGlo" + id;
	var confirmIdGlo = "confirmIdGlobal" + id;

	/* html koji ubacujemo nakon sto stisnemo edit */
	var inputEditHtml = "<input type='text' class='upisPodaci' id='" + inputId +"' />";
	var gumb = "<button id=" + confirmIdGlo + " class='confirmGlobalEdit'>Confirm</button><br/><br/>";

	divGet.innerHTML = inputEditHtml + gumb;


}

