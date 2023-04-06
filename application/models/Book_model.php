<?php

/**
 * Class Book_Model
 *
 * @property CI_DB_mysqli_driver $db
 */
class Book_model extends MY_Model
{
	const TABLE_BOOK_ENTRY = 'book_entry';
	const TABLE_COMMENT = 'comment';

	const S_TABLE_FIELD_CONTENT_BOOK = 'content';
	const S_TABLE_FIELD_TITLE_BOOK = 'title';
	const S_TABLE_FIELD_AUTHOR_BOOK = 'created_by';
	const S_TABLE_FIELD_DATE_BOOK = 'creation_date';
	const S_TABLE_FIELD_ID_BOOK = 'id';

	const S_TABLE_FIELD_CONTENT_COMMENT = 'content';
	const S_TABLE_FIELD_TITLE_COMMENT = 'title';
	const S_TABLE_FIELD_AUTHOR_COMMENT = 'created_by';
	const S_TABLE_FIELD_DATE_COMMENT = 'creation_date';
	const S_TABLE_FIELD_ID_COMMENT = 'id';

	/**
	 * @param $i_id
	 * @return array|null
	 */
	function get_book_by_id($i_id)
	{
		$this->db->select(
			array(
				'book_entry.id',
				'book_entry.title',
				'book_entry.content',
				'book_entry.creation_date',
				'book_entry.created_by',
				'User.id',
				'User.Name',
				'User.Firstname',
			)
		);
		$this->db->from('book_entry');
		$this->db->where('book_entry.id', $i_id);
		$this->db->join('User', 'User.id = book_entry.created_by');

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->row_array();
	}

	/**
	 * @param array $a_comment
	 */
	public function insert_comment_into_db(array $a_comment)
	{
		$this->db->insert('comment', $a_comment);
	}

	/**
	 * @param $i_page_id
	 * @return array|array[]
	 */
	function get_all_comments_by_id($i_page_id): array
    {
		$this->db->select(
			array(
				'title',
				'content',
				'creation_date',
				'User.Name',
				'User.Firstname'
			)
		);
		$this->db->from('comment');
		$this->db->where('page_id', $i_page_id);
		$this->db->join('User', 'User.id = comment.created_by');

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

    /**
     * @return array|array[]
     *
     */
	function get_entries_for_home_page(): array
    {
		$this->db->select();
		$this->db->from(self::TABLE_BOOK_ENTRY);
		$this->db->limit(3);
		$this->db->order_by(self::S_TABLE_FIELD_DATE_BOOK, 'DESC');
		return $this->db->get()->result_array();
	}

	/**
	 * @return array|array[]
	 */
	function get_top_10_for_home_page(): array
    {
			$this->db->select(array(self::S_TABLE_FIELD_TITLE_BOOK, self::S_TABLE_FIELD_ID_BOOK));
			$this->db->from(self::TABLE_BOOK_ENTRY);
			$this->db->limit(10);
			$this->db->order_by(self::S_TABLE_FIELD_DATE_BOOK, 'DESC');
			return $this->db->get()->result_array();
	}

	/**
	 * @return int
	 */
	function get_book_entry_count(): int
    {
			$this->db->select(array(self::S_TABLE_FIELD_ID_BOOK));
			$this->db->from(self::TABLE_BOOK_ENTRY);
			return $this->db->get()->num_rows();
	}

	/**
	 * @return int
	 */
	function get_comment_count(): int
    {
		$this->db->select(array(self::S_TABLE_FIELD_ID_COMMENT));
		$this->db->from(self::TABLE_COMMENT);
		return $this->db->get()->num_rows();
	}

	/**
	 * @param $i_offset
	 * @return array|array[]
	 */
	function get_all_books_with_author($i_offset): array
    {
		$this->db->select(
			array('book_entry.id',
				'title',
				'content',
				'creation_date',
				'User.Name',
				'User.Firstname'
			)
		);
		$this->db->from(self::TABLE_BOOK_ENTRY);
		$this->db->limit(MY_Model::I_NUM_ROWS_LISTING);
		$this->db->offset($i_offset);
		$this->db->join('User', 'User.id = book_entry.created_by');

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

	/**
	 * @param array $a_book
	 */
	public function insert_book_into_db(array $a_book)
	{
		$this->db->insert(self::TABLE_BOOK_ENTRY, $a_book);
	}

	/**
	 * @param $i_offset
	 * @return array|array[]
	 */
	function get_all_comment($i_offset): array
    {
		$this->db->select(
			array('comment.id',
				'title',
				'content',
				'creation_date',
				'User.Name',
				'User.Firstname'
			)
		);
		$this->db->from('comment');
		$this->db->limit(MY_Model::I_NUM_ROWS_LISTING);
		$this->db->offset($i_offset);
		$this->db->join('User', 'User.id = comment.created_by');

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

	/**
	 * @param $i_id
	 */
	function delete_book($i_id){

		$this->db->delete('book_entry', array('id' => $i_id));

	}

	/**
	 * @param $i_book_id
	 * @param array $a_book_data
	 */
	public function update_book($i_book_id, array $a_book_data)
	{
		$this->db->where(self::S_TABLE_FIELD_ID_BOOK, $i_book_id);
		$this->db->update(self::TABLE_BOOK_ENTRY, $a_book_data);
	}

	/**
	 * @param $i_id
	 */
	function delete_comment($i_id){

		$this->db->delete(self::TABLE_COMMENT, array('id' => $i_id));

	}

	/**
	 * @param $i_comment_id
	 * @param array $a_comment_data
	 */
	public function update_comment($i_comment_id, array $a_comment_data)
	{
		$this->db->where(self::S_TABLE_FIELD_ID_COMMENT, $i_comment_id);
		$this->db->update(self::TABLE_COMMENT, $a_comment_data);
	}
}
