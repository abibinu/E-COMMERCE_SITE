<?php
// signup.php
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

// Signup form submission
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    // Generate a unique user_id
    $user_id = uniqid();

    // Query to insert user data
    $sql = "INSERT INTO users (user_id, username, email, password, account_type) VALUES ('$user_id', '$username', '$email', '$password', 'user')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['account_type'] = $account_type;
        $_SESSION['user_id'] = $user_id; // Store the user_id in the session
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Failed to create account';
    }
}

// HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Sign up | THE FIND</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="signupstyle.css">
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
    <section id="signup">
        <h1>Sign up</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <!-- <label for="account_type">Account Type:</label>
            <select id="account_type" name="account_type" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br><br> -->
            <input type="submit" name="submit" value="Sign up">
            <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
        </form>
        <p style="color: white;">Already have an account? <a style="color: blue;" href="login.php">Login</a></p>
    </section>
</body>
</html>