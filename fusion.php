<?php
session_start();
require 'sqlconnect.php';

  //Regarde lavaleur de post

  if(isset($_POST["save"])){
    /*echo "insert";
      include("insert.php");
      insert($conn);*/
      echo "add";


  }

  if (isset($_POST["edit"])) {
    //affiche le pays et la ville à éditier
    $_SESSION["edition"] = "false";
    $_SESSION['index'] = (int)($_POST['edit']);
    //Execute le code de la page edit
    include("edit.php");
    echo "la valeur de l'index";
    
    echo $_SESSION["index"];
    echo "<br>";
    edit($conn);
  }

  //Met à jour lesdonnés dans la base
  if(isset($_POST["edition"])){
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['pays'] = $_POST['pays'];
    echo "je passe dans edition";
    echo "nom : ".$_SESSION['nom']." pays : ".$_SESSION['pays'];
    include("edit.php");
    $_SESSION["edition"] = "true";
    edit($conn);
    //edit($conn);
    //echo "edit";
    //header("Location: edit.php");
  }
  
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
<form action="#" method="post">
  
   <p>Nom ville : <input type='text' name='nom' value= <?php 
   
   if (isset($_SESSION['nom']) && $_SESSION['nom']!="") {
     echo $_SESSION['nom'];
     unset($_SESSION['nom']);
   } 

   
   ?>  ></p>
    <p>Pays : <input type='text' name='pays' value=<?php if (isset($_SESSION['pays']) && $_SESSION['pays']!="") {
      echo $_SESSION['pays'];
      unset($_SESSION['pays']);
    }  ?> ></p>
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
  $conn = null;
  echo "</table>";
?>


