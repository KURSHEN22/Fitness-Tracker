<?php
session_start();

// Check if user is already logged in, redirect if necessary
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle login errors
$login_error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : ''; // Ensure $login_error is always defined
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fitness Tracker</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script.js" defer></script> <!-- Make sure this path is correct -->
</head>
<body>
    <header>
        <div class="container">
            <h1>Fitness Tracker</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Login to Your Account</h2>
            <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
                <?php if ($login_error): ?>
                    <p class="error"><?php echo $login_error; ?></p>
                <?php endif; ?>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fitness Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
