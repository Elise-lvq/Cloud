<?php     
require 'sqlconnect.php';     

/*$sql = 'SELECT * FROM ville';  
$prepare = $conn->prepare($sql);   
$res = $prepare ->exec($sql);     
$nb = $prepare ->rowCount();

echo $nb.' membres ont été supprimés.';  */   
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Nom</th><th>Pays</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}
try {
    $sql = 'SELECT * FROM ville';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  echo "</table>";
?>