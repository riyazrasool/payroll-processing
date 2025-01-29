<?php
// Database connection parameters
$host = '127.0.0.1';
$db = 'payroll';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Establish a database connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch user data
$user_id = 1; // You can change this to any user id you want to display
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .profile-card {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 5px solid #343a40;
        }
        .profile-name {
            font-size: 26px;
            font-weight: bold;
            color: #343a40;
        }
        .profile-contact {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 15px;
        }
        .profile-contact strong {
            color: #495057;
        }
        .profile-details {
            font-size: 16px;
            color: #495057;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
        }
        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <!-- Display Profile Image (You can use Gravatar or a placeholder image) -->
            <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-img">

            <!-- Display User Data -->
            <h3 class="profile-name"><?= htmlspecialchars($user['name']) ?></h3>
            <p class="profile-contact">
                <strong>Contact:</strong> <?= htmlspecialchars($user['contact']) ?><br>
                <strong>Address:</strong> <?= htmlspecialchars($user['address']) ?>
            </p>
            <div class="profile-details">
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Type:</strong> <?= $user['type'] == 1 ? 'Admin' : 'Staff' ?></p>
            </div>

            <!-- Display User Actions (Optional) -->
            <div class="mt-3">
                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary">Edit Profile</a>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
