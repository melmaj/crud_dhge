<?php
/**
 * @var integer $error_code
 */
?>
<body>

<section id="contact">
	<div class="container bg-main section-padding mt-4">
		<h1 class="title">Admin-Login</h1>
		<?php
		switch ($error_code) {
			case 1:
				?> <p class="alert alert-danger"> Nutzername oder Passwort falsch</p>
				<?php
				break;
			case 2:
				?> <p class="alert alert-danger"> Kein Zugriff! Nur Admins!</p>
				<?php
				break;
		}
		?>
		<br>
		<form action="<?php echo site_url('admin/authentify') ?>" method="post">
			<div>
				<div class="form-group col-12 col-sm-6">
					<br><label for="Feld1">Email</label><br><input size="100" type="email" class="form-control"
																   name="<?php echo User_model::S_TABLE_FIELD_EMAIL ?>"
																   id="Feld1" placeholder="Ihre E-Mail">
				</div>
			</div>
			<br>
			<div>
				<div class="form-group col-12  col-sm-6">
					<br><label>Passwort<br><input size="100" id="Feld2" type="password" class="form-control"
															  name="<?php echo User_model::S_TABLE_FIELD_PASSWORD ?>"
															  placeholder="Ihr Passwort"></label>
				</div>
			</div>
			<br>
			<div class="mt-4 text-center">
				<button name="login" type="submit" class="btn btn-mat btn-info ">Anmelden</button>
				<button name="back" class="btn btn-mat btn-success"><a
						href="<?php echo site_url('blog/home') ?>">Zurück</a></button>
				<br>
			</div>
		</form>
	</div>
</section>
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
