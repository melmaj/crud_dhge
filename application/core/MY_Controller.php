<?php
/**
 * Class MY_Controller
 *
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property User_model $user_model
 * @property Blog_model $blog_model
 * @property CI_URI $uri
 * @property CI_Session $session
 * @property CI_User_agent $agent
 * @property CI_Pagination $pagination
 * @property CI_Router $router
 * @property Pagination_library $pagination_library
 */

class MY_Controller extends CI_Controller
{
	/**
	 * @var array
	 */
	protected $a_view_data = array();

	/**
	 * @return array
	 */
	public function getViewData(): array
	{
		return $this->a_view_data;
	}

	/**
	 * @param $_key
	 * @param $m_value
	 */
	public function setViewData($_key, $m_value)
	{
		$this->a_view_data[$_key] = $m_value;
	}

	/**
	 * User constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->setViewData('error_code', $this->input->get('error_code'));
		if ($this->session->userdata('i_user_id')) {
			$this->setViewData('a_current_user', $this->user_model->get_row_array_by_id($this->session->userdata('i_user_id'), User_model::S_TABLE_NAME));
		}
		$this->load->view('templates/header', $this->getViewData());
	}

	/**
	 * @return bool
	 */
	public function is_admin(): bool{
		$a_view_data = $this->getViewData();
		return (isset($a_view_data['a_current_user']) && $a_view_data['a_current_user']['admin']);
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
