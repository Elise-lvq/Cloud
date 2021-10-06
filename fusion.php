<?php

require 'sqlconnect.php';


  if (isset($_POST["save"])) {
    echo "edit";
    if (isset($_SESSION["edition"])) {
      include("edit.php");
      edit($conn);
    }else{
      echo "insert";
      /*include("insert.php");
      insert($conn);*/
    }
    
  }
  if (isset($_POST["delete"])) {
    include("delete.php");
    delete($conn);
  }
  if (isset($_POST["edit"])) {
    include("edit.php");
    edit($conn);
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
   
   if (isset($_SESSION['nom'])) {
     echo $_SESSION['nom'];
   } 

   
   ?>  ></p>
    <p>Pays : <input type='text' name='pays' value=<?php if (isset($_SESSION['pays'])) {
      echo $_SESSION['pays'];
    }  ?> ></p>
    <p><input name='save' class='ok' type='submit' value='SAVE'></p>

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


