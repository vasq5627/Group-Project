<?php

    
    
    function displayCart() {
        // If the 'cart' is already created, display its items
        if(isset($_SESSION['cart'])) {
            echo "<table class='table'>";
            foreach($_SESSION['cart'] as $item) {
                $itemName = $item['name'];
                $itemId = $item['id'];
                $itemPrice = $item['price'];
                $itemImage = $item['image'];
                $itemQuant = $item['quantity'];
                
                // Display item as table row
                echo "<tr>";
                
                echo "<td><img src='$itemImage'></td>";
                echo "<td><h4>$itemName</h4></td>";
                echo "<td><h4>$$itemPrice</h4></td>";
                echo "<td><h4>$itemQuant</h4></td>";
                
                // Hidden input element containing the item name
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo "<td><button class='btn btn-danger'>Update</button></td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td><button class='btn btn-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    // Creating a function to display the count of the number of items in the shopping cart.
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
?>