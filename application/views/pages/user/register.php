<?php
?>
<body>
<div class="mx-5">
	<div class="text-center"><h1> Registrierung</h1></div>
	<form method="post" action="<?php echo('/user/insert') ?>">

		<label class="hidden" id="Aktiv"></label><br>

		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<label>Name<input name="<?php echo User_model::S_TABLE_FIELD_NAME ?>" type="text" class="form-control" required></label>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<label>Vorname<input name="<?php echo User_model::S_TABLE_FIELD_FIRSTNAME ?>" type="text" class="form-control" required></label>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<label>E-Mail<input name="<?php echo User_model::S_TABLE_FIELD_EMAIL ?>" type="email" class="form-control"></label>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<label>Passwort<input name="<?php echo User_model::S_TABLE_FIELD_PASSWORD ?>" type="password" class="form-control"></label>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<label>Passwort wiederholen<input name="<?php echo User_model::S_TABLE_FIELD_PASSWORD_RETYPE ?>" type="password" class="form-control"></label>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
		<div class="row justify-content-md-center ">
			<div class="col col-sx-4 col-lg-4">

			</div>
			<div class="col-md-auto">
				<button name="send" type="submit" class="btn btn-mat btn-info">Registrieren</button>
			</div>
			<div class="col col-lg-4">

			</div>
		</div>
	</form>
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
