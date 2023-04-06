<?php
/**
 * @var int $i_num_blog_entries
 * @var array $a_all_blog_entries
 * @var array $a_blog_entries_top_10
 * @var string $s_pagination
 */
$this->load->view('pages/partials/side_bar_admin')
?>
<body>
<div class="container">
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal">Erstelle neues Buch</button><br/>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>#ID</th>
			<th>Buch Titel</th>
			<th>Buch Inhalt</th>
			<th>Erstellt am</th>
			<th>Erstellt von</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php $count=0;
		foreach ($a_all_blog_entries as $a_blog_entry) {
			$count++;
			?>
			<tr>
				<td><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK] ?></td>
				<td><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_TITLE_BLOCK] ?></td>
				<td><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_CONTENT_BLOCK] ?></td>
				<td><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_DATE_BLOCK] ?></td>
				<td><?php echo $a_blog_entry[User_model::S_TABLE_FIELD_FIRSTNAME] . ' ' .  $a_blog_entry[User_model::S_TABLE_FIELD_NAME]?></td>

				<td>
					<a href="#" class="btn btn-info btn-sm update-record" data-toggle="modal" data-target="#UpdateModal-<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>" >Bearbeiten</a>
					<form action="<?php echo site_url('admin/edit_blog');?>" method="post">
						<div class="modal fade" id="UpdateModal-<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Buch bearbeiten</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Titel</label>
											<div class="col-sm-10">
												<input type="text" name="<?php echo Blog_model::S_TABLE_FIELD_TITLE_BLOCK ?>" class="form-control" value="<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_TITLE_BLOCK] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Inhalt</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="<?php echo Blog_model::S_TABLE_FIELD_CONTENT_BLOCK ?>"><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_CONTENT_BLOCK] ?></textarea>
											</div>
										</div>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="edit_id" value="<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Schließen</button>
										<button type="submit" class="btn btn-success btn-sm">Updaten</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<a href="#" class="btn btn-danger btn-sm delete-record" data-toggle="modal" data-target="#DeleteModal-<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>" >Löschen</a>
					<form action="<?php echo site_url('admin/delete_blog_entry');?>" method="post">
						<div class="modal fade" id="DeleteModal-<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Buch löschen</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<h4>Bist du sicher, dass du das Buch löschen möchtest?</h4>

									</div>
									<div class="modal-footer">
										<input type="hidden" name="delete_id" value="<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]; ?>">
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

<!-- Add New Blog Modal -->
<form action="<?php echo site_url('admin/new_blog_entry');?>" method="post">
	<div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Erstelle neues Buch</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Titel</label>
						<div class="col-sm-10">
							<input type="text" name="<?php echo Blog_model::S_TABLE_FIELD_TITLE_BLOCK ?>" class="form-control" placeholder="Buchname" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Inhalt</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="<?php echo Blog_model::S_TABLE_FIELD_CONTENT_BLOCK ?>"></textarea>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Schließen</button>
					<button type="submit" class="btn btn-success btn-sm">Speichern</button>
				</div>
			</div>
		</div>
	</div>
</form>



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
