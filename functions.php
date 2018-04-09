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
             //$gamePrice= $record"Price"];
             //$gameImage =$record['Image'];
             
             echo '<tr>';
             //echo "<td><img src ='$gameImage'></td>";
             echo "<td>$gameName</td>";
             //echo "<td><h4>$gamePrice</h4></td>";
             echo "<td>$gameGenre</td>";
             echo "</tr>";
        }
        
        echo "</table>";
        
    }//end displaySearchResults
    
   
    
/*    function displayResults($game){
        $game = array();
        
        
        if(isset($game)){
            echo "<table class='table'>";
            foreach ($game as $game) {
                $gameName = $game['name'];
                $gamePrice = $game['salePrice'];
                $gameImage =$game['thumbnailImage'];
                $gameId = $game['itemId'];
            
                echo '<tr>';
                echo "<td><img src ='$gameImage'></td>";
                echo "<td><h4>$gameName</h4></td>";
                echo "<td><h4>$gamePrice</h4></td>";
                
               
               
               /* //button
                echo "<form method='POST'>";
                echo "<input type='hidden' name='gameName' value='$gameName'>";
                echo "<input type='hidden' name='gameId' value='$gameId'>";
                echo "<input type='hidden' name='gameImage' value='$gameImage'>";
                echo "<input type='hidden' name='gamePrice' value='$gamePrice'>";
                if($_POST['gameId'] == $gameId){
                    echo "<td><button class='btn btn-success'>Added</button></td>";
                    } else{
                    echo "<td><button class='btn btn-warning'>Add</button></td>";
                    }
                echo "</form>";
                
                echo "</tr>";
                
            }//end for-each
            
            echo"</table>";
        
        }//end of if-statement

    }//end of displayResults()*/
        
    }
?>