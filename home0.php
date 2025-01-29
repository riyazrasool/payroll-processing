<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Tags for SEO -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Payroll Management System Home Page">
  <meta name="keywords" content="Payroll, Management, System">
  <meta name="author" content="Your Name">

  <!-- Favicon -->
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="assets/DataTables/datatables.min.css" rel="stylesheet">
  <link href="assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
  <link href="assets/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/jquery-te-1.4.0.css">

  <!-- Custom Styles -->
  <style>
    /* General Styles */
    body {
      background-color: #f8f9fa; /* Light background */
      color: #343a40; /* Dark text for contrast */
      font-family: 'Poppins', sans-serif; /* Modern, clean font */
      overflow-x: hidden; /* Prevent horizontal overflow */
    }

    .container-fluid {
      padding-top: 50px; /* Add top padding */
    }

    .card {
      background: linear-gradient(145deg, #ffffff, #e9ecef); /* Light gradient background for cards */
      border: none;
      border-radius: 15px; /* Rounded corners */
      transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for effects */
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Light shadow */
    }

    .card:hover {
      transform: translateY(-10px); /* Lift effect */
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }

    .card-body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 150px; /* Increased height for a more balanced look */
      text-align: center; /* Center the text */
    }

    .welcome-message {
      font-size: 2rem; /* Larger font size for prominence */
      font-weight: 600;
      color: #343a40; /* Darker text color */
      animation: fadeIn 2s ease-in-out; /* Smooth fade-in animation */
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .btn-custom {
      background-color: #007bff; /* Bootstrap primary color */
      color: #ffffff;
      border: none;
      border-radius: 30px; /* Rounded button */
      padding: 10px 20px;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #0056b3; /* Darker shade on hover */
      transform: translateY(-3px); /* Slight lift on hover */
      box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3); /* Button shadow on hover */
    }

    /* Add subtle background pattern */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/pattern-light.png'); /* Light pattern image */
      opacity: 0.1; /* Subtle effect */
      z-index: -1;
    }
  </style>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/DataTables/datatables.min.js"></script>
  
  <!-- Additional JS Files -->
  <script src="assets/js/select2.min.js"></script>
  <script src="assets/js/jquery.datetimepicker.full.min.js"></script>
  <script src="assets/font-awesome/js/all.min.js"></script>
  <script src="assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 text-center">
        <!-- Logo -->
        <img src="assets/img/logo.jpg" alt="Logo" class="mb-4" width="150">
      </div>
    </div>

    <div class="row justify-content-center mt-4">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="welcome-message">
              <?php echo "Welcome back, " . $_SESSION['login_name'] . "!"; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-4">
      <div class="col-lg-4 text-center">
        <button class="btn btn-custom">Get Started</button>
      </div>
    </div>
  </div>

  <script>
    // Additional JavaScript can be added here
  </script>
</body>

</html>
 