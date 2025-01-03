<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
        <title>THE FIND</title>
        <link rel="icon" href="image/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="productdetailsstyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <section id="header">
            <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
            <ul id="navbar">
                <li><a href="home.php">HOME</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
            </ul>
        </section>
        <section id="hero">
            <h1 style="font-size: 70px; color: transparent;">dydyd</h1>
        </section>
        <a href="products.php"><img id="back" src="image/back.png"></a>
        <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
        </script>
    </body>
</html>

<?php

session_start();

$conn = mysqli_connect("localhost","root","","miniproject");

if(!$conn){
    die("Not Connected");
}

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(isset($_GET["id"])){
    $product_id = $_GET["id"];
}else{
    $product_id = $_POST["product_id"];
}

$sql = "SELECT * FROM product_details WHERE shoe_id = '$product_id'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    
    echo "<section class='container'>";

        echo "<section class='imagebox'>";
            echo "<img class='image' src='image/" . $row["image"] . "' alt='" . $row["name"] . "'>";
        echo "</section>";

        echo "<section class='details'>";
            echo "<h1 style='margin-top: 50px;' id='name'>" . $row["name"] . "</h1>";
            echo "<p id='brand'>" . $row["brand"] . "</p>";
            if($row["offer"] == 1){
                $original_price = $row["price"];
                $offered_price = $original_price - ($original_price * 0.20);
                echo "<p id='price'><strike style='color: grey; font-size: 30px;'>₹" . $original_price . "</strike> ₹" . $offered_price . "</p>";
                echo "<p style='margin-left: 90px; color: orange;' id='discount'>20% off</p>";
            } else {
                echo "<p id='price'>₹" . $row["price"] . "</p>";
            }
            echo "<p id='taxes'>*Inclusive of all taxes</p>";

            $sql_sizes = "SELECT DISTINCT sizes FROM sizetable WHERE shoe_id = '$product_id'";
            $res_sizes = mysqli_query($conn, $sql_sizes);

            echo "<section id='sizebox'>";
                echo "<p id='size'>Size: </p>";

                echo "<select id='sizebar'>";
                while ($row_sizes = mysqli_fetch_assoc($res_sizes)) {
                    echo "<option value='" . $row_sizes["sizes"] . "'>" . $row_sizes["sizes"] . "</option>";
                }
                echo "</select>";
            echo "</section>";

            if($row["stock_quantity"] <= 0){
                echo "<p class='outofstock'>Out of Stock</p>";
            }elseif ($row["stock_quantity"] == 1) {
                echo "<p class='outofstock'>Only 1 Stock Left</p>";
            }elseif($row["stock_quantity"] < 5){
                echo "<p class='outofstock'>Only " . $row["stock_quantity"] . " Stocks Left</p>";
            }else{
                echo "<p class='instock'>In Stock</p>";
            }
        }
        if(isset($user['account_type'])){
            if ($user['account_type'] === 'admin') {
                // Update stock form for admin
                echo "<section id='updatestockbox'>";
                echo "<form style='margin-top: 10px;margin-left: 90px;' action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<label for='stock_quantity' style='color: white;'>Update Stock:</label>";
                echo "<input type='number' id='stock_quantity' name='stock_quantity' value='".$row['stock_quantity']."'>";
                echo "<button id='updatestock' type='submit' name='update_stock'>Update</button>";
                echo "</form>";
                echo "</section>";

                // Add size form for admin
                echo "<section id='addsizebox'>";
                echo "<form style='margin-top: 10px;margin-left: 90px;' action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<label for='size' style='color: white;'>Add Size:</label>";
                echo "<input type='number' id='sizeinp' name='size' value='".$row['stock_quantity']."'>";
                echo "<button id='addsize' type='submit' name='add_size'>Add</button>";
                echo "</form>";
                echo "</section>";

                // Delete product form for admin
                echo "<section id='deleteproductbox'>";
                echo "<form style='margin-top: 10px;margin-left: 90px;' action='".$_SERVER['PHP_SELF']."' method='post' onsubmit='return confirmDelete();'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<button id='deleteproduct' type='submit' name='delete_product'>Delete Product</button>";
                echo "</form>";
                echo "</section>";

            echo "<section id='offerbox'>";    
                // Add Offer form for admin
                echo "<section id='addofferbox'>";
                echo "<form style='margin-top: 10px;margin-left: 90px;' action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<button id='addoffer' type='submit' name='add_offer'>Add Offer</button>";
                echo "</form>";
                echo "</section>";

                // Remove Offer form for admin
                echo "<section style='margin-left: -60px;' id='removeofferbox'>";
                echo "<form style='margin-top: 10px;margin-left: 90px;' action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<button id='removeoffer' type='submit' name='remove_offer'>Remove Offer</button>";
                echo "</form>";
                echo "</section>";
            echo "</section>";    
            } else {
                // Buy now and add to cart buttons for regular users
                echo "<section id='buynowbox'>";
                echo "<a href='ordering.php?id=" . urlencode($product_id) . "'><button id='buynow'>Buy Now</button></a>";
                echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<input type='hidden' name='product_name' value='".$row['name']."'>";
                echo "<button id='addtocart' type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</section>";
                }
                echo "</section>";
            
        }else{
            echo "<h3 id='loginfirst'>Please <a href='login.php'>login</a> or <a href='signup.php'>signup</a> first to buy!</h3>";
            exit;
        }
        echo "</section>";

    echo "</section>";
// Retrieve the user's ID
$username = $_SESSION['username'];
$sql = "SELECT user_id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
} else {
    // handle the case where the username is not found
    echo "Username not found";
    exit;
}

// Check purchase history
$sql_check_purchase = "SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = '$product_id'";
$res_check_purchase = mysqli_query($conn, $sql_check_purchase);


echo "<section class='reviews'>";

if (isset($user['account_type'])) {
    // Display reviews for users
    echo "<section id='reviewbox'>";
    echo "<h2 style='margin-left: 120px; margin-top: 30px; margin-bottom: 30px;'>Reviews:</h2>";
    $sql_reviews = "SELECT * FROM reviews WHERE shoe_id = '$product_id'";
    $res_reviews = mysqli_query($conn, $sql_reviews);
    if (mysqli_num_rows($res_reviews) < 1) {
        echo "<p style='margin-left: 120px;margin-bottom: 30px;'>No reviews yet</p>";
    } else {
        while ($row_reviews = mysqli_fetch_assoc($res_reviews)) {
            echo "<section id='reviewlist'>";
            echo "<h3 style='margin-left: 10px;margin-bottom: 10px;'>" . $row_reviews['username'] . "</h3>";
            echo "<p style='margin-left: 10px; margin-bottom: 10px;'>" . $row_reviews['review'] . "</p>";
            echo "</section>";
        }
    }
    echo "</section>";

    // Check if the user has purchased the product
    if (mysqli_num_rows($res_check_purchase) > 0 && $user['account_type'] !== 'admin') {
        // Add review section for users who bought the product
        echo "<section id='reviewbox'>";
        echo "<h2 style='margin-left: 130px; margin-top: 50px;'>Add a Review</h2>";
        echo "<form style='margin-bottom: 30px;' action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
        echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
        echo "<textarea id='review' name='review' placeholder='Write your review...'></textarea><br>";
        echo "<button id='addreview' type='submit' name='add_review'><b>Add</b></button>";
        echo "</form>";
        echo "</section>";
    } else {
       
            echo "<p style='margin-left: 120px; margin-bottom: 30px; color: red;'>You must purchase this product to leave a review.</p>";
        
    }
} else {
    echo "<h3 id='loginfirst'>Please <a href='login.php'>login</a> or <a href='signup.php'>signup</a> first to buy!</h3>";
    exit;
}

echo "</section>";


$username = $_SESSION['username'];
$sql = "SELECT user_id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
} else {
    // handle the case where the username is not found
    echo "Username not found";
    exit;
}

if(isset($_POST['add_offer'])){
    $shoe_id = $_POST['product_id'];

    $sql_add_offer = "UPDATE product_details SET offer = 1 WHERE shoe_id = '$shoe_id'";
    $res_add_offer = mysqli_query($conn, $sql_add_offer);

    if($res_add_offer){
        echo "<script>alert('Offer added successfully');</script>";
    }else{
        echo "<script>alert('Failed to add offer');</script>";
    }
}

if(isset($_POST['remove_offer'])){
    $shoe_id = $_POST['product_id'];

    $sql_remove_offer = "UPDATE product_details SET offer = 0 WHERE shoe_id = '$shoe_id'";
    $res_remove_offer = mysqli_query($conn, $sql_remove_offer);

    if($res_remove_offer){
        echo "<script>alert('Offer removed successfully');</script>";
    }else{
        echo "<script>alert('Failed to remove offer');</script>";
    }
}

if(isset($_POST['add_to_cart'])){
    $shoe_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $added_date = date("Y-m-d H:i:s");

    $sql_wishlist = "INSERT INTO wishlist (user_id, shoe_id, product_name, added_date) VALUES ('$user_id', '$shoe_id', '$product_name', '$added_date')";
    $res_wishlist = mysqli_query($conn, $sql_wishlist);

    if($res_wishlist){
        echo "<script>alert('Product added to wishlist successfully');</script>";
    }else{
        echo "<script>alert('Failed to add product to wishlist');</script>";
    }
}

if(isset($_POST['add_review'])){
    $shoe_id = $_POST['product_id'];
    $review = $_POST['review'];
    $username = $_SESSION['username'];

    // Check if the review already exists in the database
    $sql_check_review = "SELECT * FROM reviews WHERE shoe_id = '$shoe_id' AND username = '$username' AND review = '$review'";
    $res_check_review = mysqli_query($conn, $sql_check_review);

    if(mysqli_num_rows($res_check_review) > 0){
        echo "<script>alert('You have already added this review'); window.location.href='".$_SERVER['PHP_SELF']."?id=".$product_id."';</script>";
    }else{
        $sql_add_review = "INSERT INTO reviews (shoe_id, review, username) VALUES ('$shoe_id', '$review', '$username')";
        $res_add_review = mysqli_query($conn, $sql_add_review);

        if($res_add_review){
            echo "<script>alert('Review added successfully'); window.location.href='".$_SERVER['PHP_SELF']."?id=".$product_id."';</script>";
        }else{
            echo "<script>alert('Failed to add review');</script>";
        }
    }
}

if(isset($_POST['add_size'])){
    $shoe_id = $_POST['product_id'];
    $size = $_POST['size'];

    $sql_add_size = "INSERT INTO sizetable (shoe_id, sizes) VALUES ('$shoe_id', '$size')";
    $res_add_size = mysqli_query($conn, $sql_add_size);

    if($res_add_size){
        echo "<script>alert('Size added successfully');</script>";
    }else{
        echo "<script>alert('Failed to add size');</script>";
    }
}

if(isset($_POST['update_stock'])){
    $shoe_id = $_POST['product_id'];
    $stock_quantity = $_POST['stock_quantity'];

    $sql_update_stock = "UPDATE product_details SET stock_quantity = '$stock_quantity' WHERE shoe_id = '$shoe_id'";
    $res_update_stock = mysqli_query($conn, $sql_update_stock);

    if($res_update_stock){
        echo "<script>alert('Stock updated successfully');</script>";
    }else{
        echo "<script>alert('Failed to update stock ');</script>";
    }
}

if(isset($_POST['delete_product'])){
    $shoe_id = $_POST['product_id'];

    $sql_delete_product = "UPDATE product_details SET delete_flag = 1 WHERE shoe_id = '$shoe_id'";
    $res_delete_product = mysqli_query($conn, $sql_delete_product);
    
        if($res_delete_product){
            echo "<script>alert('Product deleted successfully');</script>";
            // Redirect to products page after deletion
            header('Location: products.php');
            exit;
        }else{
            echo "<script>alert('Failed to delete product');</script>";
        }
}

?>