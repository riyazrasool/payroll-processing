<?php include('db_connect.php'); ?>

<div class="container-fluid mt-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white">
                <span><b>Employee List</b></span>
                <button class="btn btn-light btn-sm float-right" type="button" id="new_emp_btn">
                    <span class="fa fa-plus"></span> Add Employee
                </button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Employee No</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $d_arr[0] = "Unset";
                        $p_arr[0] = "Unset";
                        $dept = $conn->query("SELECT * FROM department ORDER BY name ASC");
                        while ($row = $dept->fetch_assoc()):
                            $d_arr[$row['id']] = $row['name'];
                        endwhile;

                        $pos = $conn->query("SELECT * FROM position ORDER BY name ASC");
                        while ($row = $pos->fetch_assoc()):
                            $p_arr[$row['id']] = $row['name'];
                        endwhile;

                        $employee_qry = $conn->query("SELECT * FROM employee") or die(mysqli_error($conn));
                        while ($row = $employee_qry->fetch_array()):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['employee_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['middlename']); ?></td>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($d_arr[$row['department_id']]); ?></td>
                            <td><?php echo htmlspecialchars($p_arr[$row['position_id']]); ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary view_employee" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary edit_employee" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger remove_employee" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable
        $('#table').DataTable();

        // View Employee
        $('.view_employee').click(function() {
            var id = $(this).data('id');
            uni_modal("Employee Details", "view_employee.php?id=" + id, "mid-large");
        });

        // Edit Employee
        $('.edit_employee').click(function() {
            var id = $(this).data('id');
            uni_modal("Edit Employee", "manage_employee.php?id=" + id);
        });

        // Add New Employee
        $('#new_emp_btn').click(function() {
            uni_modal("New Employee", "manage_employee.php");
        });

        // Remove Employee
        $('.remove_employee').click(function() {
            var id = $(this).data('id');
            _conf("Are you sure to delete this employee?", "remove_employee", [id]);
        });
    });

    function remove_employee(id) {
        start_load(); // Show loading spinner
        $.ajax({
            url: 'ajax.php?action=delete_employee',
            method: 'POST',
            data: { id: id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Employee's data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    alert_toast("Failed to delete employee's data", 'danger');
                }
            },
            error: function() {
                alert_toast("An error occurred", 'danger');
            },
            complete: function() {
                end_load(); // Hide loading spinner
            }
        });
    }
</script>

<style>
    /* Additional Styles for Consistency */
    .card {
        border-radius: 10px;
    }
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #00c6ff);
    }
    .btn-outline-primary, .btn-outline-danger {
        border-radius: 20px;
        transition: background 0.3s, color 0.3s;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
