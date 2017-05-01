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
		var itemsArea;
		var addArea;
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
			"promo":"L1",
			"idUser":1
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
			addArea= document.getElementById("addArea");
            itemsArea= document.getElementById("itemsArea");
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
		function showadd(){
			addArea.style.display="block";
            itemsArea.style.display="none";
		}
	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="content">
		<? include_once "layouts/leftside.php" ?>
		<div class="center">
				<div id="itemsArea">
				<?php 
					if($connected){
						echo '<button id="addCourseBtn" onclick="showadd()">+ Ajouter</button>';
					}
					if(isset($_GET["x"]) && $_GET["x"]=="upsucc") echo'<button id="succ">Upload Succeful</button>';
					if(!isset($_GET["x"]) || $_GET["x"]=="upsucc") echo'
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
							</div>';
			?>
			<?php
            if($_GET["x"]=="upfail") echo'<div id="addArea" style="display= block;">
            							 <button id="succ">Upload Failed</button>';
            else echo'<div id="addArea">';
            echo'
                <h2>Ajouter un document</h2>
                <div class="justCenter">
                	<form action="?u=accueil" enctype="multipart/form-data" method="POST">
                	<input type="hidden" name="action" id="action" value="addDoc">
                	<input type="hidden" name="auteur" id="auteur" value="1">
                	<p>Type :</p><select name="type">
                		<option value="1">Cours</option>
                		<option value="2">Exercice</option>
                		<option value="3">Annale</option>
                		<option value="4">Correction</option>
                	</select>
                	<p>Promo :</p><select name="promo">
                		<option value="1">LE1</option>
                		<option value="2">LE2</option>
                		<option value="3">LE3</option>
                		<option value="4">LE4</option>
                		<option value="5">LE5</option>
                		<option value="6">LA1</option>
                		<option value="7">LA2</option>
                		<option value="8">LA3</option>
                	</select>
                	<p>Matieres:</p><select name="matiere">
                		<option value="1">ENI</option>
                	</select>
                	<p>Chapitre:</p><select name="chapitre">
                		<option value="1">Transfo</option>
                	</select>
                	<p>Nom:</p><br>
                	<input type="text" name="nom">
                	<p>le document</p><input type="file" name="doc" id="doc" /><br>
                	<input type="submit" name="submit"  value="envoyer">
                	</form>
                </div>
            </div>
		</div>';?>
		<? include_once "layouts/rightside.php" ?>
		<? include_once "layouts/menu.php" ?>
		</div>
	</body>
	</html>