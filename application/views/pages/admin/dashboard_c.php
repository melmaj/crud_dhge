<?php
/**
 * @var array $a_all_comments
 * @var string $s_pagination
 */
$this->load->view('pages/partials/side_bar_admin')
?>
<body>
<div class="container">
	<table class="table table-striped">
		<thead>
		<tr>
			<th>#ID</th>
			<th>Rezensions Titel</th>
			<th>Rezensions Inhalt</th>
			<th>Erstellt am</th>
			<th>Erstellt von</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php $count=0;
		foreach ($a_all_comments as $a_comment) {
			$count++;
			?>
			<tr>
				<td><?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT] ?></td>
				<td><?php echo $a_comment[Blog_model::S_TABLE_FIELD_TITLE_COMMENT] ?></td>
				<td><?php echo $a_comment[Blog_model::S_TABLE_FIELD_CONTENT_COMMENT] ?></td>
				<td><?php echo $a_comment[Blog_model::S_TABLE_FIELD_DATE_COMMENT] ?></td>
				<td><?php echo $a_comment[User_model::S_TABLE_FIELD_FIRSTNAME] . ' ' .  $a_comment[User_model::S_TABLE_FIELD_NAME]?></td>
				<td>
					<a href="#" class="btn btn-info btn-sm update-record" data-toggle="modal" data-target="#UpdateModal-<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>">Bearbeiten</a>
					<form action="<?php echo site_url('admin/edit_comment_entry');?>" method="post">
						<div class="modal fade" id="UpdateModal-<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Rezension bearbeiten</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Titel</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo Blog_model::S_TABLE_FIELD_TITLE_COMMENT ?>" class="form-control" value="<?php echo $a_comment[Blog_model::S_TABLE_FIELD_TITLE_COMMENT] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Inhalt</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="<?php echo Blog_model::S_TABLE_FIELD_CONTENT_COMMENT ?>"><?php echo $a_comment[Blog_model::S_TABLE_FIELD_CONTENT_COMMENT] ?></textarea>
											</div>
										</div>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="edit_id" value="<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Schließen</button>
										<button type="submit" class="btn btn-success btn-sm">Updaten</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<a href="#" class="btn btn-danger btn-sm delete-record" data-toggle="modal" data-target="#DeleteModal-<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>">Löschen</a>
					<form action="<?php echo site_url('admin/delete_comment');?>" method="post">
						<div class="modal fade" id="DeleteModal-<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Rezension löschen</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<h4>Bist du sicher, dass du die Rezension löschen möchtest?</h4>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="delete_id" value="<?php echo $a_comment[Blog_model::S_TABLE_FIELD_ID_COMMENT]; ?>">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Nein</button>
										<button type="submit" class="btn btn-success btn-sm">Ja</button>
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
