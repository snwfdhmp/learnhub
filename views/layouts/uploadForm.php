<?
//$auth->requiresAuth();
include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php';
?>

<script>
  
</script>

<form action="?u=accueil" enctype="multipart/form-data" method="POST">
<input type="hidden" name="action" value="addDoc">
<div class="container container-fluid">
  <div id="promo-change-mode-enable">
  <p>Nous avons sélectionné votre promo pour vous : <? echo getNomPromo($_SESSION['promo']) ?>. <a onclick="promoChangeModeEnable()">Publier dans une autre promo</a></p>
  </div>
  <div id="promo-change-mode-disable">
  <p>Vous sélectionnez manuellement votre promo. <a onclick="promoChangeModeDisable()">Revenir à la valeur par défaut</a></p>
  </div>
  <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Nom</span>
    <input name="nom" type="text" class="form-control" placeholder="Exercices de maths" aria-describedby="sizing-addon1">
  </div><br/>
  <div id="promo-select-div">
  <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Promo</span>
    <select id="promo-select" name="promo" class="form-control" onchange="getMatieres(this.value)">
    <? promo_select_view($_SESSION['promo']) ?>
   </select>
 </div>
 <br/>
 </div>
  <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Type</span>
    <select name="type" class="form-control">
     <option value="1" <? selectedIf($_GET['t'], "Cours") ?>>Cours</option>
     <option value="2" <? selectedIf($_GET['t'], "Exercices") ?>>Exercice</option>
     <option value="3" <? selectedIf($_GET['t'], "Annales") ?>>Annale</option>
     <option value="4" <? selectedIf($_GET['t'], "Corrections") ?>>Correction</option>
   </select>
 </div><br/>
 <div class="addcourse-input input-group input-group-lg col-md-4">
  <span class="input-group-addon" id="sizing-addon1">Matière</span>
  <select id="matiere-select" name="matiere" class="form-control" onchange="getChap(this.value)">
  <? matieres_select_view($_SESSION['promo'], $_GET['m']); ?>
 </select>
</div><br/>

<div class="addcourse-input input-group input-group-lg col-md-4">
  <span class="input-group-addon" id="sizing-addon1">Chapitre</span>
  <select id="chapitre-select" name="chapitre" class="form-control">
  <? chapitres_select_view(1, $_GET['c']); ?>
  </select>
</div><br/>
<div class="addcourse-input col-md-4">
<div class="panel panel-default">
  <div class="panel-heading panel-warning">Upload</div>
  <div class="panel-body"><input type="file" name="doc" id="doc" style="display:inline;"></div>  
</div>
</div>
  <input type="submit" class="btn btn-success btn-lg" value="Upload">
</div>
</form>