<?php
    session_start();
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
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
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND Title LIKE :Title";
                 $namedParameters[":Title"] = "%" . $_GET['product'] . "%";
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
                
                
            }
            //echo $sql; //for debugging purposes
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

            foreach ($records as $record) {
                echo  $record["Title"] . " " . $record["Genre"] . " ".$record['Platform']." $". $record["Price"] ."<br /> <br>";
            }
            
        }
        
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart Product Search </title>
        <link href ="css/styles.css" rel ="stylesheet" type="text/css" />
    </head>
    <body>

        <h1>  Gamestore </h1>
        
        <form>
            
            Product: <input type="text" name="product" /><br /><br />
            
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
        
        <?= displaySearchResults() ?>

    </body>
</html>