<?php
/**
 * @var int $i_num_blog_entries
 * @var array $a_blog_entries
 * @var array $a_blog_entries_top_10
 */
?>
<body>

<div class="container">
	<header class=" py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">

			</div>
			<div class="col-4 text-center">
				<h1>Der Buch Blog</h1>
			</div>
			<div class="col-4 d-flex justify-content-end align-items-center">

			</div>
		</div>
	</header>

	<?php $this->load->view('pages/partials/side_bar') ?>
</div>

<main class="container">

	<div class="row">
		<div class="col-md-12">
			<?php
			foreach ($a_blog_entries as $a_blog_entry) { ?>

			<article class="blog-post">
				<h2 class="blog-post-title"><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_TITLE_BLOCK] ?></h2>
				<p class="blog-post-meta"><?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_DATE_BLOCK]?> von <a href="#"><?php echo $a_blog_entry[User_model::S_TABLE_FIELD_FIRSTNAME] . ' ' . $a_blog_entry[User_model::S_TABLE_FIELD_NAME]; ?></a></p>

				<p><?php echo substr($a_blog_entry[Blog_model::S_TABLE_FIELD_CONTENT_BLOCK], 0, 255) ?></p>
				<hr>
				<?php if (strlen($a_blog_entry[Blog_model::S_TABLE_FIELD_CONTENT_BLOCK])) { ?>
					<p><a href="<?php echo site_url('/blog/page/'. $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]) ?>">Weiterlesen...</a></p>
						<?php	} ?>
			</article>
			<?php } ?>
		</div>

</main>










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
