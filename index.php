
<?php
//creating session

    session_start();
    $_SESSION['searches']= array();
    if(!isset($_SESSION['cart'])){

        $_SESSION['cart'] = array();

    }

    //check to see if user has searched for something

    if(isset($_GET['game'])){
        $_SESSION['searches'] = $_GET['game'];
        //print($_SESSION['searches']);
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Home  </title>
         <style>
              @import url(css/style.css);
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
             
                 <h1 id="title"> Video Game Market <img src="img/videog.png"  width="50" height="50"/> </h1>
               
        <br>
        
         <img src="img/robot.png" id="robot"  width="150" height="250"/>
       <img src="img/control.png"  id="controller" width="150" height="250"/>
        <form action="results.php">
          
            
            <br />
           <button type="button" id='cart' class="btn btn-success">
 <a href='Purchase.php'> Shopping Cart <span class="badge badge-dark"></span>
  <span class="sr-only">unread messages</span>
</button> </a>
    <br />
    <br />
            <h3>Video Game: </h3> 
            <input type="text" name="game" placeholder="Search" value="<?=$_GET['game']?>"/> <br /> <br />
            
         <br>
            <h3 >Game Category: </h3> 
            <select name="category" class="custom-select">
                <option selected>Select One</option>
                <option value="action">Action</option></option>
                <option value="shooter">Shooter</option></option>
                <option value="fantasy">Fantasy</option></option>
                <option value="sports">Sports</option></option>
                <option value="role">Role-Play</option></option>
            </select>
            <br>
            <br>
            <br>
            
          <h3 >Game Platform: </h3>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-success">
                <input type="radio" name="options" id="optionOne" autocomplete="off"> Xbox
                  </label>
              <label class="btn btn-primary">
                <input type="radio" name="options" id="optionTwo" autocomplete="off"> Playstation 
          </label>
            </div>
            <br>
            <br>
            <br>
            
            
           <h3> Price Range: <br> <br /> From</h3> <input type="text" name="priceFrom" placeholder="Min" size="4"/>
                 <h3>   To   </h3>  <input type="text" name="priceTo" placeholder="Max" size="4"/>
                <br>
                <br />
                <h3> Order By: </h3>
               <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-danger">
                <input type="radio" name="options" id="option1" autocomplete="off"> Cost
              </label>
              <label class="btn btn-info">
                <input type="radio" name="options" id="option2" autocomplete="off"> Game Title
              </label>
            </div>
           <br>
           <br>
           <br />
             <input type="submit" value="Search" name="searchForm" />
             <br>
             <br />
             <br>
            <h4> Progress Bar </h4>
             <div class="progress"> 
  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
        </form>
       
    </div>
    </body>
    <br>
    <br> <br>
    <footer id="footer">
            <hr>
            CST336 Internet Programming. 2018 &copy <br />
            <strong> Disclaimer: </strong>
            The information in this website is fictitous. It's used for academic purposes.
            <a href="http://csumb.edu">CSUMB</a>
            <figure>
                <img  alt="School Logo" height="100" width="150" />
            </figure>
    </footer>
</html>
