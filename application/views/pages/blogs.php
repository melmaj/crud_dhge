<?php
/**
 * @var array $a_current_blog
 * @var array $a_all_comments
 * @var array $a_current_user
 */

?>
<?php $this->load->view('pages/partials/side_bar') ?>
<main class="container">
	<div class="col-md-12">
		<article class="blog-post">
			<h2 class="blog-post-title"><?php echo $a_current_blog[Blog_model::S_TABLE_FIELD_TITLE_BLOCK]; ?></h2>
			<p class="blog-post-meta">created at <?php echo $a_current_blog[Blog_model::S_TABLE_FIELD_DATE_BLOCK]; ?>
				by <?php echo $a_current_blog[User_model::S_TABLE_FIELD_FIRSTNAME] . ' ' . $a_current_blog[User_model::S_TABLE_FIELD_NAME]; ?></p>

			<p><?php echo $a_current_blog[Blog_model::S_TABLE_FIELD_CONTENT_BLOCK]; ?></p>
			<hr>

		</article>
		<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_ID])) { ?>

            <form id="time-tracking-form">
			<div >
				<input type="hidden" id="userId" value="<?php echo $a_current_user[User_model::S_TABLE_FIELD_ID]; ?>">
				<input type="hidden" id="bookName" value="<?php echo $a_current_blog[Blog_model::S_TABLE_FIELD_TITLE_BLOCK]; ?>">

			</div>
                <div class="buttonbox"><button class="btn btn-lg btn-primary" id="submit-button" type="submit">Einstechen</button></div>
		</form>
		<form id="getter">
            <div> <button class="btn btn-lg btn-primary" id="get-button" type="submit">Ausstechen</button></div>
		</form>
		<div>
            <br>
            <p id="result" ></p>
        </div>
            <br>
            <hr>
		<?php }
		?>


		<h4><label>Kommentare</label></h4>
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
		<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_ID])) { ?>
			<form method="post" action="<?php echo('/blog/add_comment') ?>">
				<input type="hidden" name="blog_entry_id" value="<?php echo $a_current_blog['id'] ?>">
				<div class="col-md-16">
					<div>
						<label>Titel<input name="<?php echo Blog_model::S_TABLE_FIELD_TITLE_COMMENT ?>" type="text" class="form-control" required></label>
					</div>
					<label><textarea class="form-control" name="<?php echo Blog_model::S_TABLE_FIELD_CONTENT_COMMENT ?>"></textarea></label>
					<div><button name="send" type="submit" class="btn btn-mat btn-info">Kommentar hinzufügen</button></div>
				</div>
			</form>
		<?php }
		?>
	</div>
</main>
<br>
<button type="button"><a href="<?php echo site_url('/blog/home') ?>">Zurück</a></button>
<script>const form = document.querySelector('form');
	const inputValueUser = document.getElementById('userId');
	const inputValueBook = document.getElementById('bookName');
	const resultText = document.getElementById('result');
	const getter = document.getElementById('getter');


	form.addEventListener('submit', (event) => {
		event.preventDefault();

		const UserToSend = inputValueUser.value;
		const BookToSend = inputValueBook.value;
		const apiUrl = 'https://sxge7l8yuj.execute-api.eu-central-1.amazonaws.com/prod';

		fetch(apiUrl, {

			method: 'POST',
			body: JSON.stringify({'userId': UserToSend, 'bookName':BookToSend, 'buttonType': 'submit' })
		})
			.then(response => response.json())

			.then(data => {
				if (data.errorMessage) {
					resultText.textContent = data.errorMessage;
				} else {
					let str = `${data.body}`;
					resultText.textContent = str.replace("GMT+0000 (Coordinated Universal Time)", "");
				}
			})

			.then(data => console.log(data))
			.catch(error => console.error(error))
	});

	getter.addEventListener('submit', (event) => {
		event.preventDefault();

		const UserToSend = inputValueUser.value;
		const BookToSend = inputValueBook.value;
		const apiUrl = 'https://sxge7l8yuj.execute-api.eu-central-1.amazonaws.com/prod';

		fetch(apiUrl, {

			method: 'POST',
			body: JSON.stringify({'userId': UserToSend, 'bookName':BookToSend, 'buttonType': 'get' })
		})
			.then(response => response.json())

			.then(data => {
				if (data.errorMessage) {
					resultText.textContent = data.errorMessage;
				} else {
					let str = `${data.body}`;
					resultText.textContent = str.replace("GMT+0000 (Coordinated Universal Time)", "");
				}
			})

			.then(data => console.log(data))
			.catch(error => console.error(error))
	});	</script>
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
