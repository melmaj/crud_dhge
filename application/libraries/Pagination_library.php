<?php

/**
 * Class Pagination_library
 * @property MY_Controller $CI
 */
class Pagination_library
{

	public $CI;

	public $a_config = [
			'base_url' => 0,
			'total_rows' => 0,
			'per_page' => 0,
			'first_tag_open' => '<li class="page-item">',
			'first_tag_close' => '</li>',
		];

	/**
	 * Pagination_library constructor.
	 */
	public function __construct()
	{
		$this->CI = &get_instance();
	}

/**
	 * @param $s_site_url
	 * @param $i_num_total
	 * @param int $i_now_rows_listing
	 * @return string
	 */
	public function generate($s_site_url, $i_num_total, $i_now_rows_listing = 10): string
	{
			$this->a_config['base_url'] = $s_site_url;
			$this->a_config['total_rows'] = $i_num_total;
			$this->a_config['per_page'] = $i_now_rows_listing;
			$this->CI->pagination->initialize($this->a_config);

		return $this->CI->pagination->create_links();
	}

}
