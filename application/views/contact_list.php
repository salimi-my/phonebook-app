<main role="main" class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-10 col-lg-7">
			<h2 class="mt-5 mb-5 text-center"><i class="fas fa-address-book text-primary"></i> Phonebook App</h2>
			<div class="card mb-3">
				<div class="card-body table-responsive">
					<table id="contact_table" class="table table-hover table-striped">
						<thead>
							<th class="text-left"><b>No.</b></th>
							<th class="text-left">Name</th>
							<th class="text-left">Phone No.</th>
							<th class="text-center">Action</th>
						</thead>
						<tbody>
							<?php $count = 0;
							foreach ($contact as $row) {
								$count++; ?>
								<tr>
									<td class="text-left"><b><?php echo $count ?></b></td>
									<td class="text-left"><?php echo $row['name'] ?></td>
									<td class="text-left"><?php echo $row['phone'] ?></td>
									<td class="text-center nowrap">
										<button type="button" class="btn btn-outline-warning edit-button btn-sm" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-number="<?php echo $row['phone'] ?>"><i class="fas fa-edit"></i></button>&nbsp;
										<button type="button" class="btn btn-outline-danger delete-button btn-sm" data-id="<?php echo $row['id'] ?>"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				</div>
			</div>
			<button id="add_new" type="button" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i> Add New</button>
		</div>
	</div>

	<!-- Edit contact form -->
	<div id="edit_form_row" class="row justify-content-center" style="display:none;">
		<div class="mt-3 col-xs-12 col-sm-10 col-lg-7">
			<div class="card margin-bottom">
				<div class="card-body">
					<h5 class="card-title mb-4 text-center">Edit Contact</h5>
					<div id="success_alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
						<i class="fas fa-check-circle"></i> <strong>Success!</strong> <span id="success_message"></span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<div id="error_alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
						<i class="fas fa-exclamation-triangle"></i> <strong>Error!</strong> <span id="error_message"></span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<form id="edit_form" name="edit_form">
						<div class="mb-3">
							<label for="contact_name" class="form-label">Contact Name</label>
							<input type="text" class="form-control" id="contact_name" name="contact_name">
							<div id="contact_name_error" class="invalid-feedback"></div>
						</div>
						<div class="mb-3">
							<label for="phone_number" class="form-label">Phone No.</label>
							<input type="text" class="form-control" id="phone_number" name="phone_number">
							<div id="phone_number_error" class="invalid-feedback"></div>
						</div>
						<input type="hidden" class="form-control" id="contact_id" name="contact_id">
						<button id="update_submit" name="update_submit" type="submit" class="btn btn-primary">Update</button>
						<button id="update_loading" type="button" style="display: none;" class="btn btn-primary">
							<i class="fas fa-spinner fa-pulse"></i> Updating...
						</button>
						<button id="update_submitted" type="button" style="display: none;" class="btn btn-primary">
							<i class="fas fa-check-circle"></i> Updated
						</button>
						<button id="update_cancel" type="button" class="btn btn-light">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>

	<!-- Add contact form -->
	<div id="add_form_row" class="row justify-content-center" style="display:none;">
		<div class="mt-3 col-xs-12 col-sm-10 col-lg-7">
			<div class="card margin-bottom">
				<div class="card-body">
					<h5 class="card-title mb-4 text-center">Add Contact</h5>
					<div id="success_alert2" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
						<i class="fas fa-check-circle"></i> <strong>Success!</strong> <span id="success_message2"></span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<div id="error_alert2" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
						<i class="fas fa-exclamation-triangle"></i> <strong>Error!</strong> <span id="error_message2"></span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<form id="add_form" name="add_form">
						<div class="mb-3">
							<label for="contact_name2" class="form-label">Contact Name</label>
							<input type="text" class="form-control" id="contact_name2" name="contact_name">
							<div id="contact_name2_error" class="invalid-feedback"></div>
						</div>
						<div class="mb-3">
							<label for="phone_number2" class="form-label">Phone No.</label>
							<input type="text" class="form-control" id="phone_number2" name="phone_number">
							<div id="phone_number2_error" class="invalid-feedback"></div>
						</div>
						<button id="add_submit" name="update_submit" type="submit" class="btn btn-primary">Save</button>
						<button id="add_loading" type="button" style="display: none;" class="btn btn-primary">
							<i class="fas fa-spinner fa-pulse"></i> Saving...
						</button>
						<button id="add_submitted" type="button" style="display: none;" class="btn btn-primary">
							<i class="fas fa-check-circle"></i> Saved
						</button>
						<button id="update_cancel2" type="button" class="btn btn-light">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>

	<!-- Delete contact modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="delete_contact_modal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Are you sure?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Do you really want to delete this contact?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light mr-1" data-bs-dismiss="modal">Cancel</button>
					<button id="delete_contact_submit" name="delete_contact_submit" type="submit" class="btn btn-danger">&emsp;Yes&emsp;</button>
					<button id="delete_contact_loading" type="button" style="display: none;" class="btn btn-danger">
						<i class="fas fa-spinner fa-pulse"></i> Deleting...
					</button>
					<button id="contact_deleted" type="button" style="display: none;" class="btn btn-danger">
						<i class="fas fa-check-circle"></i> Deleted
					</button>
				</div>
			</div>
		</div>
	</div>
</main>