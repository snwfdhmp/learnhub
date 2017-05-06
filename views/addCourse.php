<? 
$auth->requiresAuth();
$GLOBALS['active_view']="addCourse";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/addCourse.css">
	<link rel="stylesheet" href="../ressources/css/menu.css">
	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
				var newDiv = document.createElement("li");
				newDiv.className = 'matiereIcon';
				newDiv.innerHTML = data[i];
				/*newDiv.onmouseover = function() {
					$(this).animate({borderRadius:'+=10px'}, "fast");
					$(this).css('background-color', "#d77");
				}
				newDiv.onmouseout = function() {
					$(this).animate({borderRadius:'-=10px'}, "fast");
					$(this).css('background-color', "#d66");
				}*/
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

		function getMatieres(promo){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("matiere-select").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "?ajax=getmat&p=" + promo, true);
			xmlhttp.send();
		}

		function getChap(mat){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					document.getElementById("chapitre-select").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "?ajax=getchap&m=" + mat, true);
			xmlhttp.send();
		}

		function promoChangeModeEnable() {
			$("#promo-change-mode-enable").css('display', 'none');
			$("#promo-change-mode-disable").css('display', 'block');
			$("#promo-select-div").css('display', 'block');
		}

		function promoChangeModeDisable() {
			$("#promo-change-mode-enable").css('display', 'block');
			$("#promo-change-mode-disable").css('display', 'none');
			$("#promo-select-div").css('display', 'none');
		}
	</script>
</head>
<body>
	<a href="?u=accueil">
		<button id="addCourseBtn" onclick="showadd()">Retour</button>
	</a>
	<?
	if(isset($_GET["x"]) && $_GET["x"]=="upsucc")
		echo '<p>Upload Successful</p>';
	?>
	<div class="container">
		<div id="addArea" <?if(isset($_GET["x"]) && $_GET["x"]=="upfail") {echo "style='display:block'> <button id='succ'>Upload Failed</button";} ?>>
			<h1>Ajouter un document</h1>
			<? include_once('layouts/uploadForm.php') ?>
		</div>
	</div>
</body>