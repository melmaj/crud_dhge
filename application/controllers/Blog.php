<?php

class Blog extends MY_Controller
{
	/**
	 * Blog constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setViewData('a_blog_entries_top_10', $this->blog_model->get_top_10_for_home_page());
		$this->setViewData('i_num_blog_entries', $this->blog_model->get_blog_entry_count());
	}
	/**
	 * @author RHS
	 */
	public function home()
	{
		$this->setViewData('a_blog_entries', $this->blog_model->get_entries_for_home_page());
		$this->load->view('pages/homepage', $this->getViewData());
	}

	/**
	 * @param int $i_id
	 */
	public function page($i_id)
	{
		$a_blog_entry = $this->blog_model->get_blog_by_id($i_id);
        $this->setViewData('a_current_user', $this->user_model->get_row_array_by_id($this->session->userdata('i_user_id'), User_model::S_TABLE_NAME));
        $this->setViewData('a_current_blog', $a_blog_entry);
		$this->setViewData('a_all_comments', $this->blog_model->get_all_comments_by_id($a_blog_entry['id']));
		$this->load->view('pages/blogs', $this->getViewData());
	}

	/**
	 * @author RHS
	 */
	public function add_comment()
	{
		$o_now = new DateTime();
		$o_now->setTimezone(new DateTimeZone('Europe/Berlin'));

		$a_view_data = $this->getViewData();

		if (!isset($a_view_data['a_current_user']['id'])) {
			redirect('blog/page/' . $this->input->post('blog_entry_id') . '?error_code=b1');
		}

		$this->load->library('user_agent');
		$a_referrer_info = array_reverse(explode('/', $this->agent->referrer()));

		if ($this->input->post('blog_entry_id') != current($a_referrer_info)) {
			redirect('blog/page/' . $this->input->post('blog_entry_id') . '?error_code=b2');
		}

		$this->blog_model->insert_comment_into_db(
			array(
				Blog_model::S_TABLE_FIELD_TITLE_COMMENT => trim($this->input->post(Blog_model::S_TABLE_FIELD_TITLE_COMMENT, true)),
				Blog_model::S_TABLE_FIELD_CONTENT_COMMENT => trim($this->input->post(Blog_model::S_TABLE_FIELD_CONTENT_COMMENT, true)),
				Blog_model::S_TABLE_FIELD_AUTHOR_COMMENT => $a_view_data['a_current_user']['id'],
				Blog_model::S_TABLE_FIELD_DATE_COMMENT => $o_now->format('Y-m-d H:i:s'),
				'page_id' => $this->input->post('blog_entry_id'),
			)
		);
		redirect('blog/page/' . $this->input->post('blog_entry_id'));
	}


}
