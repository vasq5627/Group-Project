<?php
    session_start();
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    if(isset($_GET['addButton'])){
        array_push($_SESSION['cart'],$_GET['addButton']);
    }
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("Gamestore");
    
    function displayGenre(){
        global $conn;
        
        $sql = "SELECT DISTINCT Genre FROM `GENRE` ORDER BY Genre";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["Genre"]."' >" . $record["Genre"] . "</option>";
            
        }
        
    }
    
    function displayPlatform(){
        global $conn;
        
        $sql = "SELECT DISTINCT  Platform FROM `PLATFORM` ORDER BY Platform";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["Platform"]."' >" . $record["Platform"] . "</option>";
            
        }
        
    }
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>"; 
            
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            
            //Query below prevents SQL Injection
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM PRICE NATURAL JOIN GENRE NATURAL JOIN PLATFORM WHERE 1";
            
            if (!empty($_GET['gameTitle'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Title LIKE :Title";
                 $namedParameters[":Title"] = "%" . $_GET['gameTitle'] . "%";
            }
                  
                  
             if (!empty($_GET['genre'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Genre = :genre";
                 $namedParameters[":genre"] =  $_GET['genre'];
             }
             
             if (!empty($_GET['platform'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Platform = :platform";
                 $namedParameters[":platform"] =  $_GET['platform'];
             }
            
             if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
             if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
            if(isset($_GET['orderBy'])) {
                
                if($_GET['orderBy'] == "price") {
                    $sql .= " ORDER BY Price";
                }   
                else {
                      $sql .= " ORDER BY Title";
                 }
            }
           
           
            //echo $sql; //for debugging purposes
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            echo "<table>";
            foreach ($records as $record) {
                $gameID = $record["ID"];
                $gameTitle = $record["Title"];
                $gameGenre = $record["Genre"];
                $gamePlatform = $record['Platform'];
                $gamePrice = $record["Price"];
                
        
                
                echo '<tr>';
                //echo "<td><img src='$itemImage'><</td>";
                //echo "<td><a href=gameInfo.php?gameID=".$gameID."'>More Info</a></td>";
                echo "<td><h4>$gameTitle</h4></td>";
                echo "<td><h4>$gameGenre</h4></td>";
                echo "<td><h4>$gamePlatform</h4></td>";
                echo "<td><h4>$$gamePrice</h4></td>";
                
                //Hidden input elements
                
                echo '<form method="POST">';
                echo "<input type='hidden' name='gameTitle' value='$gameTitle'>";
                echo "<td><button name='addButton' value='$gameTitle'>Add</button></td>";
                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Product Search </title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href ="css/styles.css" rel ="stylesheet" type="text/css" />
    </head>
    <body> 
    <div class='container'>
        <div class='text-center'>
       <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Gamestore</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='cart.php'>
                        <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                        </span> Cart:</a></li>
                    </ul>
                </div>
            </nav>
            <br> <br> <br>


        <h1>  Gamestore </h1>
        
        <form>
            
            Product: <input type="text" name="gameTitle" /><br /><br />
            
            Genre: 
                <select name="genre">
                    <option value=""> Select One </option>
                    <?=displayGenre()?>
                </select>
            <br /><br />
            
            Platform: 
                <select name="platform">
                    <option value=""> Select One </option>
                    <?=displayPlatform()?>
                </select>
            <br /><br />
            
            Price:  From <input type="text" name="priceFrom" size="7"/>
                    To   <input type="text" name="priceTo" size="7"/>
                    
            <br /><br />
            
             Order result by:<br />
             
             <input type="radio" name="orderBy" value="price"/> Price 
             
             <br /><br />
             
             <input type="radio" name="orderBy" value="name"/> Name
             
             <br /><br />
             
             <input type="submit" value="Search" name="searchForm" />
             
        </form>
        
        <br />
        <hr>
        <form>
        <?= displaySearchResults() ?>
        </form>

    </body>
</html>
