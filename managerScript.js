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