<?php
session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Task Manager v1.2</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="managerStyle.css">


</head>
<body>

<header>
	<nav>
		<div id="navigacija">

			<!-- HOME, LIJEVA STRANA NAVIGACIJE -->

			<div id="navLijevo">
				<ul>
					<li><a href="manager.php">Daily</a></li>
					<li><a href="tasks.php">Tasks</a></li>
				</ul>
			</div>


			<!-- LOGIN I LOGOUT, DESNA STRANA NAVIGACIJE -->
			<?php

			if( !isset($_SESSION["user_id"]) )
			{
			echo '
			<div id="navDesno">
				<ul>
					<li><a href="registracija.php">Registracija</a></li>
					<li><a href="login.php">Logiraj se</a></li>

				</ul>
			</div>
			';
			} else
			{
				echo '
					<div id="navDesno">
						<ul>
							<li>' . $_SESSION["user"] . '</li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				';


			}

			?>
		</div>
	</nav>
</header>

