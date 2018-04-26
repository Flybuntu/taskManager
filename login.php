<?php

require "functions/dataLogin.php";
require_once "header.php";

/* Ako je u logiran ide na index.php */
if ( isset($_SESSION["user_id"]) )
{
	header("Location: manager.php");
}


/* LOGIN PROVJERA */

if ( !empty($_POST["name"]) && !empty($_POST["pass"]) )
{
	$user = $conn->prepare("SELECT id, user, password FROM users WHERE user = :name");
	$user->bindParam( ":name", $_POST["name"] );
	$user->execute();

	$results = $user->fetch(PDO::FETCH_ASSOC);
	$message = "";

	var_dump($results);

	if( count($results) > 0 && password_verify($_POST["pass"], $results["password"]) )
	{
		$_SESSION["user_id"] = $results["id"];
		$_SESSION["user"] = $results["user"];
		header("location: manager.php");
	}
	else
	{
		$message = "<div class='notification'><p class='regNot'>You did not login!</p></div>"; 
	}

}

if( !empty($message) )
{
	echo $message;
}





?>


<!-- LOGIN FORMA -->
<main>
	<div id="logFormDiv">
		<form action="" method="POST">
			<label for="name">Name:</label>
			<input type="text" name="name">
			<label for="pass">Password:</label>
			<input type="password" name="pass">
			<button type="submit" id="login" name="login">Login</button>
		</form>
	</div>
</main>