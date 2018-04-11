<?php
    
    include 'dbConn.php';
    $conn = getDatabaseConnection("Gamestore");
    $iD = $_GET['ID'];
    $sql = "SELECT * FROM `PRICE`
            NATURAL JOIN GENRE 
            WHERE PRICE.ID = GENRE.ID";    
    
    $np = array();
    $np[":Id"] = $ID;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    
    foreach ($records as $record) {
        
        echo $record[0]['Title'] . "<br>";
        echo "<img src='" . $record[0]['gameImage'] . "' width = '200' /><br/>";
        echo "Platform: " . $record["Platform"] . "<br />";
        echo "Unit Price: " . $record["Price"] . "<br />";
        echo "Genre: " . $record["Genre"] . "<br />";
        
        
     
    }
    
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>
