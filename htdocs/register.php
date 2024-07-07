<?php
// Handle registration errors
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Fitness Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Fitness Tracker</h1>
            
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Create an Account</h2>
            <form action="register_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <label for="height">Height (in cm):</label>
                <input type="number" id="height" name="height" required>

                <label for="weight">Weight (in kg):</label>
                <input type="number" id="weight" name="weight" required>

                <button type="submit">Register</button>
                <?php if ($error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php elseif ($success): ?>
                    <p class="success"><?php echo $success; ?></p>
                <?php endif; ?>
            </form>
            <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fitness Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
