<?php

/**
 * Class User_Model
 *
 * @property CI_DB_mysqli_driver $db
 */
class User_model extends MY_Model
{
	const S_TABLE_FIELD_ID = 'id';
	const S_TABLE_FIELD_FIRSTNAME = 'Firstname';
	const S_TABLE_FIELD_NAME = 'Name';
	const S_TABLE_FIELD_EMAIL = 'email';
	const S_TABLE_FIELD_PASSWORD = 'password';
	const S_TABLE_FIELD_PASSWORD_RETYPE = 'password_retype';
	const S_TABLE_FIELD_ADMIN = 'admin';

	const S_TABLE_NAME = 'User';

	/**
	 * @param array $a_user
	 * @return int
	 */
	public function insert_user_into_db(array $a_user)
	{
		$this->db->insert(self::S_TABLE_NAME, $a_user);
		return $this->db->insert_id();
	}

	/**
	 * @param $s_email
	 * @return array|null
	 */
	function get_user_by_mail($s_email)
	{
		$this->db->select();
		$this->db->from(self::S_TABLE_NAME);
		$this->db->where(self::S_TABLE_FIELD_EMAIL, $s_email);

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->row_array();
	}

	/**
	 * @param $i_offset
	 * @return array|array[]
	 */
	function get_all_users($i_offset)
	{
		$this->db->select(
			array('id',
				'Name',
				'Firstname',
				'email',
				'admin',
			)
		);
		$this->db->from(self::S_TABLE_NAME);
		$this->db->limit(MY_Model::I_NUM_ROWS_LISTING);
		$this->db->offset($i_offset);
		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

	/**
	 * @return int
	 */
	function get_user_count()
	{
		$this->db->select(array(self::S_TABLE_FIELD_ID));
		$this->db->from(self::S_TABLE_NAME);
		return $this->db->get()->num_rows();
	}

	/**
	 * @param $i_id
	 */
	function delete_user($i_id){

		$this->db->delete(self::S_TABLE_NAME, array('id' => $i_id));

	}

	/**
	 * @param $i_user_id
	 * @param array $a_user_data
	 */
	public function update_user($i_user_id, array $a_user_data)
	{
		$this->db->where(self::S_TABLE_FIELD_ID, $i_user_id);
		$this->db->update(self::S_TABLE_NAME, $a_user_data);
	}

}
