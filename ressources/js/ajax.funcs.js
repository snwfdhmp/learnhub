function ajaxGetAndReplace(script, params, target) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var targetView = document.getElementById(target);
			if (this.responseText != targetView.innerHTML)
				targetView.innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "?ajax="+script+"&"+params, true);
	xmlhttp.send();
	xmlhttp = null;
}

function postComment(text, id_doc){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText !== false) {
				document.getElementById("comment-input").value = "";
			}
		}
	};
	xmlhttp.open("GET", "?ajax=postCom&id=" + id_doc +"&content="+escape(text), true);
	xmlhttp.send();
}

function putLike(type, ref) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "?ajax=like&type=" + type +"&ref="+ref+"&val=like", true);
	xmlhttp.send();
	var tmp = document.getElementById("badge-like-"+type+"-"+ref).innerHTML;
	document.getElementById("badge-like-"+type+"-"+ref).innerHTML = ++tmp;
	getComments();
}

function putDislike(type, ref) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "?ajax=like&type=" + type +"&ref="+ref+"&val=dislike", true);
	xmlhttp.send();
	getComments();
	var tmp = document.getElementById("badge-like-"+type+"-"+ref).innerHTML;
	document.getElementById("badge-like-"+type+"-"+ref).innerHTML = --tmp;
	getComments();
}