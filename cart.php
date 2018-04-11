<?php
    
    session_start();
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }



?>

<!DOCTYPE html>
<html>
    <head>
        <title> Cart</title>
         <style>
   @import url(css/style.css);
        </style>
    </head>
    <body>

            <h1> Your Shopping Cart</h1>
            <br>
    </body>
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
</html>
