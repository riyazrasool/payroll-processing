<?php include('db_connect.php'); ?>

<div class="container-fluid mt-4"> <!-- Added margin-top to create space -->
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white">
                        <strong>Department Form</strong>
                    </div>
                    <div class="card-body">
                        <form action="" id="manage-department">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label font-weight-bold">Department Name</label>
                                <textarea name="name" id="" cols="30" rows="2" class="form-control rounded" placeholder="Enter department name" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary btn-sm px-4" id="save_department">Save</button>
                        <button class="btn btn-light btn-sm px-4" type="button" onclick="_reset()">Cancel</button>
                    </div>
                </div>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white">
                        <strong>Department List</strong>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $department = $conn->query("SELECT * FROM department ORDER BY id ASC");
                                while($row = $department->fetch_assoc()): 
                                ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><b><?php echo htmlspecialchars($row['name']); ?></b></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary edit_department" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo htmlspecialchars($row['name']); ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete_department" type="button" data-id="<?php echo $row['id'] ?>">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }
    .select2-container {
        width: 100% !important;
    }
    /* Additional Styles */
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

<script>
    function _reset() {
        $('[name="id"]').val('');
        $('#manage-department')[0].reset();
    }

    $(document).ready(function() {
        // Form submission handling
        $('#save_department').click(function() {
            $('#manage-department').submit();
        });

        $('#manage-department').submit(function(e) {
            e.preventDefault();
            start_load(); // Show loading spinner
            $.ajax({
                url: 'ajax.php?action=save_department',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully added", 'success');
                    } else if (resp == 2) {
                        alert_toast("Data successfully updated", 'success');
                    } else {
                        alert_toast("An error occurred", 'danger');
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
                error: function() {
                    alert_toast("An error occurred while processing the request", 'danger');
                },
                complete: function() {
                    end_load(); // Hide loading spinner
                }
            });
        });

        // Edit department
        $('.edit_department').click(function() {
            start_load(); // Show loading spinner
            var form = $('#manage-department');
            form[0].reset();
            form.find("[name='id']").val($(this).data('id'));
            form.find("[name='name']").val($(this).data('name'));
            end_load(); // Hide loading spinner
        });

        // Delete department
        $('.delete_department').click(function() {
            _conf("Are you sure to delete this department?", "delete_department", [$(this).data('id')]);
        });

        // Delete department function
        function delete_department(id) {
            start_load(); // Show loading spinner
            $.ajax({
                url: 'ajax.php?action=delete_department',
                method: 'POST',
                data: { id: id },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully deleted", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert_toast("An error occurred while deleting the data", 'danger');
                    }
                },
                error: function() {
                    alert_toast("An error occurred", 'danger');
                },
                complete: function() {
                    end_load(); // Ensure spinner is hidden
                }
            });
        }
    });
</script>
