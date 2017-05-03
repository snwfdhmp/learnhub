<html>
<head>
    <script>
        function getSubjects(obj){
            document.getElementById("subjects").innerHTML ='';
            document.getElementById("chaps").innerHTML ='';
            console.log(obj.value);
            promo=obj.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("subjects").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getSubjects.php?p=" + promo, true);
            xmlhttp.send();
        }
        function getChap(obj){
            mat=obj.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("chaps").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getSubjects.php?m=" + mat, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
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
                        <option value='0' selected="selected">selectionez votre promo</option>
                		<option value="1" onclick="getSubjects(this);">LE1</option>
                		<option value="2" onclick="getSubjects(this);">LE2</option>
                		<option value="3" onclick="getSubjects(this);">LE3</option>
                		<option value="4" onclick="getSubjects(this);">LE4</option>
                		<option value="5" onclick="getSubjects(this);">LE5</option>
                		<option value="6" onclick="getSubjects(this);">LA1</option>
                		<option value="7" onclick="getSubjects(this);">LA2</option>
                		<option value="8" onclick="getSubjects(this);">LA3</option>
                	</select>
                	<p>Matieres:</p><select name="matiere" id="subjects">
                    </select>
                	<p>Chapitre:</p><select name="chapitre" id="chaps">
                	</select>
                	<p>Nom:</p><br>
                	<input type="text" name="nom">
                	<p>le document</p><input type="file" name="doc" id="doc" /><br>
                	<input type="submit" name="submit"  value="envoyer">
                	</form>
                </div>
            </div>
		</div>
</body>
</html>