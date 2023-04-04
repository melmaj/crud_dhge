<?php
/**
 * @var array $a_all_users
 * @var array $i_num_user
 * @var string $s_pagination
 */
$this->load->view('pages/partials/side_bar_admin')
?>
<body>
<div class="container">
	<br/>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>#id</th>
			<th>Vorname</th>
			<th>Nachname</th>
			<th>E-Mail-Adresse</th>
			<th>Admin-Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php $count=0;
		foreach ($a_all_users as $a_user) {
			$count++; ?>
			<tr>
				<td><?php echo $a_user[User_model::S_TABLE_FIELD_ID]  ?></td>
				<td><?php echo $a_user[User_model::S_TABLE_FIELD_FIRSTNAME] ?></td>
				<td><?php echo $a_user[User_model::S_TABLE_FIELD_NAME] ?></td>
				<td><?php echo $a_user[User_model::S_TABLE_FIELD_EMAIL] ?></td>
				<td><?php echo $a_user[User_model::S_TABLE_FIELD_ADMIN] ?></td>
				<td>
					<a href="#" class="btn btn-info btn-sm update-record"  data-toggle="modal" data-target="#UpdateModal-<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>">Edit</a>
					<form action="<?php echo site_url('admin/edit_user');?>" method="post">
						<div class="modal fade" id="UpdateModal-<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Update User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Vorname</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo User_model::S_TABLE_FIELD_FIRSTNAME ?>" class="form-control" value="<?php echo $a_user[User_model::S_TABLE_FIELD_FIRSTNAME] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Name</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo User_model::S_TABLE_FIELD_NAME ?>" class="form-control" value="<?php echo $a_user[User_model::S_TABLE_FIELD_NAME] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">E-Mail</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo User_model::S_TABLE_FIELD_EMAIL ?>" class="form-control" value="<?php echo $a_user[User_model::S_TABLE_FIELD_EMAIL] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Admin-Status</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo User_model::S_TABLE_FIELD_ADMIN ?>" class="form-control" value="<?php echo $a_user[User_model::S_TABLE_FIELD_ADMIN] ?>" required>
											</div>
										</div>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="edit_id" value="<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>"
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-success btn-sm">Update</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<a href="#" class="btn btn-danger btn-sm delete-record"  data-toggle="modal" data-target="#DeleteModal-<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>">Delete</a>
					<form action="<?php echo site_url('admin/delete_user');?>" method="post">
						<div class="modal fade" id="DeleteModal-<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<h4>Are you sure to delete this User?</h4>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="delete_id" value="<?php echo $a_user[User_model::S_TABLE_FIELD_ID]; ?>">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
										<button type="submit" class="btn btn-success btn-sm">Yes</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</td>
			</tr>
		<?php } ?>
		</tbody>

	</table>
	<nav aria-label="Page navigation dark">
		<ul class="pagination justify-content-center">
			<?php echo $s_pagination; ?>
		</ul>
	</nav>
</div>


<div class="col-8 p-5">
	<nav aria-label="Page navigation example">
		<ul class="pagination">

<?php
		for($i = $i_num_user; $i > 0; $i=$i-10) { ?>
			<li class="page-item"><a class="page-link" href="#"><?php echo round ( $i / 10 , $precision = 0 , $mode = PHP_ROUND_HALF_UP )+1?></a>
			</li> <?php }?>
		</ul>
	</nav>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
		integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
		crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
		crossorigin="anonymous"></script>
</body>
</html>
