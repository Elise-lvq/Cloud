<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./css/css.css">
  </head>
</html>
<fieldset>
<form action="insert.php" method="post">
 <p>Nom ville : <input type="text" name="nom" value=""/></p>
 <p>Pays : <input type="text" name="pays" /></p>
 <p><input class="ok" type="submit" value="SAVE"></p>
</form>
</fieldset>
<br>
<?php     
require 'sqlconnect.php';     

try {
    $count = 0;

    $sql = 'SELECT * FROM ville';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //echo "<form action = "
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
      echo "<form action='delete.php' method='post'>";
      echo "<button type='submit' value='$getId' name='edit' class='addButton' >EDIT</button>";
      echo "&nbsp";
      echo "<button type='submit' value='$getId'  name='delete'  class='deleteButton'>DELETE</button>";
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


