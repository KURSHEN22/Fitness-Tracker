<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Fitness Tracker</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="track.php">Track Workout</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
            <div class="user-info">
                <?php if ($username): ?>
                    <span><?php echo htmlspecialchars($username); ?></span> | <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a> | <a href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="container">
                <h2>Welcome to Your Fitness Journey!</h2>
                <p>Your ultimate destination for tracking your fitness goals, getting workout plans, and staying motivated.</p>
            </div>
        </section>
        <section class="info">
            <div class="container">
                <h2>Why Fitness is Important</h2>
                <p>Fitness is crucial for maintaining a healthy lifestyle. Regular exercise helps you manage weight, improve mental health, boost your energy levels, and reduce the risk of chronic diseases. It can also enhance your overall quality of life by making you feel better and more confident.</p>
                <p>With our Fitness Tracker, you can easily log your workouts, set fitness goals, and monitor your progress. Join us and start your fitness journey today!</p>
            </div>
        </section>
        <section class="images">
            <div class="container">
                <div class="image-grid">
                    <div class="image-item">
                        <img src="images/workout1.jpg" alt="Strength Training">
                        <p>Strength Training</p>
                        <p>Enhance muscle strength and endurance with targeted weight lifting and resistance exercises.</p>
                    </div>
                    <div class="image-item">
                        <img src="images/workout2.webp" alt="Cardio Exercises">
                        <p>Cardio Exercises</p>
                        <p>Boost cardiovascular health with activities like running, cycling, and high-intensity interval training.</p>
                    </div>
                    <div class="image-item">
                        <img src="images/workout3.jpg" alt="Yoga and Stretching">
                        <p>Yoga and Stretching</p>
                        <p>Improve flexibility and reduce stress with various yoga poses and stretching routines.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fitness Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
