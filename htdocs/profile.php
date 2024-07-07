<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'db_connection.php';

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Fetch user info
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch workout history
$sql = "SELECT * FROM workouts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$workouts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total duration by workout type
$workout_durations = [];
foreach ($workouts as $workout) {
    $type = $workout['workout_type'];
    if (!isset($workout_durations[$type])) {
        $workout_durations[$type] = 0;
    }
    $workout_durations[$type] += $workout['duration'];
}

$conn->close();

// Function to format duration for display
function formatDuration($duration) {
    return number_format($duration) . ' minutes';
}

// Define target duration for each type (for demonstration purposes)
$target_duration = 1000; // Example target duration in minutes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Fitness Tracker</title>
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
            <section class="profile-info">
                <h2>User Profile</h2>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Height:</strong> <?php echo htmlspecialchars($user['height']); ?> cm</p>
                <p><strong>Weight:</strong> <?php echo htmlspecialchars($user['weight']); ?> kg</p>
            </section>
            <section class="progress">
                <h3>Workout Progress</h3>
                <?php foreach ($workout_durations as $type => $duration): ?>
                    <?php
                    $progress_percentage = ($duration / $target_duration) * 100;
                    if ($progress_percentage > 100) $progress_percentage = 100;
                    ?>
                    <div class="progress-bar-label"><?php echo htmlspecialchars($type); ?></div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: <?php echo $progress_percentage; ?>%;">
                            <span><?php echo formatDuration($duration); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
            <section class="workout-history">
                <h3>Your Workout History</h3>
                <?php if ($workouts): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Duration</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($workouts as $workout): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($workout['date']); ?></td>
                                    <td><?php echo htmlspecialchars($workout['workout_type']); ?></td>
                                    <td><?php echo formatDuration($workout['duration']); ?></td>
                                    <td><?php echo htmlspecialchars($workout['notes']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No workout history available.</p>
                <?php endif; ?>
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
