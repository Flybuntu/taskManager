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
		$inputDay = "input" . $day;

		echo '
			<div class="divDani" id="'.$day.'">
				<div class="formUpis">
					<h2 class="danNaslov">'.ucfirst($day).':</h2>

					<form id="'.$formDay.'" name="'.$formDay.'" class="formTje" method="POST" action="" onsubmit=\'setFocusCookie("'.$inputDay.'")\'>

						<input type="text" class="upisPodaci" name="upis" id="'.$inputDay.'"/>
						<input type="text" name="dan" class="danSakrij" value="'.$day.'">
						<button class="subKalendar">Enter task</button>

					</form>
				</div>
				<hr/>

			';
			;

				/* zadaci za svaki dan */
				foreach($sqlArray as $zadatak) 
				{
					echo 
						'

						<div class="zadaci" id="zadaci'.$zadatak["id"].'">

							<form class="deleteForm" name="delete'.$zadatak["id"].'" id="delete'.$zadatak["id"].'" method="POST" action="" onsubmit="clearCookieForm()" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check' . $zadatak["id"] . '" class="checkBox" '; 
					if($zadatak["checked"] == "yes" ) /* ovo je za ak smo obavili zadatak da ga precrta */
					{
						echo "checked";
					} else
					{
						echo "";
					}
					echo	'><label for="check' . $zadatak["id"] . '"><span></span>' . $zadatak["task"] . '</label>

								<input type="text" name="delete" class="danSakrij" value="'.$zadatak["id"].'">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
							<button class="editDaily" id="editDaily'.$zadatak["id"].'">Edit</button>
							<button class="confirmDailyEdit" id="confirmDailyEdit'.$zadatak["id"].'">Confirm</button>

						</div>
						<hr/>
					' ;
				}
				

	echo	'</div>';
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
		$sql_title = 'SELECT id, task_name, opened FROM `tasksGlobal` WHERE user_id = :user ORDER BY opened'; 
		$tasksTitle = $conn->prepare($sql_title);
		$tasksTitle->bindParam(":user", $_SESSION["user_id"]);
		$tasksTitle->execute();



		/* Prvo upisujemo naslov */
		foreach( $tasksTitle->fetchAll(PDO::FETCH_ASSOC ) as $title) {

			/* ovdje je sql za zadatke za svaki naslov */
			$sql_tasks = 'SELECT `id`, `tasks`, `checked` FROM `pojediniTask` WHERE task_id = :task_id ORDER BY checked DESC';
			$tasks = $conn->prepare($sql_tasks);
			$tasks->bindParam(":task_id", $title["id"]);
			$tasks->execute();
			$zadatakId = "zadatak" . $title["id"];

	
			echo 
				'	
				<div class="naslov" id="naslov' . $title["id"] . '" >
			
					<h2>' . $title["task_name"] . '</h2>
					<button class="brisiNaslov" id="brisiNaslov' . $title["id"] . '" onclick="deleteGlobal(this.id)">X</button>
					<button class="sakrij" id="sakrij' . $title["id"] . '" onclick="openClose(this.id)">
						<div class="upGumb" id="upDown' . $title["id"] . '"></div>
					</button>
					
					<div id="zadaciGlobal' . $title["id"] . '" class="zadaciGlobal">


						<label for="' .$zadatakId . '">
						<input type="text" name="' .$zadatakId . '" id="' .$zadatakId . '" class="zadatakInput"></label>
						<button class="upisPodataka" onclick="tasksInj('.$zadatakId.')">Upis</button>
						<hr/>


				';

				/* Ovdje upisuje zadatke ispod svakog naslova*/
				foreach( $tasks->fetchAll(PDO::FETCH_ASSOC) as $tekst )
				{
					$zadTekstId = "zaPoj" . $tekst["id"];
					$delButId = "butDel" . $tekst["id"];

					echo '
						<div class="divCheck">
						<input type="checkbox" name="' . $zadTekstId . '" class="checkBox"';
						/* precrtavamo chekirane */
						if($tekst["checked"] == "yes") { echo "checked"; }
						else { echo ""; }
						
						echo '
						id="' . $zadTekstId . '">
						<label for="' . $zadTekstId . '"><span></span>' . $tekst["tasks"] . '</label>
						<button class="deleteButton" id="' . $delButId . '">Delete</button><br/>
						</div>
						<hr/>
						';


				}
				echo '</div></div>';
		} 
	}
}







?>