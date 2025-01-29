<?php include('db_connect.php'); ?>

<div class="container-fluid mt-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white">
                <span><b>Payroll List</b></span>
                <button class="btn btn-light btn-sm float-right" type="button" id="new_payroll_btn">
                    <span class="fa fa-plus"></span> Add Payroll
                </button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ref No</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $payroll = $conn->query("SELECT * FROM payroll ORDER BY date(date_from) DESC") or die(mysqli_error($conn));
                        while ($row = $payroll->fetch_array()):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['ref_no']); ?></td>
                            <td><?php echo date("M d, Y", strtotime($row['date_from'])); ?></td>
                            <td><?php echo date("M d, Y", strtotime($row['date_to'])); ?></td>
                            <td class="text-center">
                                <?php if ($row['status'] == 0): ?>
                                    <span class="badge badge-primary">New</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Calculated</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($row['status'] == 0): ?>
                                    <button class="btn btn-sm btn-outline-primary calculate_payroll" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button">Calculate</button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-primary view_payroll" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button"><i class="fa fa-eye"></i></button>
                                <?php endif; ?>
                                <button class="btn btn-sm btn-outline-primary edit_payroll" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger remove_payroll" data-id="<?php echo htmlspecialchars($row['id']); ?>" type="button"><i class="fa fa-trash"></i></button>
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

        // Handle Edit Payroll
        $('.edit_payroll').click(function() {
            var id = $(this).data('id');
            uni_modal("Edit Payroll", "manage_payroll.php?id=" + id);
        });

        // Handle View Payroll
        $('.view_payroll').click(function() {
            var id = $(this).data('id');
            location.href = "index.php?page=payroll_items&id=" + id;
        });

        // Handle New Payroll
        $('#new_payroll_btn').click(function() {
            uni_modal("New Payroll", "manage_payroll.php");
        });

        // Handle Remove Payroll
        $('.remove_payroll').click(function() {
            var id = $(this).data('id');
            _conf("Are you sure you want to delete this payroll?", "remove_payroll", [id]);
        });

        // Handle Calculate Payroll
        $('.calculate_payroll').click(function() {
            var id = $(this).data('id');
            start_load(); // Show loading spinner
            $.ajax({
                url: 'ajax.php?action=calculate_payroll',
                method: 'POST',
                data: { id: id },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Payroll successfully computed", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        alert_toast("Failed to compute payroll", 'danger');
                    }
                },
                error: function() {
                    alert_toast("An error occurred", 'danger');
                },
                complete: function() {
                    end_load(); // Hide loading spinner
                }
            });
        });
    });

    function remove_payroll(id) {
        start_load(); // Show loading spinner
        $.ajax({
            url: 'ajax.php?action=delete_payroll',
            method: 'POST',
            data: { id: id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Payroll successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    alert_toast("Failed to delete payroll", 'danger');
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
