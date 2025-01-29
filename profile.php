<?php
// Include the database connection file
include 'db_connect.php';

// Start session to get the logged-in user ID
session_start();

// Assume employee_id is available for now, or handle default case
$employee_id = isset($_SESSION['employee_id']) ? $_SESSION['employee_id'] : 1; // Default to employee ID 1 for demonstration

// Fetch employee details including username, department, position, and employee number
$query = $conn->query("SELECT e.employee_no, e.firstname, e.middlename, e.lastname, e.salary, 
                              d.name as department_name, p.name as position_name, u.username
                       FROM employee e 
                       LEFT JOIN department d ON e.department_id = d.id
                       LEFT JOIN position p ON e.position_id = p.id 
                       LEFT JOIN users u ON u.id = e.id
                       WHERE e.id = $employee_id");

$employee = $query ? $query->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Employee Profile</h3>
        </div>
        <div class="card-body">
            <?php if($employee): ?>
                <p><strong>Employee No:</strong> <?php echo $employee['employee_no']; ?></p>
                <p><strong>Name:</strong> <?php echo $employee['firstname'] . ' ' . $employee['middlename'] . ' ' . $employee['lastname']; ?></p>
                <p><strong>Username:</strong> <?php echo $employee['username']; ?></p>
                <p><strong>Department:</strong> <?php echo $employee['department_name']; ?></p>
                <p><strong>Position:</strong> <?php echo $employee['position_name']; ?></p>
                <p><strong>Salary:</strong> <?php echo number_format($employee['salary'], 2); ?></p>
            <?php else: ?>
                <p>Employee details not found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
