<div id="itemsArea">
				<?php 
					if($auth->isAuthenticated()){
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
            if(isset($_GET["x"]) && $_GET["x"]=="upfail") echo'<div id="addArea" style="display= block;">
            							 <button id="succ">Upload Failed</button>';
            else echo'<div id="addArea">';
            echo'<h2>Ajouter un document</h2>
                <div class="justCenter">
                	<form action="?u=accueil" enctype="multipart/form-data" method="POST">
                	<input type="hidden" name="action" id="action" class="input-black" value="addDoc">
                	<input type="hidden" name="auteur" id="auteur" class="input-black" value="1">
                	<p>Type :</p><select name="type" class="input-black">
                		<option value="1">Cours</option>
                		<option value="2">Exercice</option>
                		<option value="3">Annale</option>
                		<option value="4">Correction</option>
                	</select>
                	<p>Promo :</p><select name="promo" class="input-black">
                        <option value="0" selected="selected">selectionez votre promo</option>
                		<option value="1" onclick="getSubjects(this);">LE1</option>
                		<option value="2" onclick="getSubjects(this);">LE2</option>
                		<option value="3" onclick="getSubjects(this);">LE3</option>
                		<option value="4" onclick="getSubjects(this);">LE4</option>
                		<option value="5" onclick="getSubjects(this);">LE5</option>
                		<option value="6" onclick="getSubjects(this);">LA1</option>
                		<option value="7" onclick="getSubjects(this);">LA2</option>
                		<option value="8" onclick="getSubjects(this);">LA3</option>
                	</select>
                	<p>Matieres:</p><select name="matiere" id="subjects" class="input-black">
                    </select>
                	<p>Chapitre:</p><select name="chapitre" id="chaps" class="input-black">
                	</select>
                	<p>Nom:</p><br>
                	<input type="text" name="nom" class="input-black">
                	<p>le document</p><input type="file" name="doc" id="doc" class="input-black"><br>
                	<input type="submit" name="submit"  value="envoyer">
                	</form>
                </div>
            </div>
		</div>';?>