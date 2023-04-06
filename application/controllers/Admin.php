<?php

class Admin extends MY_Controller
{
	/**
	 * Admin constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setViewData('i_num_user', $this->user_model->get_user_count());
		if (!in_array($this->router->method, array('login', 'authentify'))&& !$this->is_admin())
		{redirect('admin/login?error_code=1');}
	}
	/**
	 */
	public function login()
	{
		$this->load->view('pages/admin/login', $this->getViewData());
	}

	/**
	 * @param int $i_offset
	 */
	public function dashboard_blog($i_offset = 0)
	{
		$this->setViewData('a_all_blog_entries', $this->blog_model->get_all_blogs_with_author($i_offset));
		$this->setViewData('s_pagination', $this->pagination_library->generate(site_url('/admin/dashboard_blog'), $this->blog_model->get_blog_entry_count()));
		$this->load->view('pages/admin/dashboard_b', $this->getViewData());
	}

	/**
	 * @param int $i_offset
	 */
	public function dashboard_user($i_offset = 0)
	{

		$this->setViewData('a_all_users', $this->user_model->get_all_users($i_offset));
		$this->setViewData('s_pagination', $this->pagination_library->generate(site_url('/admin/dashboard_user'), $this->user_model->get_user_count()));
		$this->load->view('pages/admin/dashboard_u', $this->getViewData());
	}

	/**
	 * @param int $i_offset
	 */
	public function dashboard_comment($i_offset = 0)
	{

		$this->setViewData('a_all_comments', $this->blog_model->get_all_comment($i_offset));
		$this->setViewData('s_pagination', $this->pagination_library->generate(site_url('/admin/dashboard_comment'), $this->blog_model->get_comment_count()));
		$this->load->view('pages/admin/dashboard_c', $this->getViewData());
	}
	/**
	 *
	 */
	public function authentify()
	{
		$s_email1 = $this->input->post(User_model::S_TABLE_FIELD_EMAIL, true);
		$s_password = $this->input->post(User_model::S_TABLE_FIELD_PASSWORD, true);

		$a_user = $this->user_model->get_user_by_mail($s_email1);

		if (password_verify($s_password, $a_user[User_model::S_TABLE_FIELD_PASSWORD])) {
			if ($a_user[User_model::S_TABLE_FIELD_ADMIN] == 1) {
				$this->session->set_userdata('i_user_id', $a_user[User_model::S_TABLE_FIELD_ID]);
				redirect('admin/dashboard_blog');
			} else {
				redirect('admin/login?error_code=2');
			}
		} else {
			redirect('admin/login?error_code=1');
		}
	}

	/**
	 *
	 */
	public function new_blog_entry(){
		$o_now = new DateTime();
		$o_now->setTimezone(new DateTimeZone('Europe/Berlin'));

		$a_view_data = $this->getViewData();
		$this->blog_model->insert_blog_into_db(
			array(
				Blog_model::S_TABLE_FIELD_TITLE_BLOCK => trim($this->input->post(Blog_model::S_TABLE_FIELD_TITLE_COMMENT, true)),
				Blog_model::S_TABLE_FIELD_CONTENT_BLOCK => trim($this->input->post(Blog_model::S_TABLE_FIELD_CONTENT_COMMENT, true)),
				Blog_model::S_TABLE_FIELD_AUTHOR_BLOCK => $a_view_data['a_current_user']['id'],
				Blog_model::S_TABLE_FIELD_DATE_BLOCK => $o_now->format('Y-m-d H:i:s'),
			)
		);
		redirect('admin/dashboard_blog');
	}

	/**
	 *
	 */
	public function edit_blog(){

		$this->blog_model->update_blog($this->input->post('edit_id', TRUE), array(
			Blog_model::S_TABLE_FIELD_TITLE_BLOCK => trim($this->input->post(Blog_model::S_TABLE_FIELD_TITLE_COMMENT, true)),
			Blog_model::S_TABLE_FIELD_CONTENT_BLOCK => trim($this->input->post(Blog_model::S_TABLE_FIELD_CONTENT_COMMENT, true)),
		));
		redirect('/admin/dashboard_blog');
	}

	/**
	 * @param null $i_id
	 */
	public function delete_blog_entry($i_id = null){
		$i_id = (!is_null($i_id))
			? $i_id
			: $this->input->post('delete_id', true);

		if (is_null($i_id)) {
			redirect('blog/home?error_code=89');
		}

		$this->blog_model->delete_blog($this->input->post('delete_id',TRUE));
		redirect('admin/dashboard_blog');
	}

	/**
	 *
	 */
	public function edit_user(){
		$this->user_model->update_user($this->input->post('edit_id', TRUE), array(
			User_model::S_TABLE_FIELD_FIRSTNAME => trim($this->input->post(User_model::S_TABLE_FIELD_FIRSTNAME, true)),
			User_model::S_TABLE_FIELD_NAME => trim($this->input->post(User_model::S_TABLE_FIELD_NAME, true)),
			User_model::S_TABLE_FIELD_EMAIL => trim($this->input->post(User_model::S_TABLE_FIELD_EMAIL, true)),
			User_model::S_TABLE_FIELD_ADMIN => trim($this->input->post(User_model::S_TABLE_FIELD_ADMIN, true)),
			));
		redirect('/admin/dashboard_user');
	}

	/**
	 *
	 */
	public function delete_user(){
		$this->user_model->delete_user($this->input->post('delete_id',TRUE));
		redirect('admin/dashboard_user');
	}

	/**
	 *
	 */
	public function edit_comment_entry(){
		$this->blog_model->update_comment($this->input->post('edit_id', TRUE), array(
			Blog_model::S_TABLE_FIELD_TITLE_COMMENT => trim($this->input->post(Blog_model::S_TABLE_FIELD_TITLE_COMMENT, true)),
			Blog_model::S_TABLE_FIELD_CONTENT_COMMENT => trim($this->input->post(Blog_model::S_TABLE_FIELD_CONTENT_COMMENT, true)),
		));
		redirect('/admin/dashboard_comment');
	}

	/**
	 *
	 */
	public function delete_comment(){
		$this->blog_model->delete_comment($this->input->post('delete_id',TRUE));
		redirect('admin/dashboard_comment');
	}





	public function logout()
	{
		$this->session->sess_destroy();
		redirect('blog/home');
	}
}
