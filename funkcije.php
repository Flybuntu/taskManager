<?php

include_once "functions/dataLogin.php";

class Funkcije
{


	/* manager.php za dodavanje taskova u tjednu */
	
	public function addTaskSQL($day, $user_id, $task)
	{
		global $conn;

		$sql_ins = "INSERT INTO tasks (`user_id`, `task`, `day`) VALUES (:user_id, :task, :day)";
		$ubaci_pod = $conn->prepare($sql_ins);
		$ubaci_pod->bindParam(':user_id', $user_id);
		$ubaci_pod->bindParam(':task', $task);
		$ubaci_pod->bindParam(':day', $day);
		$ubaci_pod->execute();
		header("Location: manager.php"); // Ovo je radi reloada, tako da zaporavi $_POST
	}


	/* manager.php za upis html form za svaki dan, te za svaki dan task */
	
	public function addHTMLForm($day, $sqlArray) 
	{
		$formDay = 'form' . $day;

		echo '
			<div class="divDani" id="'.$day.'">
				<h2 class="danNaslov">'.$day.':</h2>

				<form id="'.$formDay.'" name="'.$formDay.'" class="formTje" method="POST" action="" onsubmit=\'putFocus("'.$formDay.'")\'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="'.$day.'">
					<button class="subKalendar">✓</button>

				</form>
			</div>';
			;

				/* zadaci za svaki dan */
				foreach($sqlArray as $zadatak) 
				{
					echo 
						'<div class="clear"></div>

						<div class="zadaci zadaci'.$day.'">

							<form class="deleteForm" name="delete'.$zadatak["id"].'" method="POST" action="" enctype="multipart/form-data">

								<input type="checkbox" id="check' . $zadatak["id"] . '" class="checkBox" '; 
					if($zadatak["checked"] == "yes" ) /* ovo je za ak smo obavili zadatak da ga precrta */
					{
						echo "checked";
					} else
					{
						echo "";
					}
					echo	'><label for="checkBox">' . $zadatak["task"] . '</label>

								<input type="text" name="delete" class="danSakrij" value="'.$zadatak["id"].'">
								<button class="deleteButton">X</button>

							</form>
						</div>


					' ;
				}
				

	echo	'
			
		';
	}

	/* tasks.php dodajemo naslov za globalne taskove */

	function addGlobalNaslovSQL($title) 
	{
		global $conn;
		$sql = "INSERT INTO tasksGlobal (`opened`, `task_name`, `user_id`) VALUES ('yes', :task_name, :user_id)";
		$naslov = $conn->prepare($sql);
		$naslov->bindParam(":task_name", $title);
		$naslov->bindParam(":user_id", $_SESSION["user_id"]);
		$naslov->execute();
		header("Location: tasks.php"); /* Ovo stavljamo da ne ponavlja zapise na reloadu */
	}

	
	/* tasks.php upis html podataka iz sql-a */

	function upisHTMLTasks()
	{


		global $conn;


		/* Uzimamo prvo naslov */
		$sql_title = 'SELECT id, task_name, opened FROM `tasksGlobal` WHERE user_id = :user';
		$tasksTitle = $conn->prepare($sql_title);
		$tasksTitle->bindParam(":user", $_SESSION["user_id"]);
		$tasksTitle->execute();



		/* Prvo upisujemo naslov */
		foreach( $tasksTitle->fetchAll(PDO::FETCH_ASSOC ) as $title) {

			/* ovdje je sql za zadatke za svaki naslov */
			$sql_tasks = 'SELECT `id`, `tasks`, `checked` FROM `pojediniTask` WHERE task_id = :task_id';
			$tasks = $conn->prepare($sql_tasks);
			$tasks->bindParam(":task_id", $title["id"]);
			$tasks->execute();
			$zadatakId = "zadatak" . $title["id"];

	
			echo 
			'	
				<div class="naslov" id="naslov' . $title["id"] . '" >
			
					<h2>' . $title["task_name"] . '</h2>
					<button class="sakrij" id="sakrij' . $title["id"] . '" onclick="openClose(this.id)">^</button>
					
					<div id="zadaciGlobal' . $title["id"] . '" class="zadaciGlobal">


						<label for="' .$zadatakId . '">
						<input type="text" name="' .$zadatakId . '" id="' .$zadatakId . '" class="zadatakInput"></label>
						<button onclick="tasksInj('.$zadatakId.')">upis</button>
						<br/>

				';

				/* Ovdje upisuje zadatke ispod svakog naslova*/
				foreach( $tasks->fetchAll(PDO::FETCH_ASSOC) as $tekst )
				{
					echo '
						<input type="checkbox" name="zadatakPoj' . $tekst["id"] . '" class="checkBox"';
						/* precrtavamo chekirane */
						if($tekst["checked"] == "yes") { echo "checked"; }
						else { echo ""; }
						
						echo '
						id="tasksCheck">
						<label for="checkBox"><p>' . $tekst["tasks"] . '</p></label>
						<button class="deleteButton">X</button><br/>
						';


				}

				echo '</div></div>';
				





			
		} 






	}


}







?>