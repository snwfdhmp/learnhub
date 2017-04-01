<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>


	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<script>
		var menuOpen = false;
		var menuShown = false;
		var navigation = {
			0:"Maths",
			1:"Méca",
			2:"ELG",
			3:"SDA",
			4:"ISER",
			5:"WEB",
			6:"MIN",
			7:"ENI",
			8:"IAR"
		};

		var infoUser = {
			"prenom":"Martin",
			"nom":"JOLY",
			"promo":"L1"
		}

		function createMatiereIconsFromJson(data) {
			var container = $("#matiereMenuContainer");
			for(var i = 0; data[i]; i++) {
				var newDiv = document.createElement("div");
				newDiv.className = 'matiereIcon';
				newDiv.innerHTML = data[i];
				newDiv.onmouseover = function() {
					$(this).animate({borderRadius:'+=10px'}, "fast");
					$(this).css('background-color', "#d77");
				}
				newDiv.onmouseout = function() {
					$(this).animate({borderRadius:'-=10px'}, "fast");
					$(this).css('background-color', "#d66");
				}
				container.append(newDiv);
			}
		}

		function fillUserInfosFromJson(data) {
			$("#profileInfosContainer #nom").text(data["nom"]);
			$("#profileInfosContainer #prenom").text(data["prenom"]);
			$("#profileInfosContainer #promo").text(data["promo"]);
		}


		function init() {
			createMatiereIconsFromJson(navigation);
			fillUserInfosFromJson(infoUser);
		}

		function expandMenu() {
			if(menuOpen==false) {
				$(".menu").animate({width:'20%'});
				setTimeout(function(){$(".menuText").show()},150);
				$(".menuText").animate({opacity:'1'}, 1000);
				menuOpen = true;
			}
			else {
				$(".menuText").animate({opacity:'0'});
				$(".menuText").hide();
				$(".menu").animate({width:'40px'});
				menuOpen=false;
			}
		}

		function onClickNotification() {
			$("#dropDownBulle").left = $(".fa-comments").position().left;
			$("#dropDownBulle").top = $(".fa-comments").position().top;
			$("#dropDownBulle").show();
		}

	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="content">
		<? include_once "layouts/leftside.php" ?>
		<div class="center">
			<button id="addCourseBtn">+ Ajouter</button>
			<h2>DOCUMENT</h2>
			<div class="justCenter">
				<table id="documentInfos">
					<tr>
						<th>Date</th>
						<th>Promo</th>
						<th>Matière</th>
						<th>Nom</th>
						<th>Corrigé</th>
						<th>Publié par</th>
					</tr>
					<tr>
						<td>01/03</td>
						<td>LE1</td>
						<td>Maths</td>
						<td>Exercice n°2 Polynômes</td>
						<td>OUI</td>
						<td>Martin JOLY (LE1)</td>
					</tr>
				</table>
			</div>
			<!--
			Pour gérer l'affichage d'un profil (bof bof)
			<div id="profileInfosContainer">
				<table id="profileInfos">
					<tr>
						<td id="nom">Joly</td>
					</tr>
					<tr>
						<td id="prenom">Remy</td>
					</tr>
					<tr>
						<td id="promo">L1</td>
					</tr>
				</table>
			</div>-->

		</div>
		<? include_once "layouts/rightside.php" ?>
		<? include_once "layouts/menu.php" ?>
		</div>
	</body>
	</html>