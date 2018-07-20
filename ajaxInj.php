<?php

include_once "functions/dataLogin.php";


/* manager.php i tasks.php injektanje da li je zadatak obavlje, tj line through */

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

/* tasks.php delete Global tasks button */

if( !empty($_GET["brisiGlobal"]) )
{
	$brisiSql = "DELETE FROM `tasksGlobal` WHERE `tasksGlobal`.`id` = :id";
	$brisiGlobal = $conn->prepare($brisiSql);
	$brisiGlobal->bindParam(":id", $_GET["brisiGlobal"]);
	$brisiGlobal->execute();

}

/* tasks.php checking if it is open or closed and send JSON array */

if( !empty( $_GET["checkOpenClose"]) )
{
	$sql = "SELECT id, opened FROM `tasksGlobal`";
	$check = $conn->prepare($sql);
	$products = array();

	if($check->execute())
	{
		while($row = $check->fetch(PDO::FETCH_ASSOC))
		{
			$products[] = $row;
		}
	}


	echo json_encode($products);
}


/* tasks.php mijenjamo u bazi podatke za open close */

if( !empty($_GET["openClose"]) && !empty($_GET["openCloseId"]) )
{

	$sql = "UPDATE `tasksGlobal` SET `opened` = :openClose WHERE `tasksGlobal`.`id` = :id";
	$change = $conn->prepare($sql);
	$change->bindParam(":openClose", $_GET["openClose"]);
	$change->bindParam(":id", $_GET["openCloseId"]);
	$change->execute();

}


/* manager.php za editiranje upisa trebaju mi prvo podaci koje cu editirati prva faza */
if( !empty($_GET["idEditMan"]))
{
	$sql = "SELECT task FROM `tasks` WHERE id = :id";
	$getTask = $conn->prepare($sql);
	$getTask->bindParam(":id", $_GET["idEditMan"]);

	$tasks = array();

	if($getTask->execute())
	{
		while($row = $getTask->fetch(PDO::FETCH_ASSOC))
		{
			$products[] = $row;
		}
	}

	echo json_encode($products);
}

/* manager.php mjenjenje podataka druga faza */

if( !empty($_GET["editManChangeId"]) && !empty($_GET["textManChange"]) )
{
	$sql = "UPDATE `tasks` SET `task` = :task WHERE `tasks`.`id` = :id;";
	$textChange = $conn->prepare($sql);
	$textChange->bindParam(":task", $_GET["textManChange"]);
	$textChange->bindParam(":id", $_GET["editManChangeId"]);
	$textChange->execute();
}


if( !empty($_GET["editGlobalInfoId"]))
{
	$sql = "SELECT `tasks` FROM `pojediniTask` WHERE id = :id";
	$getTask = $conn->prepare($sql);
	$getTask->bindParam(":id", $_GET["editGlobalInfoId"]);
	$rezultati = array();
	
	if($getTask->execute())
	{
		while($row = $getTask->fetch(PDO::FETCH_ASSOC))
		{
			$rezultati[] = $row;
		}
	}

	echo json_encode($rezultati);

}

if( !empty($_GET["gloEditId"]) && !empty($_GET["gloEditText"]) )
{
	$sql = "UPDATE `pojediniTask` SET `tasks` = :tasks WHERE `pojediniTask`.`id` = :id;";
	$promjeni = $conn->prepare($sql);
	echo $_GET["gloEditText"] . $_GET["gloEditId"];
	$promjeni->bindParam(":tasks", $_GET["gloEditText"]);
	$promjeni->bindParam(":id", $_GET["gloEditId"]);
	$promjeni->execute();

}

?>
