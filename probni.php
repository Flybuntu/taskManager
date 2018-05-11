


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
			
					<div id="navDesno">
						<ul>
							<li>hrvoje</li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
						</div>
	</nav>
</header>

	<main>
		<div class="unutarMain">
			<h1>Daily Tasks</h1>


				
			<div class="divDani" id="ponedeljak">

				<h2 class="danNaslov">Ponedeljak</h2>

				<form id="formponedeljak" name="formponedeljak" class="formTje" method="POST" action="" onsubmit='putFocus("formponedeljak")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="ponedeljak">
					<button class="subKalendar">✓</button>

				</form>

			<div class="clear"></div>

						<div class="zadaci zadaciponedeljak">

							<form class="deleteForm" name="delete43" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check43" class="checkBox" checked><label for="check43"><span></span>sdfasdf</label>

								<input type="text" name="delete" class="danSakrij" value="43">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadaciponedeljak">

							<form class="deleteForm" name="delete48" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check48" class="checkBox" ><label for="check48"><span></span>fasdf</label>

								<input type="text" name="delete" class="danSakrij" value="48">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadaciponedeljak">

							<form class="deleteForm" name="delete49" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check49" class="checkBox" ><label for="check49"><span></span>fasdfasdf</label>

								<input type="text" name="delete" class="danSakrij" value="49">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadaciponedeljak">

							<form class="deleteForm" name="delete50" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check50" class="checkBox" ><label for="check50"><span></span>asdfasdf</label>

								<input type="text" name="delete" class="danSakrij" value="50">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					</div>
			<div class="divDani" id="utorak">

				<h2 class="danNaslov">Utorak</h2>

				<form id="formutorak" name="formutorak" class="formTje" method="POST" action="" onsubmit='putFocus("formutorak")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="utorak">
					<button class="subKalendar">✓</button>

				</form>

			<div class="clear"></div>

						<div class="zadaci zadaciutorak">

							<form class="deleteForm" name="delete42" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check42" class="checkBox" checked><label for="check42"><span></span>dsfsdagsfdgh</label>

								<input type="text" name="delete" class="danSakrij" value="42">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadaciutorak">

							<form class="deleteForm" name="delete51" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check51" class="checkBox" ><label for="check51"><span></span>asdfasdf</label>

								<input type="text" name="delete" class="danSakrij" value="51">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadaciutorak">

							<form class="deleteForm" name="delete52" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check52" class="checkBox" ><label for="check52"><span></span>dsafasdf</label>

								<input type="text" name="delete" class="danSakrij" value="52">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					</div>
			<div class="divDani" id="srijeda">

				<h2 class="danNaslov">Srijeda</h2>

				<form id="formsrijeda" name="formsrijeda" class="formTje" method="POST" action="" onsubmit='putFocus("formsrijeda")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="srijeda">
					<button class="subKalendar">✓</button>

				</form>

			<div class="clear"></div>

						<div class="zadaci zadacisrijeda">

							<form class="deleteForm" name="delete46" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check46" class="checkBox" ><label for="check46"><span></span>gsdfg</label>

								<input type="text" name="delete" class="danSakrij" value="46">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					</div>
			<div class="divDani" id="cetvrtak">

				<h2 class="danNaslov">Cetvrtak</h2>

				<form id="formcetvrtak" name="formcetvrtak" class="formTje" method="POST" action="" onsubmit='putFocus("formcetvrtak")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="cetvrtak">
					<button class="subKalendar">✓</button>

				</form>

			<div class="clear"></div>

						<div class="zadaci zadacicetvrtak">

							<form class="deleteForm" name="delete47" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check47" class="checkBox" ><label for="check47"><span></span>gsdfgsdfg</label>

								<input type="text" name="delete" class="danSakrij" value="47">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					<div class="clear"></div>

						<div class="zadaci zadacicetvrtak">

							<form class="deleteForm" name="delete53" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check53" class="checkBox" ><label for="check53"><span></span>asdfsadf</label>

								<input type="text" name="delete" class="danSakrij" value="53">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					</div>
			<div class="divDani" id="petak">

				<h2 class="danNaslov">Petak</h2>

				<form id="formpetak" name="formpetak" class="formTje" method="POST" action="" onsubmit='putFocus("formpetak")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="petak">
					<button class="subKalendar">✓</button>

				</form>

			<div class="clear"></div>

						<div class="zadaci zadacipetak">

							<form class="deleteForm" name="delete54" method="POST" action="" enctype="multipart/form-data">
								<div class="divCheck">
								<input type="checkbox" id="check54" class="checkBox" ><label for="check54"><span></span>fasdfasdfg</label>

								<input type="text" name="delete" class="danSakrij" value="54">
								<button class="deleteButton">Delete</button>
								</div>
							</form>
						</div>

					</div>
			<div class="divDani" id="subota">

				<h2 class="danNaslov">Subota</h2>

				<form id="formsubota" name="formsubota" class="formTje" method="POST" action="" onsubmit='putFocus("formsubota")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="subota">
					<button class="subKalendar">✓</button>

				</form>

			</div>
			<div class="divDani" id="nedjelja">

				<h2 class="danNaslov">Nedjelja</h2>

				<form id="formnedjelja" name="formnedjelja" class="formTje" method="POST" action="" onsubmit='putFocus("formnedjelja")'>

					<input type="text" class="upisPodaci" name="upis"/>
					<input type="text" name="dan" class="danSakrij" value="nedjelja">
					<button class="subKalendar">✓</button>

				</form>

			</div>
				<div class="clear"></div>
		</div>
	</main>

<script type="text/javascript" src="managerScript.js"></script>
</body>
</html>
