<?php

/**
 * Class Blog_Model
 *
 * @property CI_DB_mysqli_driver $db
 */
class Blog_Model extends MY_Model
{
	const TABLE_BLOG_ENTRY = 'blog_entry';
	const TABLE_COMMENT = 'comment';

	const S_TABLE_FIELD_CONTENT_BLOCK = 'content';
	const S_TABLE_FIELD_TITLE_BLOCK = 'title';
	const S_TABLE_FIELD_AUTHOR_BLOCK = 'created_by';
	const S_TABLE_FIELD_DATE_BLOCK = 'creation_date';
	const S_TABLE_FIELD_ID_BLOCK = 'id';

	const S_TABLE_FIELD_CONTENT_COMMENT = 'content';
	const S_TABLE_FIELD_TITLE_COMMENT = 'title';
	const S_TABLE_FIELD_AUTHOR_COMMENT = 'created_by';
	const S_TABLE_FIELD_DATE_COMMENT = 'creation_date';
	const S_TABLE_FIELD_ID_COMMENT = 'id';

	/**
	 * @param $i_id
	 * @return array|null
	 */
	function get_blog_by_id($i_id)
	{
		$this->db->select(
			array(
				'blog_entry.id',
				'blog_entry.title',
				'blog_entry.content',
				'blog_entry.creation_date',
				'blog_entry.created_by',
				'User.id',
				'User.Name',
				'User.Firstname',
			)
		);
		$this->db->from('blog_entry');
		$this->db->where('blog_entry.id', $i_id);
		$this->db->join('User', 'User.id = blog_entry.created_by');

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
	function get_all_comments_by_id($i_page_id)
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
	 */
	function get_entries_for_home_page()
	{
		$this->db->select();
		$this->db->from(self::TABLE_BLOG_ENTRY);
		$this->db->limit(3);
		$this->db->order_by(self::S_TABLE_FIELD_DATE_BLOCK, 'DESC');
		return $this->db->get()->result_array();
	}

	/**
	 * @return array|array[]
	 */
	function get_top_10_for_home_page()
	{
			$this->db->select(array(self::S_TABLE_FIELD_TITLE_BLOCK, self::S_TABLE_FIELD_ID_BLOCK));
			$this->db->from(self::TABLE_BLOG_ENTRY);
			$this->db->limit(10);
			$this->db->order_by(self::S_TABLE_FIELD_DATE_BLOCK, 'DESC');
			return $this->db->get()->result_array();
	}

	/**
	 * @return int
	 */
	function get_blog_entry_count()
	{
			$this->db->select(array(self::S_TABLE_FIELD_ID_BLOCK));
			$this->db->from(self::TABLE_BLOG_ENTRY);
			return $this->db->get()->num_rows();
	}

	/**
	 * @return int
	 */
	function get_comment_count()
	{
		$this->db->select(array(self::S_TABLE_FIELD_ID_COMMENT));
		$this->db->from(self::TABLE_COMMENT);
		return $this->db->get()->num_rows();
	}

	/**
	 * @param $i_offset
	 * @return array|array[]
	 */
	function get_all_blogs_with_author($i_offset)
	{
		$this->db->select(
			array('blog_entry.id',
				'title',
				'content',
				'creation_date',
				'User.Name',
				'User.Firstname'
			)
		);
		$this->db->from(self::TABLE_BLOG_ENTRY);
		$this->db->limit(MY_Model::I_NUM_ROWS_LISTING);
		$this->db->offset($i_offset);
		$this->db->join('User', 'User.id = blog_entry.created_by');

		/**
		 * @var CI_DB_mysqli_result $o_result
		 */
		$o_result = $this->db->get();

		return $o_result->result_array();
	}

	/**
	 * @param array $a_blog
	 */
	public function insert_blog_into_db(array $a_blog)
	{
		$this->db->insert(self::TABLE_BLOG_ENTRY, $a_blog);
	}

	/**
	 * @param $i_offset
	 * @return array|array[]
	 */
	function get_all_comment($i_offset)
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
	function delete_blog($i_id){

		$this->db->delete('blog_entry', array('id' => $i_id));

	}

	/**
	 * @param $i_blog_id
	 * @param array $a_blog_data
	 */
	public function update_blog($i_blog_id, array $a_blog_data)
	{
		$this->db->where(self::S_TABLE_FIELD_ID_BLOCK, $i_blog_id);
		$this->db->update(self::TABLE_BLOG_ENTRY, $a_blog_data);
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
