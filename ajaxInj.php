<?php

include_once "functions/dataLogin.php";


/* manager.php injektanje da li je zadatak obavlje, tj line through */

if(!empty($_GET["checkId"]) && !empty($_GET["checked"]) && !empty($_GET["checkSite"]) )
{
	$id = $_GET["checkId"];
	$check = $_GET["checked"];
	$site = $_GET["checkSite"];


	$tablica = "";
	if($site == "zaPoj") 
	{
		$tablica = "pojediniTask";
	}
	else
	{
		$tablica = "tasks";
	}

	echo "Ovo je tablica " . $tablica;



	if($check == "yes") 
	{
		$sql_yes = "UPDATE $tablica SET `checked`='yes' WHERE id=:id";
		$promjeniYes = $conn->prepare($sql_yes);
		$promjeniYes->bindParam(":id", $id);
		$promjeniYes->execute();

	}
	elseif($check == "no")
	{
		$sql_no = "UPDATE $tablica SET `checked`='no' WHERE id=:id";
		$promjeniNo = $conn->prepare($sql_no);
		$promjeniNo->bindParam(":id", $id);
		$promjeniNo->execute();	
	}
}



/* tasks.php ubacujemo pojedine taskove */
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


/* tasks.php delete button */

if( !empty($_GET["deleteTasks"]) )
{
	$idDel = $_GET["deleteTasks"];

	$sqlDelete = "DELETE FROM `pojediniTask` WHERE `pojediniTask`.`id` = :idDel";
	$sqlBrisi = $conn->prepare($sqlDelete);
	$sqlBrisi->bindParam(":idDel", $idDel);
	$sqlBrisi->execute();
}


?>
