<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'db_connection.php';

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $workout_type = $_POST['workout_type'];
    $duration = $_POST['duration'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO workouts (user_id, date, workout_type, duration, notes) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $date, $workout_type, $duration, $notes);

    if ($stmt->execute()) {
        $success_message = "Workout tracked successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM workouts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$workouts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();

// Define workout types (you can also fetch this from a database)
$workout_types = [
    'Cardio' => 'Cardio',
    'Strength Training' => 'Strength Training',
    'Yoga' => 'Yoga',
    'Pilates' => 'Pilates',
    'HIIT' => 'HIIT',
    'Swimming' => 'Swimming'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Workout - Fitness Tracker</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
        }
        form input, form select, form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f4f4f4;
        }
    </style>
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
            <h2>Track Your Workout</h2>
            <?php if (isset($success_message)): ?>
                <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <form action="track.php" method="post">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="workout_type">Workout Type:</label>
                <select id="workout_type" name="workout_type" required>
                    <?php foreach ($workout_types as $key => $value): ?>
                        <option value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($value); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="duration">Duration (minutes):</label>
                <input type="number" id="duration" name="duration" required>

                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes" rows="4"></textarea>

                <button type="submit">Track Workout</button>
            </form>
            <?php if ($workouts): ?>
                <h3>Your Workout History</h3>
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
                                <td><?php echo htmlspecialchars($workout['duration']); ?></td>
                                <td><?php echo htmlspecialchars($workout['notes']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No workout history available.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fitness Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
