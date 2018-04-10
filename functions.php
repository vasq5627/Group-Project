<?php
    session_start();
    include 'dbConn.php';

    $conn = getDatabaseConnection("Gamestore");
    
        function displaySearchResults(){
        global $conn;

        if(isset($_GET['game'])){  //checks whether has input data

        $namedParameters = array();

        $sql = "SELECT * FROM GENRE WHERE 1";

        if(!empty($_GET['game'])){
            $sql .= " AND Title LIKE :gameTitle ";
            $namedParameters[":gameTitle"] = "%" . $_GET['game'] . "%";
        }

        /*
        if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
            $sql .=  " AND catId = :categoryId";
            $namedParameters[":categoryId"] =  $_GET['category'];
        }

        if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box

            $sql .=  " AND price >= :priceFrom";
            $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
        }

        if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box

            $sql .=  " AND price <= :priceTo";
            $namedParameters[":priceTo"] =  $_GET['priceTo'];
        }

        if (isset($_GET['orderBy'])){
            if($_GET['orderBy'] == "price"){
                $sql .= " ORDER BY price";
            }
            else{
                $sql .= " ORDER BY productName";
            }
        }

        */
        
        //echo $sql;

        $stm = $conn->prepare($sql);
        $stm->execute($namedParameters);
        $records = $stm->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>";
        echo "<tr>";
        echo "<td> Title </td>";
        echo "<td> Genre </td>";
        echo "<td> Price </td>";

        foreach($records as $record) {
             $gameName = $record["Title"];
             $gameGenre = $record["Genre"];
             $gameID = $record["ID"];
             //$gamePrice= $record"Price"];
             //$gameImage =$record['Image'];

             echo '<tr>';
             //echo "<td><img src ='$gameImage'></td>";
             echo "<td>$gameName</td>";
             //echo "<td><h4>$gamePrice</h4></td>";
             echo "<td>$gameGenre</td>";

             //button
            echo "<form method='POST'>";
            echo "<input type='hidden' name='gameName' value='$gameName'>";
            echo "<input type='hidden' name='gameId' value='$gameID'>";
            //echo "<input type='hidden' name='gameImage' value='$gameImage'>";
            //echo "<input type='hidden' name='gamePrice' value='$gamePrice'>";
            echo "<td><button formaction='Purchase.php'>Add</button></td>";
            echo "</form>";
            echo "</tr>";
        }

        echo "</table>";
        }
        
    }//end displaySearchResults


    function displayShoppingCart(){
        
        if(isset($_SESSION['cart'])){
        echo "<table class ='table'>";
            foreach($_SESSION['cart'] as $game){
                echo "<tr>";
                echo "<td>$game</td>";
                echo "</tr>";
                }
        echo "</table>";}
        
        else{
            echo "<h1>Your Cart is Empty.</h1>";
        }

    }//end displayShoppingCart()


?>
