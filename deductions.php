<?php include('db_connect.php'); ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- FORM Panel -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-gradient-primary text-white font-weight-bold">
                    Deductions Form
                </div>
                <div class="card-body">
                    <form id="manage-deductions">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="deduction" class="control-label font-weight-bold">Deduction Name</label>
                            <textarea name="deduction" id="deduction" class="form-control rounded" rows="2" placeholder="Enter deduction name..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label font-weight-bold">Description</label>
                            <textarea name="description" id="description" class="form-control rounded" rows="3" placeholder="Enter description..." required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm px-4">Save</button>
                            <button class="btn btn-light btn-sm px-4" type="button" onclick="_reset()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FORM Panel -->

        <!-- Table Panel -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-gradient-primary text-white font-weight-bold">
                    Deductions List
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center py-3">#</th>
                                <th class="py-3">Deduction Information</th>
                                <th class="text-center py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $deductions = $conn->query("SELECT * FROM deductions ORDER BY id ASC");
                            while ($row = $deductions->fetch_assoc()):
                            ?>
                            <tr class="align-middle">
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td>
                                    <p class="font-weight-bold mb-1"><?php echo htmlspecialchars($row['deduction']); ?></p>
                                    <p class="small text-muted mb-0"><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_deductions" type="button" data-id="<?php echo $row['id']; ?>" data-deduction="<?php echo htmlspecialchars($row['deduction']); ?>" data-description="<?php echo htmlspecialchars($row['description']); ?>">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger delete_deductions" type="button" data-id="<?php echo $row['id']; ?>">Delete</button>
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
    }
</style>

<script>
    function _reset() {
        $('#manage-deductions').trigger('reset');
        $('[name="id"]').val('');
    }

    $('#manage-deductions').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_deductions',
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
                }
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        });
    });

    $('.edit_deductions').click(function() {
        start_load();
        var form = $('#manage-deductions');
        form.trigger('reset');
        form.find("[name='id']").val($(this).data('id'));
        form.find("[name='deduction']").val($(this).data('deduction'));
        form.find("[name='description']").val($(this).data('description'));
        end_load();
    });

    $('.delete_deductions').click(function() {
        _conf("Are you sure you want to delete this deduction?", "delete_deductions", [$(this).data('id')]);
    });

    function delete_deductions(id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_deductions',
            method: 'POST',
            data: { id: id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
