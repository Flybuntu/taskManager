<?php

include_once "functions/dataLogin.php";


/* manager.php injektanje da li je zadatak obavlje, tj line through */

if(!empty($_GET["manLinId"]) && !empty($_GET["manLinChecked"]) )
{
	$id = $_GET["manLinId"];
	$check = $_GET["manLinChecked"];

	if($check == yes) 
	{
		$sql_yes = "UPDATE `tasks` SET `checked`='yes' WHERE id=:id";
		$promjeniYes = $conn->prepare($sql_yes);
		$promjeniYes->bindParam(":id", $id);
		$promjeniYes->execute();

	}
	elseif($check == no)
	{
		$sql_yes = "UPDATE `tasks` SET `checked`='no' WHERE id=:id";
		$promjeniYes = $conn->prepare($sql_yes);
		$promjeniYes->bindParam(":id", $id);
		$promjeniYes->execute();	
	}
}



/* tasks.php upacujemo pojedine taskove */
if( !empty($_GET["taskGlobalValue"]) && !empty($_GET["taskGlobalId"]) )
{
	$value = $_GET["taskGlobalValue"];
	$id = $_GET["taskGlobalId"];
	$sql = 'INSERT INTO `pojediniTask`(`task_id`, `tasks`, `checked`) 
					VALUES (:id, :task, "no")';
	$ubaciTask = $conn->prepare($sql);
	$ubaciTask->bindParam(":id", $id);
	$ubaciTask->bindParam(":task", $value);
	$ubaciTask->execute();

}


?>
