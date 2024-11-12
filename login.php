<?php
// login.php
session_start();

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'miniproject';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login form submission
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve user data
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['account_type'] = $row['account_type'];
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

// HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login | THE FIND</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
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
    <section id="login">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Login">
            <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
        </form>
        <p style="color: white;">Don't have an account? <a style="color: blue;" href="signup.php">Sign up</a></p>
    </section>
</body>
</html>