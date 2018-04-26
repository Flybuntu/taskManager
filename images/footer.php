<div id="footer">
	<div id="footerTextLeft">
		<h3>ICC SERVICE TOTAL</h3>
		<p>Tel: 01/2044-099</p>
		<p>Tel: 01/2044-099</p>
		<p>Radnicka 75</p>


	</div>

</div>
<div id="footerDno">
	<div id="footerDnoText">
		<p>© 2017</p>
	</div>
</div>

	<script type="text/javascript">
		var ele = document.getElementById("navBar");
		var naslov = document.getElementById("naslov");
		console.log(naslov);

		document.getElementById("menuBar").onclick = function() {
			console.log(naslov);

			if(ele.classList.contains("nevidi")) {
				naslov.style.marginTop = "290px";
				ele.classList.toggle("vidi");
				ele.classList.remove("nevidi");
			} else if(ele.classList.contains("vidi")){
				naslov.style.marginTop = "50px";
				ele.classList.remove("vidi");
				ele.classList.add("nevidi");
			}	


		}
		
	</script>
</body>
</html>