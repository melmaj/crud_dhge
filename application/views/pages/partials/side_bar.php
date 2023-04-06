<?php
/**
 * @var int $i_num_blog_entries
 * @var array $a_blog_entries
 * @var array $a_blog_entries_top_10
 */
 ?>
<div class="nav-scroller py-1 mb-2">
	<nav class="nav d-flex justify-content-between">

		<?php
		foreach ($a_blog_entries_top_10 as $a_blog_entry) {
			?><a class="p-2 link-secondary" href="<?php echo site_url('/blog/page/'. $a_blog_entry[Blog_model::S_TABLE_FIELD_ID_BLOCK]) ?>">
			<?php echo $a_blog_entry[Blog_model::S_TABLE_FIELD_TITLE_BLOCK] ?></a>
		<?php }
		if ($i_num_blog_entries > 10) { ?>
				<a class="nav-link dropdown-toggle p-2" href="#"
				   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mehr
				</a>
		<?php } ?>
	</nav>
</div>
