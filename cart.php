<?php
    
    session_start();
    
    function displayCart(){
        if(isset($_SESSION['cart'])){
            echo "<table>";
            foreach($_SESSION['cart'] as $game){
                echo '<tr>';
                echo "<td><h4>$game</h4></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
 if(isset($_GET['reset'])){
  session_destroy();
    header("Location:index.php");
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Cart</title>
         <style>
   @import url(css/styles.css);
        </style>
    </head>
    <body>
        <a href='index.php'>Home</a>

            <h1> Your Shopping Cart</h1><br>
            <!--Cart Items-->
        <form>
            
            <?=displayCart()?>
        </form>
   
            <input type="submit" value="empty" name="reset"/>
 
    <footer>
        <hr>
        CST336 Internet Programming. 2018 &copy <br />
        <strong> Disclaimer: </strong>
        The information in this website is fictitous. It's used for academic purposes.
        <a href="http://csumb.edu">CSUMB</a>
        <figure>
            <img src="img/Monterey.jpg" alt="School Logo" height="100" width="150" />
        </figure>
    </footer>
    
    </body>
</html>
