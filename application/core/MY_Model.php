<?php
/**
 * Class User_Model
 *
 * @property CI_DB_mysqli_driver $db
 */

class MY_Model extends CI_Model
{
	const S_TABLE_FIELD_ID = 'id';
	const I_NUM_ROWS_LISTING = 10;

    /**
     * @param $i_id
     * @param $s_table
     * @return array|null
     */
	public function get_row_array_by_id($i_id, $s_table)
	{
		$this->db->select();
		$this->db->from($s_table);
		$this->db->where(self::S_TABLE_FIELD_ID, $i_id);

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->row_array();
	}

	/**
	 * @param $i_id
	 * @param $s_table
	 * @return array|array[]
	 */
	public function get_result_array_by_id($i_id, $s_table): array
    {
		$this->db->select();
		$this->db->from($s_table);
		$this->db->where(self::S_TABLE_FIELD_ID, $i_id);

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

}
