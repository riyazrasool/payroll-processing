<?php 
// Include database connection or any necessary server-side scripts
include 'db_connect.php';
?>

<div class="container-fluid mt-4">
    <!-- Row for adding a new user button -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user">
                <i class="fa fa-plus"></i> Add New User
            </button>
        </div>
    </div>

    <!-- Row for user search bar -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <input type="text" id="search_user" class="form-control" placeholder="Search Users..." onkeyup="searchUser()">
        </div>
    </div>

    <!-- Row for user table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="card-title mb-0">User Management</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="user_table_body">
                            <?php
                                $users = $conn->query("SELECT * FROM users ORDER BY name ASC");
                                $i = 1;
                                while ($row = $users->fetch_assoc()):
                            ?>
                            <tr class="user-row" data-name="<?php echo htmlspecialchars($row['name']); ?>">
                                <td><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info btn-sm">Options</button>
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id']; ?>'>
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id']; ?>'>
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Modal for adding a new user
        $('#new_user').click(function() {
            uni_modal('New User', 'manage_user.php');
        });

        // Modal for editing an existing user
        $(document).on('click', '.edit_user', function() {
            var userId = $(this).data('id');
            uni_modal('Edit User', 'manage_user.php?id=' + userId);
        });

        // Confirmation and deletion of a user
        $(document).on('click', '.delete_user', function() {
            var userId = $(this).data('id');
            _conf("Are you sure to delete this user?", "delete_user", [userId]);
        });

        // Function to delete a user
        function delete_user(id) {
            start_load(); // Custom function to show loading
            $.ajax({
                url: 'ajax.php?action=delete_user',
                method: 'POST',
                data: { id: id },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully deleted", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert_toast("Failed to delete data", 'danger');
                    }
                },
                error: function() {
                    alert_toast("An error occurred", 'danger');
                },
                complete: function() {
                    end_load(); // Custom function to hide loading
                }
            });
        }

        // Search function for users
        window.searchUser = function() {
            var input = document.getElementById("search_user");
            var filter = input.value.toLowerCase();
            var rows = document.querySelectorAll("#user_table_body .user-row");

            rows.forEach(function(row) {
                var name = row.dataset.name.toLowerCase();
                if (name.includes(filter)) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            });
        }
    });
</script>
