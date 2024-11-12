<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>THE FIND</title>
        <link rel="icon" href="image/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="productstyle.css">
    </head>
    <body>
        <section id="header">
            <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
            <ul id="navbar">
                <li><a href="home.php">HOME</a></li>
                <li><a class="active" href="">PRODUCTS</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
            </ul>
        </section>
        <section id="hero">
            <h1 style="font-size: 70px; color: transparent;">dydyd</h1>
        </section>
        <center>
    <section class="searchsec">
        <form method="post" class="searchform">
            <div class="container">
                <select name="category" class="category">
                    <option value="">All Categories</option>
                    <?php
                        $conn = mysqli_connect("localhost","root","","miniproject");
                        $sql = "SELECT DISTINCT category FROM product_details";
                        $res = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            if(isset($_POST["category"]) && $_POST["category"] == $row["category"]){
                                echo "<option value='".$row["category"]."' selected>".$row["category"]."</option>";
                            }else{
                                echo "<option value='".$row["category"]."'>".$row["category"]."</option>";
                            }
                        }
                    ?>
                </select>
                <select name="filter" class="filter">
                <option value="">All</option>
                <?php
                    $options = array(
                        "brand" => "Brand",
                        "price" => "Price (Low to High)",
                        "price-desc" => "Price (High to Low)"
                    );
                    foreach($options as $value => $text){
                        if(isset($_POST["filter"]) && $_POST["filter"] == $value){
                            echo "<option value='".$value."' selected>".$text."</option>";
                        }else{
                            echo "<option value='".$value."'>".$text."</option>";
                        }
                    }
                ?>
            </select>                
                <input name="search" type="text" value="<?php if(isset($_POST["search"])) { echo $_POST["search"]; } ?>" placeholder="Search for shoes..." class="searchbar">
                <button name="searchbtn" class="searchbtn" type="submit">Search</button>
            </div>
        </form>
    </section>
</center>
    </body>
</html>

<?php

    session_start();

    $conn = mysqli_connect("localhost","root","","miniproject");
        
    if(!$conn){
        die("Not Connected");
    }
    if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];}
    if(isset($_POST["searchbtn"])){
        $search = $_POST["search"];
        $filter = $_POST["filter"];
        $category = $_POST["category"];
    
        if($category != ""){
            if($filter == "brand"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND category = '".$category."' AND delete_flag = 0 ORDER BY brand ASC";
            }elseif($filter == "price"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND category = '".$category."' AND delete_flag = 0 ORDER BY price ASC";
            }elseif($filter == "price-desc"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND category = '".$category."' AND delete_flag = 0 ORDER BY price DESC";
            }else{
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND category = '".$category."' AND delete_flag = 0";
            }
        }else{
            if($filter == "brand"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND delete_flag = 0 ORDER BY brand ASC";
            }elseif($filter == "price"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND delete_flag = 0 ORDER BY price ASC";
            }elseif($filter == "price-desc"){
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND delete_flag = 0 ORDER BY price DESC";
            }else{
                $sql = "SELECT * FROM product_details WHERE name LIKE '%".$search."%' AND delete_flag = 0";
            }
        }
    }else{
        $sql = "SELECT * FROM product_details WHERE delete_flag = 0 ORDER BY name ASC";
    }

    if(isset($_POST["search"])) {
        $search = trim($_POST["search"]);
        if (!empty($search)) { // Check if the search string is not empty
            $search = mysqli_real_escape_string($conn, $search);
            $insert_sql = "INSERT INTO mostsearched (sid, user_id, word) VALUES (NULL, '$user_id', '$search')";
            $insert_result = mysqli_query($conn, $insert_sql);
        }
    }
    
    $res = mysqli_query($conn,$sql);

    echo "<div class='product-grid'>";
        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)){
                echo "<a class='productlink' href='productdetails.php?id=" . $row["shoe_id"] . "'> <div class='productdisplay'>";
                echo "<img class='image' src='image/" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<h3 class='name'>" . $row["name"] . "</h3>";
                echo "<p class='brand'>" . $row["brand"] . "</p>";
            
                if($row["stock_quantity"] <= 0){
                    echo "<p class='outofstock'>Out of Stock</p>";
                }elseif ($row["stock_quantity"] == 1) {
                    echo "<p class='outofstock'>Only 1 Stock Left</p>";
                }elseif($row["stock_quantity"] < 5){
                    echo "<p class='outofstock'>Only " . $row["stock_quantity"] . " Stocks Left</p>";
                }else{
                    echo "<p class='instock'>In Stock</p>";
                }
            
                echo "<p class='price'>MRP: ₹" . $row["price"] . "</p>";
            
                // Check if offer is 1 and display offer card
                if($row["offer"] == 1){
                    echo "<div class='offer-card'>20% off!</div>";
                }
            
                echo "</div> </a>";
            }
        } else {
        echo "<center><h2 style='color: red;'>No products found.</h2></center>";
        }

    echo "</div>";

?>