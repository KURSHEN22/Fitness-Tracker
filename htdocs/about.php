<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Fitness Tracker</title>
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
        <div class="container">
            <h2>About Us</h2>
            <section class="about-content">
                <div class="about-text">
                    <p>Welcome to Fitness Tracker, your comprehensive solution for managing and enhancing your fitness journey. Our platform is designed to help you stay on track with your workout goals, monitor your progress, and build a healthier lifestyle.</p>

                    <p><strong>Our Mission</strong></p>
                    <p>At Fitness Tracker, our mission is to empower individuals to lead healthier lives through fitness. We understand that each person's fitness journey is unique, and we strive to provide the tools and resources necessary to support and motivate you along the way.</p>

                    <p><strong>What We Offer</strong></p>
                    <p>We offer a range of features to help you achieve your fitness goals, including:</p>
                    <ul>
                        <li><strong>Workout Logging:</strong> Easily track your workouts, including details such as date, type, duration, and notes.</li>
                        <li><strong>Progress Monitoring:</strong> View your workout history and analyze your progress over time with detailed reports.</li>
                        <li><strong>Personalized Goals:</strong> Set and manage fitness goals tailored to your needs and preferences.</li>
                        <li><strong>Community Support:</strong> Connect with others on their fitness journeys and gain inspiration and support from our community.</li>
                    </ul>

                    <p><strong>Why Fitness Matters</strong></p>
                    <p>Fitness is more than just physical exercise; it's a holistic approach to health and well-being. Regular exercise improves cardiovascular health, strengthens muscles, enhances mental health, and boosts overall energy levels. A balanced fitness routine contributes to a higher quality of life and helps prevent various health conditions.</p>

                    <p><strong>Our Team</strong></p>
                    <p>Our team consists of dedicated fitness enthusiasts, experienced trainers, and health experts who are passionate about helping you reach your full potential. We continuously update our platform with the latest fitness trends and best practices to ensure you receive the most effective and enjoyable experience.</p>

                    <p><strong>Join Us Today</strong></p>
                    <p>Whether you're just starting your fitness journey or looking to take your workouts to the next level, Fitness Tracker is here to support you. Sign up today to begin tracking your workouts, setting goals, and achieving your fitness aspirations.</p>
                </div>
                <div class="about-images">
                    <img src="images/fitness-team.jpg" alt="Fitness Team">
                    <img src="images/workout-session.jpg" alt="Workout Session">
                    <img src="images/healthy-lifestyle.jpg" alt="Healthy Lifestyle">
                </div>
            </section>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fitness Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
