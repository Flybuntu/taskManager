<?php

include_once "functions/dataLogin.php";

$id = $_GET["id"];
$check = $_GET["checked"];

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






?>
