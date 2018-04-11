<?php
    
    session_start();
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("Gamestore");
    
    function getProductInfo(){
        
        global $conn;
        
        $sql = "SELECT * FROM `PRIC`E NATURAL JOIN `GENRE` NATURAL JOIN `PLATFORM` WHERE 1 AND ID = " .$_GET['gameID'];
        
        //echo $_GET["productId"];
        
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        //return $record;
        
        $gameID = $record["ID"];
        $gameTitle = $record["Title"];
        $gameGenre = $record["Genre"];
        $gamePlatform = $record['Platform'];
        $gamePrice = $record["Price"];
                
                
        echo "<h2>$gameTitle</h2>";
                
        echo "This game is available for $gamePlatform.";
        echo "Cost: $gamePrice";
        //echo "<td><img src='$itemImage'><</td>";
        echo "This is a $gameGenre game.";
        
    }

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Product Info </title>
    </head>
    <body>
        
        <?=getProductInfo()?>
        
    </body>
</html>


