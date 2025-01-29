<style>
  /* Sidebar container */
  #sidebar {
    background-color: #f8f9fa; /* Light gray background */
    color: #333; /* Dark text */
    min-height: 100vh; /* Full viewport height */
    padding-top: 20px;
    padding-left: 10px;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
  }

  /* Sidebar list */
  .sidebar-list {
    padding-top: 20px; /* Add padding to create space above the first item */
  }

  .sidebar-list a {
    padding: 15px 20px;
    font-size: 1rem;
    color: #333; /* Default dark text */
    text-decoration: none;
    display: flex; /* Use flexbox for alignment */
    align-items: center; /* Center items vertically */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 10px; /* Space between items */
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    background-color: #f8f9fa; /* Keep background light */
  }

  /* Active item */
  .sidebar-list a.active {
    background-color: #007bff; /* Primary blue background for active item */
    color: #fff; /* White text for active item */
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3); /* Slight shadow on active */
  }

  /* Non-active items */
  .sidebar-list a:not(.active) {
    color: #555; /* Slightly darker gray for non-active items */
    background-color: #e9ecef; /* Slightly darker background */
  }

  /* Hover effect for non-active items */
  .sidebar-list a:hover:not(.active) {
    background-color: #e2e6ea; /* Light gray on hover */
    color: #333; /* Keep text darker on hover */
  }

  /* Icon color */
  .sidebar-list .icon-field {
    margin-right: 10px;
    color: #007bff; /* Blue icons for all items */
  }

  /* Sidebar responsiveness */
  @media (max-width: 768px) {
    #sidebar {
      position: fixed;
      width: 100%;
      height: auto;
      min-height: auto;
      top: 0;
      z-index: 10; /* Ensure it's on top */
    }
  }
</style>

<nav id="sidebar" class='mx-lt-5'>
  <div class="sidebar-list">
    <a href="index.php?page=home" class="nav-item nav-home">
      <span class='icon-field'><i class="fa fa-home"></i></span> Home
    </a>
    <a href="index.php?page=attendance" class="nav-item nav-attendance">
      <span class='icon-field'><i class="fa fa-th-list"></i></span> Attendance
    </a>
    <a href="index.php?page=payroll" class="nav-item nav-payroll">
      <span class='icon-field'><i class="fa fa-columns"></i></span> Payroll List
    </a>
    <a href="index.php?page=employee" class="nav-item nav-employee">
      <span class='icon-field'><i class="fa fa-user-tie"></i></span> Employee List
    </a>
    <a href="index.php?page=department" class="nav-item nav-department">
      <span class='icon-field'><i class="fa fa-columns"></i></span> Department List
    </a>
    <a href="index.php?page=position" class="nav-item nav-position">
      <span class='icon-field'><i class="fa fa-user-tie"></i></span> Position List
    </a>
    <a href="index.php?page=allowances" class="nav-item nav-allowances">
      <span class='icon-field'><i class="fa fa-list"></i></span> Allowance List
    </a>
    <a href="index.php?page=deductions" class="nav-item nav-deductions">
      <span class='icon-field'><i class="fa fa-money-bill-wave"></i></span> Deduction List
    </a>
    <?php if ($_SESSION['login_type'] == 1): ?>
      <a href="index.php?page=users" class="nav-item nav-users">
        <span class='icon-field'><i class="fa fa-users"></i></span> Users
      </a>
    <?php endif; ?>
  </div>
</nav>

<script>
  // Add the 'active' class to the current selected navbar item
  $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
</script>
