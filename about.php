<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>About | THE FIND</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="aboutstyle.css">
</head>
<body>
    <section id="header">
        <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
        <ul id="navbar">
            <li><a href="home.php">HOME</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a class="active" href="about.php">ABOUT</a></li>
            <li><a href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
        </ul>
    </section>
    <section id="about">
        <h1 style="margin-left:60px; margin-bottom: 20px; color: #fff; font-size: 40px;">About Us</h1>
        <div class="about-container">
            <p>Welcome to THE FIND, your one-stop online shoe shopping destination! We're passionate about providing you with the latest and greatest in footwear fashion, from sleek and stylish heels to rugged and reliable boots.</p>
            <p>Our mission is to make shoe shopping easy, convenient, and fun. We believe that everyone deserves to find the perfect pair of shoes that makes them feel confident and comfortable. That's why we curate a wide selection of shoes from top brands and emerging designers, ensuring that you'll always find something that fits your style and budget.</p>
            <p>At THE FIND, we're committed to providing exceptional customer service, fast shipping, and a hassle-free return policy. We want you to feel confident in your purchase and enjoy your shopping experience with us.</p>
            <h2 style="margin-bottom: 20px; margin-top: 40px;">Contact Us</h2>
            <ul>
                <li><strong>Phone:</strong> +1 (123) 456-7890</li>
                <li><strong>Email:</strong> <a href="mailto:info@thefind.com">info@thefind.com</a></li>
                <li><strong>Address:</strong> 123 Main St, Anytown, USA 12345</li>
            </ul>
            <h2 style="margin-bottom: 20px; margin-top: 40px;">Follow Us</h2>
            <ul>
                <div class="social-icons">
                    <li><a href="https://www.facebook.com/thefindshoes"><img style="height: 35px; width: 35px;" src="image/facebook.png" alt="Facebook"></a></li>
                    <li><a href="https://www.instagram.com/thefindshoes"><img style="height: 35px; width: 35px;" src="image/instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://www.twitter.com/thefindshoes"><img style="height: 40px; width: 40px; transform: translate(-5px, -3px);" src="image/twitter.png" alt="Twitter"></a></li>
                </div>
            </ul>
        </div>
    </section>
</body>
</html>