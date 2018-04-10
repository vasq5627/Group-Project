<?php
    //creating session
    session_start();
    include 'functions.php';
    
    if(isset($_POST['gameID'])){
        array_push($_SESSION['cart'],$_POST['gameID']);
    }
  
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title> Cart </title>
         <style>
            @import url(css/style.css);
        </style>
    </head>
    <body>
        <form>
        <h1> Shopping Cart </h1>
        <form>
            
        </form>
        <button formaction='index.php'>Home</button>
        
        <?=displayShoppingCart()?>
        
    </body>
    <footer id="footer">
            <hr>
            CST336 Internet Programming. 2018 &copy <br />
            <strong> Disclaimer: </strong>
            The information in this website is fictitous. It's used for academic purposes.
            <a href="http://csumb.edu">CSUMB</a>
            <figure>
                <img src="img/Monterey.jpg" alt="School Logo" height="100" width="150" />
            </figure>
            
            
        </footer>
</html>
