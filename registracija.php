<?php

/* Prebacivanje na manager.php ak je vec u logiran */
if ( isset($_SESSION["user_id"]) )
{
	header("Location: manager.php"); 
}

require "header.php";
require "functions/dataLogin.php";

$message = "";


if ( !empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['pass']) )
{
	$name = $_POST['name'];
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];

	$kopija = "";


	/* PROVJERA DALI SE UPISI PONAVLJAJU */

	$sql_sel = 'SELECT user, email FROM users';
	$user_baza = $conn->prepare($sql_sel);
	$egzekucija = $user_baza->execute();
	
	foreach($user_baza as $user)
	{
		if($user["user"] == $name)
		{
			$message = "Name is already used, please choose a another one!";
			$kopija = true;
			break;
		}
		elseif($user["email"] == $mail)
		{
			$message = "Email is already in use, please choose a another one!";
			$kopija = true;
			break;
		}
	}


	/* UNOS PODATAKA U BAZA */

	if(!$kopija) 
	{
		$sql_ins = "INSERT INTO users(`user`, `password`, `email`) VALUES (:user, :password, :email) ";
		$user_ins = $conn->prepare($sql_ins);
		$user_ins->bindParam(':user', $name);
		$user_ins->bindParam(':password', password_hash($pass, PASSWORD_BCRYPT));
		$user_ins->bindParam(':email', $mail);

		if ( $user_ins->execute() )
		{
			$message = $name . " uspjesno ste registrirani, povratak na <a href='login.php'>prijavu</a>"; 
		}
		else
		{
			$message = "Registracija nije uspijela!";
		}
	}
}

/* Notifikacija */
if(!empty($message) ) 
{
	echo "<div class='notification'><p class='regNot'>" . $message . "</p></div>";
}


?>

<!-- FORMA ZA REGISTRACIJU -->
<main>
	<div id="regFormDiv">
		<form action="" method="POST">
			<label for="name">Name:</label>
			<input type="text" class="inTeFoRe" name="name"/>
			<label for="mail">Email:</label>
			<input type="email" class="inEmFoRe" name="mail"/>
			<label for="pass">Password:</label>
			<input type="password" class="inPaFoRe" name="pass"/>
			
			<button type="submit" id="registriraj" name="registriraj">Register</button>



		</form>
	</div>

</main>