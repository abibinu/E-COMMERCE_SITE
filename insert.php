<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>THE FIND</title>
        <link rel="icon" href="image/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="insertstyle.css">
    </head>
    <body>
        <section id="header">
            <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
            <ul id="navbar">
                <li><a href="home.php">HOME</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a class="active" href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
            </ul>
        </section>
        <section id="hero">
            <h1 style="font-size: 70px; color: transparent;">dydyd</h1>
        </section>
        <section>
            <h2 style="color: white;">Add New Shoe</h2>
        </section>
        <section id="insertform">
            <form method="post" enctype="multipart/form-data">
                <label class="headings">Name:</label> <input type="text" name="name" required><br><br>
                <label class="headings">Brand:</label> <input type="text" name="brand" required><br><br>
                <label class="headings">Description:</label> <textarea name="description" required></textarea><br><br>
                <label class="headings">Price:</label> <input type="number" name="price" required><br><br>
                <label class="headings">Image:</label> <input type="file" name="image" accept="image/*" required><br><br>
                <label class="headings">Category:</label> <input type="text" name="category" required><br><br>
                <label class="headings">Stock Quantity:</label> <input type="number" name="stockquantity" required><br><br>
                <center><input name="submit" type="submit" value="Add Shoe"></center>
              </form>              
        </section>    
        <section id="blank"></section>
    </body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "miniproject");

if (!$conn) {
    die("Not Connected: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $brand = $_POST["brand"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $stockquantity = $_POST["stockquantity"];

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = 'image/' . $filename;

    // Check for file upload errors
    if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        die("File upload error: " . $_FILES["image"]["error"]);
    }


    $insrt = "INSERT INTO product_details ( name, brand, description, price, image, category, stock_quantity) 
              VALUES ('$name','$brand','$description',$price,'$filename','$category',$stockquantity)";

    if (mysqli_query($conn, $insrt)) {
        move_uploaded_file($tempname, $folder);
        echo "<script>alert('ADDED SUCCESSFULLY!');</script>";
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>