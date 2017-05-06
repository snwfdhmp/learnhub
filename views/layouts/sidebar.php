<?  if($auth->isAuthenticated() == true) {

	include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php'; ?>

	<div id="sidebar">
		<h2><li class="server-ping-fire"><span class="server-status"></span></li></h2>
		<div id="online-view">
			<? online_users_sidebar() ?>
		</div>
	</div>

	<div class="popup-box"></div>

	<script>
		function addHandlers() {
			$(".user-online-box").on("mouseover", function() {
				$(this).find(".user-online-links").css("display", "inline");
			});

			$(".user-online-box").on("mouseout", function() {
				$(this).find(".user-online-links").css("display", "none");
			});
		}
		function updateOnline() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var targetView = document.getElementById("online-view");
					if (htmlEncode(this.responseText) != targetView.innerHTML) {
						targetView.innerHTML = this.responseText;
						addHandlers();
					}
				}
			};
			xmlhttp.open("GET", "?ajax=online_users", true);
			xmlhttp.send();
			xmlhttp = null;
		}


		window.setInterval(function() {
			updateOnline();
		}, 10000);
		addHandlers();

	</script>
	<? } ?>