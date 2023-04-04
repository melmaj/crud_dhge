<?php


class User extends MY_Controller
{

	/**
	 * @author RHS
	 */
	public function login()
	{
		$this->load->view('pages/user/login', $this->getViewData());
	}

	/**
	 * @author RHS
	 */
	public function register()
	{
		$this->load->view('pages/user/register', $this->getViewData());
	}

	/**
	 *
	 */
	public function insert()
	{
		if($this->input->post(User_model::S_TABLE_FIELD_PASSWORD, true) !== $this->input->post(User_model::S_TABLE_FIELD_PASSWORD_RETYPE))
		{redirect('user/register?error_code=3');}

		try {
		$this->session->set_userdata('i_user_id', $this->user_model->insert_user_into_db(
			array(
				User_model::S_TABLE_FIELD_NAME => $this->input->post(User_model::S_TABLE_FIELD_NAME),
				User_model::S_TABLE_FIELD_FIRSTNAME => $this->input->post(User_model::S_TABLE_FIELD_FIRSTNAME),
				User_model::S_TABLE_FIELD_EMAIL => $this->input->post(User_model::S_TABLE_FIELD_EMAIL),
				User_model::S_TABLE_FIELD_PASSWORD => password_hash($this->input->post(User_model::S_TABLE_FIELD_PASSWORD), PASSWORD_DEFAULT),
			)
		));
			redirect('blog/home');
		}
		catch (BadFunctionCallException $o_bad_exception){}
		catch(Exception $o_exc){

			redirect('user/register?error_code=4');
		}
		redirect('blog/home');

	}

	/**
	 *
	 */
	public function authentify()
	{
		$s_email = $this->input->post(User_model::S_TABLE_FIELD_EMAIL, true);
		$s_password = $this->input->post(User_model::S_TABLE_FIELD_PASSWORD, true);

		$a_user = $this->user_model->get_user_by_mail($s_email);

		if (password_verify($s_password, $a_user[User_model::S_TABLE_FIELD_PASSWORD])) {
			$this->session->set_userdata('i_user_id', $a_user[User_model::S_TABLE_FIELD_ID]);
			redirect('blog/home');
		} else {
			redirect('user/login?error_code=1');
		}
	}

	/**
	 *
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('blog/home');
	}
}
