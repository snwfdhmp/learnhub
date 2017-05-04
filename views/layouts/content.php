<a href="?u=accueil">
<button id="addCourseBtn" onclick="showadd()">Retour</button></a><?
  if(isset($_GET["x"]) && $_GET["x"]=="upsucc"){?>
  <button id="succ">Upload Successful</button>
  <?}?>
<div class="container">
<div id="addArea" <?if(isset($_GET["x"]) && $_GET["x"]=="upfail") {echo "style='display:block'> <button id='succ'>Upload Failed</button";} ?>>
    <h1>Ajouter un document</h1>
       <? include_once('uploadForm.php') ?>
</div>
</div>