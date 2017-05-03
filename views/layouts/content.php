<div id="itemsArea">
<a href="?u=accueil">
<button id="addCourseBtn" onclick="showadd()">Retour</button></a><?
  if(isset($_GET["x"]) && $_GET["x"]=="upsucc"){?><button id="succ">Upload Successful</button><?}
   if(!isset($_GET["x"]) || $_GET["x"]=="upsucc") {?> 
<!--<h2>DOCUMENT</h2>
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
 </table><br/>
</div>-->
</div>
<? }?>
<div class="container">
<div id="addArea" <?if(isset($_GET["x"]) && $_GET["x"]=="upfail") {echo "style='display:block'> <button id='succ'>Upload Failed</button";} ?>>
    <h1>Ajouter un document</h1>
       <? include_once('uploadForm.php') ?>
</div>
</div>