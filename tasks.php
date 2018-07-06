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
	<form id="formGlobalTasks" action="" method="POST" name="formGlobalTasks">
		<label for="taskTitle">Task:</label> <input type="text" name="titleName" id="titleName" >
			<button>Enter task</button>
	</form>

	
	<?php
		Funkcije::upisHTMLTasks();
	
	?>




</main>

<script type="text/javascript" src="managerScript.js"></script>
