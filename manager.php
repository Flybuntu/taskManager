<?php
include_once "header.php";
include_once "functions/dataLogin.php";
include_once "funkcije.php";

/* */


/* Ubacujem dnevne zadatke u mysql tablicu task*/
if( !empty($_POST["upis"]) )
{
	Funkcije::addTaskSQL($_POST["dan"], $_SESSION["user_id"], $_POST["upis"]);

}

if ( !empty($_POST["delete"]) )
{
	$sql_del = 'DELETE FROM tasks WHERE id = :id';
	$delete_row = $conn->prepare($sql_del);
	$delete_row->bindParam(":id", $_POST["delete"]);
	$delete_row->execute();
}

?>
	<main>
		<div class="unutarMain">
			<h1>Daily Tasks</h1>


				<?php

					$tjedan = ["ponedeljak", "utorak", "srijeda", "cetvrtak", "petak", "subota", "nedjelja"];

					/* Dan forme i Upis taskova na site */
					foreach($tjedan as $dan)
					{
						$sql = 'SELECT id, task, day, checked FROM `tasks` WHERE user_id = :user_id AND day = :day';
						$zadaci = $conn->prepare($sql);
						$zadaci->bindParam(":user_id", $_SESSION["user_id"]);
						$zadaci->bindParam(":day", $dan);
						$zadaci->execute();
						Funkcije::addHTMLForm($dan, $zadaci->fetchAll(PDO::FETCH_ASSOC) );
						
					}
					
					
					
					
			
						

					


				?>

				<div class="clear"></div>
		</div>
	</main>

<script type="text/javascript" src="managerScript.js"></script>
</body>
</html>