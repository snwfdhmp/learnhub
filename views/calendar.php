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

		function onCalendarCellMouseOver(event) {
			$(event.target).css('background-color', '#d44');
			$("#infoBulle").show();
			var number=$(event.target).parent().index();
			$("#infoBulle").css('top', 60+28*number + 'px');
			$("#infoBulle").text("Informations : "+number);
		}
		function onCalendarCellMouseOut(event) {
			$(event.target).css('background-color', '#ccc');
			$("#infoBulle").hide();
		}

	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="content">
		<? include_once "layouts/leftside.php" ?>
		<div class="center">
			<h2>CALENDRIER</h2>
			<table class="calendarLargeSize">
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
				<tr><td class="calendarCell" onmouseover="onCalendarCellMouseOver(event)" onmouseout="onCalendarCellMouseOut(event)"></td></tr>
			</table>
			<div id="infoBulle">
				
			</div>
		</div>
		<? include_once "layouts/rightside.php" ?>
		<? include_once "layouts/menu.php" ?>
		</div>
	</body>
	</html>