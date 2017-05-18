<?
//$auth->requiresAuth();
include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php';
?>
<form action="?u=accueil" enctype="multipart/form-data" method="POST">
<input type="hidden" name="action" value="addMat">
<div class="container container-fluid">
  <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Promo</span>
    <select name="promo" class="form-control">
     <option value="1">L1</option>
     <option value="2">L2</option>
     <option value="3">L3</option>
     <option value="4">L4</option>
     <option value="5">L5</option>
     <option value="6">LA1</option>
     <option value="7">LA2</option>
     <option value="8">LA3</option>
     <option value="9">Personel</option>
   </select>
 </div><br/>
  <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Nom</span>
    <input name="nom" type="text" class="form-control" placeholder="Exemple" aria-describedby="sizing-addon1" required>
  </div><br/>
 <div class="addcourse-input input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Dimunituf</span>
    <input name="Dimunituf" type="text" class="form-control" placeholder="Exemple" aria-describedby="sizing-addon1" required>
  </div><br/>
  <input type="submit" class="btn btn-success btn-lg" value="Ajouter">
</div>
</form>