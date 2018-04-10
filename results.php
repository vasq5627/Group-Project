<?php
    session_start();
    include 'functions.php';
    
    
    function getGameSearched(){
        if(isset($_GET['game'])){
        $_SESSION['searches'] = $_GET['game'];
        print($_SESSION['searches']);
        }
    }
    
    if(isset($_POST['gameID'])){
        array_push($_SESSION['cart'],$_POST['gameID']);
    }
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Results</title>
         <style>
   @import url(css/style.css);
        </style>
    </head>
    <body>
        
            <h1> Results Found For: '<?=getGameSearched()?>'</h1>
            <br>
            <br>
            
            <form>
            <?=displaySearchResults()?>
            </form>
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
