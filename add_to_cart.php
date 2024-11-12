<?php

$conn = mysqli_connect("localhost","root","","miniproject");

if(!$conn){
    die("Not Connected");
}

$product_id = $_GET["id"];
$product_name = $_GET["name"];
$user_id = $_GET["user_id"];

$sql = "INSERT INTO wishlist (user_id, shoe_id, product_name, added_date) VALUES ('$user_id', '$product_id', '$product_name', NOW())";
mysqli_query($conn, $sql);

?>