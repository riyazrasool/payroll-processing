<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Navbar with Enhanced Dropdown</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #007bff, #0056b3); /* Gradient background */
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Larger shadow for depth */
        }

        /* Brand title styling */
        .navbar .brand-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        /* Hover effect on brand */
        .navbar .brand-title:hover {
            color: #ffdd57; /* Gold color hover */
            text-shadow: 0 2px 5px rgba(255, 221, 87, 0.8); /* Text shadow */
        }

        /* User Info Section */
        .navbar .user-info {
            font-size: 1rem;
            color: #fff;
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
        }

        .navbar .user-info .dropbtn {
            background: none;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .navbar .user-info .dropbtn i {
            margin-left: 10px;
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .navbar .user-info .dropbtn:hover i {
            transform: rotate(360deg); /* Icon rotate on hover */
        }

        /* Dropdown Menu */
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            min-width: 180px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Dropdown Links */
        .dropdown-content a {
            color: #007bff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 1rem;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        /* Hover effects for dropdown */
        .dropdown-content a:hover {
            background-color: #f8f9fa;
            padding-left: 24px; /* Padding left for sliding effect */
        }

        /* Show the dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Dropdown fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.75rem 1.5rem;
            }

            .navbar .brand-title {
                font-size: 1.2rem;
            }

            .navbar .user-info {
                font-size: 0.9rem;
            }

            .dropdown-content a {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="brand-title">
            Payroll Processing
        </div>
        <div class="dropdown user-info">
            <button class="dropbtn">
                <?php echo $_SESSION['login_name'] ?> 
                <i class="fa fa-user"></i>
            </button>
            <div class="dropdown-content">
                <a href="user_profile.php">Profile</a>
                <a href="Theme.php">Theme</a>
                <a href="ajax.php?action=logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Optional JS -->
    <script src="script.js"></script>
</body>
</html>
