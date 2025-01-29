<?php include('db_connect.php'); ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- FORM Panel -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white font-weight-bold">
                    Position Form
                </div>
                <div class="card-body">
                    <form id="manage-position">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label font-weight-bold">Department</label>
                            <select class="custom-select browser-default select2" name="department_id" required>
                                <option value="" disabled selected>Select Department</option>
                                <?php
                                $dept = $conn->query("SELECT * FROM department ORDER BY name ASC");
                                while ($row = $dept->fetch_assoc()):
                                ?>
                                <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label font-weight-bold">Position Name</label>
                            <textarea name="name" cols="30" rows="2" class="form-control rounded" placeholder="Enter position name" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm px-4" id="save_position">Save</button>
                            <button class="btn btn-light btn-sm px-4" type="button" onclick="_reset()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FORM Panel -->

        <!-- Table Panel -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-gradient-primary text-white font-weight-bold">
                    Position List
                    <button class="btn btn-sm btn-light float-right" id="new_position">
                        <i class="fa fa-plus"></i> New Position
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center py-3">#</th>
                                <th class="py-3">Position</th>
                                <th class="text-center py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $position = $conn->query("SELECT * FROM position ORDER BY id ASC");
                            while ($row = $position->fetch_assoc()): 
                            ?>
                            <tr class="align-middle">
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_position" type="button"
                                        data-id="<?php echo htmlspecialchars($row['id']); ?>"
                                        data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                        data-department_id="<?php echo htmlspecialchars($row['department_id']); ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete_position" type="button" data-id="<?php echo htmlspecialchars($row['id']); ?>">
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

<style>
    /* Card Shadow and Styling */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Header Gradient */
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #00c6ff);
    }

    /* Buttons Styling */
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

    /* Table Styling */
    table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    th, td {
        padding: 12px;
        vertical-align: middle !important;
    }

    .select2-container {
        width: 100% !important;
    }
</style>

<script>
    $(document).ready(function() {
        // Initialize Select2 Elements
        $('.select2').select2({
            placeholder: "Please Select Here",
            width: "100%"
        });

        // Reset form
        function _reset() {
            $('#manage-position')[0].reset();
            $('[name="id"]').val('');
            $('.select2').val('').trigger('change');
        }

        // Manage position form submission
        $('#save_position').click(function() {
            $('#manage-position').submit();
        });

        $('#manage-position').submit(function(e) {
            e.preventDefault();
            start_load(); // Show loading spinner
            $.ajax({
                url: 'ajax.php?action=save_position',
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

        // Edit position
        $('.edit_position').click(function() {
            start_load(); // Show loading spinner
            var form = $('#manage-position');
            form[0].reset();
            form.find("[name='id']").val($(this).data('id'));
            form.find("[name='name']").val($(this).data('name'));
            $('[name="department_id"]').val($(this).data('department_id')).trigger('change');
            end_load(); // Hide loading spinner
        });

        // Delete position
        $('.delete_position').click(function() {
            _conf("Are you sure to delete this position?", "delete_position", [$(this).data('id')]);
        });

        // Delete position function
        function delete_position(id) {
            start_load(); // Show loading spinner
            $.ajax({
                url: 'ajax.php?action=delete_position',
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

        // Add new position modal
        $('#new_position').click(function() {
            _reset();
            $('#manage-position')[0].reset();
        });
    });
</script>
