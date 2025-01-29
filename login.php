<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Payroll Processing</title>

  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
  ?>

  <style>
    body {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: url('assets/img/6057485.jpg') no-repeat center center fixed; /* Updated local image path */
      background-size: cover; /* Cover the entire area */
      margin: 0;
    }

    main#main {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #login-container {
      width: 400px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.1); /* Slight transparent background to match with theme */
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      color: white; /* Matching text color with the dark background */
    }

    .logo {
      margin: auto;
      font-size: 4rem;
      background: rgba(255, 255, 255, 0.1);
      padding: .5em 0.7em;
      border-radius: 50%;
      color: white; /* Matching color with the theme */
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }
  </style>

</head>

<body>

  <main id="main">
    <div id="login-container">
      <div class="logo">
        <span class="fa fa-user-circle"></span>
      </div>
      <div class="card-body">
        <form id="login-form">
          <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <center><button type="submit" class="btn btn-block btn-primary">Login</button></center>
        </form>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script>
    $('#login-form').submit(function(e) {
      e.preventDefault();
      $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
      if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
          console.log(err);
          $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
        },
        success: function(resp) {
          if (resp == 1) {
            location.href = 'index.php?page=home';
          } else if (resp == 2) {
            location.href = 'voting.php';
          } else {
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
            $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
          }
        }
      });
    });
  </script>

</body>

</html>
