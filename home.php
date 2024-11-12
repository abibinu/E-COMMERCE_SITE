<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>THE FIND</title>
        <link rel="icon" href="image/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="homestyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
        <section id="header">
            <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
            <ul id="navbar">
                <li><a class="active" href="">HOME</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
            </ul>
        </section>
        <!-- Add marquee banner here -->
        <div id="banner-container">
            <a href="products.php">
                <marquee style="color: white;" id="banner" loop="infinite">20% OFF ON SHOES. LIMITED TIME OFFER! 20% OFF ON ALL SHOES. LIMITED TIME OFFER!  20% OFF ON ALL SHOES. LIMITED TIME OFFER!</marquee>
            </a>
        </div>
        <h1 style="font-size: 70px; color: transparent;">dydyd</h1>
        <div id="greet"><h4 id="greeting"></h4></div>
        <section id="cont">
            <section id="hero">
                    
                    <h3 id="step1" style="margin-left: 110px;transform: translate(0px,20px);">STEP-UP</h3>
                    <h2 id="step2" style="margin-top: 0%;  transform: translate(7px,5px);">YOUR</h2>
                    <h1 id="step3" style="margin-top: 0%; transform: translate(5px,-25px); font-size: 120px;">STYLE</h1> 
                    <h1 id="step3" style="margin-top: 0%; transform: translate(5px,-55px);">GAME!</h1> 

            </section>
            <section id="heroimage">
                    <img id="heroimg" src="image/hero.png" type="image/png">
            </section>
        </section>
        <section id="view">
            <a href="products.php"><input id="viewbt" type="button" value="SHOP NOW"></a><br>
        </section>
        <footer id="foot">
           <p id="copy"> © 2021 The Find. All rights reserved. <a href="#" style="text-decoration: none; color:blue;">Privacy Policy</a></p>
        </footer>
        <script>
            const greetingElement = document.getElementById("greeting");
        
            const currentHour = new Date().getHours();
        
            let greetingMessage;
        
            if (currentHour < 12) {
              greetingMessage = "Hello, Good morning!";
            } else if (currentHour < 18) {
              greetingMessage = "Hello, Good afternoon!";
            } else {
              greetingMessage = "Hello, Good evening!";
            }
        
            greetingElement.textContent = greetingMessage;
          </script>
        
    </body>
</html>