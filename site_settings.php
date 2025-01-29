<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * from system_settings limit 1");
if($qry->num_rows > 0){
	foreach($qry->fetch_array() as $k => $val){
		$meta[$k] = $val;
	}
}
?>
<div class="container-fluid">
	<div class="card col-lg-12 shadow-sm">
		<div class="card-body">
			<form action="" id="manage-settings">
				<div class="form-group">
					<label for="name" class="control-label">System Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" required>
					<small class="form-text text-muted">Enter the name of your system</small>
				</div>
				<div class="form-group">
					<label for="email" class="control-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required>
					<small class="form-text text-muted">Provide a valid email address</small>
					<div class="invalid-feedback">Please enter a valid email address.</div>
				</div>
				<div class="form-group">
					<label for="contact" class="control-label">Contact</label>
					<input type="text" class="form-control" id="contact" name="contact" value="<?php echo isset($meta['contact']) ? $meta['contact'] : '' ?>" required pattern="\d{10}">
					<small class="form-text text-muted">Enter a 10-digit phone number</small>
					<div class="invalid-feedback">Please enter a valid contact number.</div>
				</div>
				<div class="form-group">
					<label for="about" class="control-label">About Content</label>
					<textarea name="about" class="form-control text-jqte" rows="4"><?php echo isset($meta['about_content']) ? $meta['about_content'] : '' ?></textarea>
					<small class="form-text text-muted">Write about your system here</small>
				</div>
				<div class="form-group">
					<label for="img" class="control-label">Image</label>
					<input type="file" class="form-control-file" name="img" onchange="displayImg(this,$(this))" accept="image/*">
					<small class="form-text text-muted">Upload an image (JPG, PNG, max size: 2MB)</small>
				</div>
				<div class="form-group">
					<img src="<?php echo isset($meta['cover_img']) ? 'assets/img/'.$meta['cover_img'] : 'assets/img/default.jpg' ?>" alt="" id="cimg" class="img-thumbnail">
				</div>
				<center>
					<button class="btn btn-primary btn-block col-md-2">Save</button>
					<div id="loading" style="display: none;" class="spinner-border text-primary" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</center>
			</form>
		</div>
	</div>
</div>

<style>
	img#cimg {
		max-height: 150px;
		max-width: 150px;
		margin-top: 10px;
	}
	.card {
		border-radius: 10px;
	}
</style>

<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			const file = input.files[0];
			if (file.size > 2 * 1024 * 1024) {
				alert("File size should not exceed 2MB");
				return;
			}
			const reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}
			reader.readAsDataURL(file);
		}
	}

	$('.text-jqte').jqte();

	$('#manage-settings').submit(function(e) {
		e.preventDefault();
		if (!this.checkValidity()) {
			e.stopPropagation();
			$(this).addClass('was-validated');
			return;
		}
		$('#loading').show();
		const formData = new FormData($(this)[0]);
		$.ajax({
			url: 'ajax.php?action=save_settings',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				$('#loading').hide();
				if (resp == 1) {
					alert('Data successfully saved.');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					alert('Error saving data.');
				}
			},
			error: function(err) {
				console.log(err);
				$('#loading').hide();
				alert('An error occurred while saving data.');
			}
		});
	});
</script>
