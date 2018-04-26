<?php

include_once "functions/dataLogin.php";
include_once "funkcije.php";
include_once "header.php";

if( !empty($_POST["titleName"]) )
{
	Funkcije::addGlobalNaslovSQL($_POST["titleName"]);
}



?>


<main>
	
	<h1>Tasks</h1>
	<form id="formGlobalTasks" action="" method="POST">
		<label for="taskTitle">Ime Zadatka:</label> <input type="text" name="titleName" id="titleName" >
			<button onclick="openClose()">Enter task</button>
	</form>

	<div class="naslov" id="naslov321" >

		<h2>Naslov1</h2>
		<button class="sakrij" id="sakrij321" onclick="openClose(this.id)">^</button>
		
		<div id="zadaciGlobal321" class="zadaciGlobal">
			
			<form action="" method="POST">

				<label for="zadatak"></label>
				<input type="text" name="zadatak">
				<button>upis</button>

			</form>


			<form class="deleteForm" name="delete321" method="POST" action="" enctype="multipart/form-data">

				<input type="checkbox" id="check321" class="checkBox" checked><label for="checkBox">proba</label>

				<input type="text" name="delete" class="danSakrij" value="39">
				<button class="deleteButton">X</button>

			</form>


			<form class="deleteForm" name="delete40" method="POST" action="" enctype="multipart/form-data">

				<input type="checkbox" id="check40" class="checkBox" ><label for="checkBox">fadfasdf</label>

				<input type="text" name="delete" class="danSakrij" value="40">
				<button class="deleteButton">X</button>

			</form>
			
		</div>

	</div>

	<div class="naslov" id="naslov32" >
		<h2>Naslov2</h2>
				<button class="sakrij" id="sakrij32" onclick="openClose(this.id)">^</button>

		<div id="zadaciGlobal32">
				<label></label><input type="" name="zadatak">
							<button>upis</button>
							<br>

			<input type="checkbox" name="zadatak32" value="zadatak21">
			<label for="zadatak32">Nekakav zadatak</label>
			<button class="deleteButton">X</button>
			<br>
			<input type="checkbox" name="zadatak32" value="zadatak21">
			<label for="zadatak32">Nekakav zadatak2</label>
			<button class="deleteButton">X</button>


		</div>

	</div>

	<div class="naslov" id="naslov312" >
		<h2>Naslov3</h2>
				<button class="sakrij" id="sakrij312" onclick="openClose(this.id)">^</button>

		<div id="zadaciGlobal312">
			<input type="" name="">
			<button>upis</button>

			<p>zadatak 1</p>	
			<p>zadatak 2</p>

		</div>

	</div>
	<?php
		Funkcije::upisHTMLTasks();
	
	?>




</main>

<script type="text/javascript" src="managerScript.js"></script>