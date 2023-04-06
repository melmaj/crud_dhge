<?php
/**
 * @var array $a_current_user
 * @var array $sesdat
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="arenonymous">
    <style>
        .buttonbox {
            float: left;
            width: 20%;
        }
        </style>
	<title>Blog</title>
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button> <a class="navbar-brand">Profil
		<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_FIRSTNAME]) && isset($a_current_user[User_model::S_TABLE_FIELD_NAME]))
		{ ?>
			<?php echo $a_current_user[User_model::S_TABLE_FIELD_FIRSTNAME]. ' ' . $a_current_user[User_model::S_TABLE_FIELD_NAME] ?>
		<?php }
		?>
	</a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="dropdown-item"
				   href="<?php echo site_url('/blog/home') ?>">Home</a>
				<?php if (!isset($a_current_user[User_model::S_TABLE_FIELD_FIRSTNAME]) && !isset($a_current_user[User_model::S_TABLE_FIELD_NAME]))
				{ ?><a class="dropdown-item"
				   href="<?php echo site_url('/user/login') ?>">Anmelden</a><?php }
				?>
				<?php if (!isset($a_current_user[User_model::S_TABLE_FIELD_FIRSTNAME]) && !isset($a_current_user[User_model::S_TABLE_FIELD_NAME]))
				{ ?><a class="dropdown-item"
				   href="<?php echo site_url('/admin/login') ?>">Adminbereich</a><?php }
				?>
				<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_ADMIN])==1)
				{ ?><a class="dropdown-item"
					   href="<?php echo site_url('/admin/dashboard_blog') ?>">Admin-Dashboard</a><?php }
				?>
				<?php if (isset($a_current_user[User_model::S_TABLE_FIELD_FIRSTNAME]) && isset($a_current_user[User_model::S_TABLE_FIELD_NAME]))
				{ ?>
					<a class="dropdown-item"
					   href="<?php echo site_url('/user/logout') ?>">Logout</a>
				<?php }
				?>
			</li>
		</ul>
	</div>
</nav>
