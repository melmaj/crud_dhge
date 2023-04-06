<?php
/**
 * @var array $a_current_book
 * @var array $a_all_comments
 * @var array $a_current_user
 */

?>
<?php $this->load->view('pages/partials/side_bar') ?>
<main class="container">
	<div class="col-md-12">
		<article class="book-post">
			<h2 class="book-post-title"><?php echo $a_current_book[Book_model::S_TABLE_FIELD_TITLE_BOOK]; ?></h2>
			<p class="book-post-meta">created at <?php echo $a_current_book[Book_model::S_TABLE_FIELD_DATE_BOOK]; ?>
				by <?php echo $a_current_book[User_model::S_TABLE_FIELD_FIRSTNAME] . ' ' . $a_current_book[User_model::S_TABLE_FIELD_NAME]; ?></p>

			<p><?php echo $a_current_book[Book_model::S_TABLE_FIELD_CONTENT_BOOK]; ?></p>
			<hr>

		</article>
		<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_ID])) { ?>
		<form id="time-tracking-form">
			<div >
				<input type="hidden" id="userId" value="<?php echo $a_current_user[User_model::S_TABLE_FIELD_ID]; ?>">
				<input type="hidden" id="bookId" value="<?php echo $a_current_book[Book_model::S_TABLE_FIELD_ID_BOOK]; ?>">

			</div>
			<button class="btn btn-lg btn-primary" id="submit-button" type="submit">Einstechen</button>
		</form>
		<form id="getter">
			<button class="btn btn-lg btn-primary" id="get-button" type="submit">Ausstechen</button>
		</form>
		<p id="result" class="m-2 col-md-4 mx-auto"></p>
		<?php }
		?>


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
		<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_ID])) { ?>
			<form method="post" action="<?php echo('/book/add_comment') ?>">
				<input type="hidden" name="book_entry_id" value="<?php echo $a_current_book['id'] ?>">
				<div class="col-md-12">
					<div>
						<label>Titel<input name="<?php echo Book_model::S_TABLE_FIELD_TITLE_COMMENT ?>" type="text" class="form-control" required></label>
					</div>
					<label><textarea class="form-control" name="<?php echo Book_model::S_TABLE_FIELD_CONTENT_COMMENT ?>"></textarea></label>
					<button name="send" type="submit" class="btn btn-mat btn-info">Kommentar hinzufügen</button>
				</div>
			</form>
		<?php }
		?>
	</div>
</main>
<br>
<button type="button"><a href="<?php echo site_url('/book/home') ?>">Zurück</a></button>
<script>const form = document.querySelector('form');
	const inputValueUser = document.getElementById('userId');
	const inputValueBook = document.getElementById('bookId');
	const resultText = document.getElementById('result');
	const getter = document.getElementById('getter');


	form.addEventListener('submit', (event) => {
		event.preventDefault();

		const UserToSend = inputValueUser.value;
		const BookToSend = inputValueBook.value;
		const apiUrl = 'https://sxge7l8yuj.execute-api.eu-central-1.amazonaws.com/prod';

		fetch(apiUrl, {

			method: 'POST',
			body: JSON.stringify({'userId': UserToSend, 'bookId':BookToSend, 'buttonType': 'submit' })
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
			body: JSON.stringify({'userId': UserToSend, 'bookId':BookToSend, 'buttonType': 'get' })
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
