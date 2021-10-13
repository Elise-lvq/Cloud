<?php
session_start();
require 'sqlconnect.php';

  //regarde valeur de $POST
  if(isset($_POST["save"])){
      //ajoute une ligne à la table
      //bouton = save
      include("insert.php");
      insert($conn);
  }

  if (isset($_POST["edit"])) {
    //affiche le pays et la ville à éditier
    //bouton = edition
    include("edit.php");
    $_SESSION['index'] = (int)($_POST['edit']);
    edit($conn);
  }

  //Met à jour les donnés dans la base
  if(isset($_POST["edition"])){
    include("edit.php");
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['pays'] = $_POST['pays'];
    edit($conn);
  }

  //Supprime la ligne
  if (isset($_POST["delete"])) {
    include("delete.php");
    delete($conn);
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./css/css.css">
  </head>
</html>
<fieldset>
<!-- formulaire insertion/édition -->
<form action="#" method="post" enctype="multipart/form-data">
  
   <p>Nom ville : <input type='text' name='nom' value= <?php 
   //remplie les case si le bouton édit a été appuyer
   
   if (isset($_SESSION['nom']) && $_SESSION['nom']!="") {
     echo $_SESSION['nom'];
     unset($_SESSION['nom']);
   } 

   
   ?>  ></p>
    <p>Pays : <input type='text' name='pays' value=<?php if (isset($_SESSION['pays']) && $_SESSION['pays']!="") {
      echo $_SESSION['pays'];
      unset($_SESSION['pays']);
    }  ?> ></p>

    <p>
      Image : <input type="file" name="image">
    </p>

    <!-- le bouton submit change de texte selon le mode édition/insertion -->
    <p><input name="<?php if (isset($_SESSION["edition"]) && $_SESSION["edition"] == "true") { echo "edition"; } else { echo "save"; } ?>" class='ok' type='submit' value=<?php if (isset($_SESSION["edition"]) && $_SESSION["edition"] == "true") { echo "edition"; } else { echo "save"; } ?>></p>

</form>
</fieldset>
<br>
<?php     
    
try {
    $count = 0;
    $sql = 'SELECT * FROM ville';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    //permet d'afficher toute les données de la table
    echo "<table >";
    echo "<tr><th>Nom</th><th>Pays</th><th>Actions</th></tr>";
    
    foreach  ($conn->query($sql) as $row) {
      $count++;
      if ($count%2 == 0) {
        echo "<tr class='pair'>";
      }else{
        echo "<tr>";
      }
      $getId = $row['Id'];
      echo "<td style='width:150px;'>";
      echo "&nbsp";
      echo "&nbsp";
      print $row['Nom'] . "\t";
      echo "&nbsp";
      echo "&nbsp";
      echo "</td>";
      echo "<td style='width:150px;'>";
      echo "&nbsp";
      echo "&nbsp";
      print  $row['Pays'] . "\t"; 
      echo "&nbsp"; 
      echo "</td>";
      echo "<td style='width:222px;'>";
      echo "<form action='#' method='post'>";
      //chaque ligne possède un bouton edit (-> fait changer le formulaire de mode) et delete
      echo "<button type='submit' value=$getId name='edit' class='addButton' >EDIT</button>";
      echo "&nbsp";
      echo "<button type='submit' value=$getId  name='delete'  class='deleteButton'>DELETE</button>";
      echo "</form>";
      echo "</td>";
  echo " </tr>" . "\n";

  }
  
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  echo "</table>";
?>


