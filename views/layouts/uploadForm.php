<form action="?u=accueil" enctype="multipart/form-data" method="POST">
<div class="container">
  <div class="input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Nom</span>
    <input type="text" class="form-control" placeholder="Exercices de maths" aria-describedby="sizing-addon1">
  </div><br/>

  <div class="input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Promo</span>
    <select name="promo" class="form-control" placeholder="Exercices de maths" aria-describedby="sizing-addon1">
      <option value="0" onclick="getSubjects(this);" selected disabled>Sélectionnez</option>
      <option value="1" onclick="getSubjects(this);">LE1</option>
      <option value="2" onclick="getSubjects(this);">LE2</option>
      <option value="3" onclick="getSubjects(this);">LE3</option>
      <option value="4" onclick="getSubjects(this);">LE4</option>
      <option value="5" onclick="getSubjects(this);">LE5</option>
      <option value="6" onclick="getSubjects(this);">LA1</option>
      <option value="7" onclick="getSubjects(this);">LA2</option>
      <option value="8" onclick="getSubjects(this);">LA3</option>
    </select>
  </div><br/>

  <div class="input-group input-group-lg col-md-4">
    <span class="input-group-addon" id="sizing-addon1">Type</span>
    <select name="type" class="form-control">
     <option value="1">Cours</option>
     <option value="2">Exercice</option>
     <option value="3">Annale</option>
     <option value="4">Correction</option>
   </select>
 </div><br/>

 <div class="input-group input-group-lg col-md-4">
  <span class="input-group-addon" id="sizing-addon1">Matière</span>
  <select name="matiere" class="form-control">
   <option value="" selected disabled>Non available</option>
 </select>
</div><br/>

<div class="input-group input-group-lg col-md-4">
  <span class="input-group-addon" id="sizing-addon1">Chapitre</span>
  <select name="chapitre" class="form-control">
   <option value="" selected disabled>Non available</option>
 </select>
</div><br/>

<div class="panel panel-default">
  <div class="panel-heading panel-warning">Upload</div>
  <div class="panel-body"><input type="file" name="doc" id="doc" style="display:inline;"></div>   
</div>
</div>
</form>