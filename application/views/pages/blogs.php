<?php
/**
 * @var array $a_current_blog
 * @var array $a_all_comments
 */

?>
<?php $this->load->view('pages/partials/side_bar') ?>
<main class="container">
	<div class="col-md-12">
		<article class="blog-post">
			<h2 class="blog-post-title"><?php echo $a_current_blog[Blog_Model::S_TABLE_FIELD_TITLE_BLOCK]; ?></h2>
			<p class="blog-post-meta">created at <?php echo $a_current_blog[Blog_Model::S_TABLE_FIELD_DATE_BLOCK]; ?>
				by <?php echo $a_current_blog[User_Model::S_TABLE_FIELD_FIRSTNAME] . ' ' . $a_current_blog[User_Model::S_TABLE_FIELD_NAME]; ?></p>

			<p><?php echo $a_current_blog[Blog_Model::S_TABLE_FIELD_CONTENT_BLOCK]; ?></p>
			<hr>

		</article>

		<label>Kommentare</label>
		<p><?php //print_r($a_all_comments);
			foreach ($a_all_comments as $comment_nr => $comment_value) {
				echo "Kommentar ";
				echo $comment_nr + 1;
				echo ": <br>";
				foreach ($comment_value as $comment) {
					echo "$comment <br>";
				}
				echo "<br>";
			}
			?>
		</p>
		<hr>
		<?php if (isset($a_current_user[user_model::S_TABLE_FIELD_ID])) { ?>
			<form method="post" action="<?php echo('/blog/add_comment') ?>">
				<input type="hidden" name="blog_entry_id" value="<?php echo $a_current_blog['id'] ?>">
				<div class="col-md-12">
					<div>
						<label>Titel<input name="<?php echo Blog_Model::S_TABLE_FIELD_TITLE_COMMENT ?>" type="text" class="form-control" required></label>
					</div>
					<label><textarea class="form-control" name="<?php echo Blog_Model::S_TABLE_FIELD_CONTENT_COMMENT ?>"></textarea></label>
					<button name="send" type="submit" class="btn btn-mat btn-info">Kommentar hinzufügen</button>
				</div>
			</form>
		<?php }
		?>
	</div>
</main>
<br>
<button type="button"><a href="<?php echo site_url('/blog/home') ?>">Zurück</a></button>
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
