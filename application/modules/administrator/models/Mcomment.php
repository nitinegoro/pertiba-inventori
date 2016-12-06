<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcomment extends Administrator_Model 
{
	private $order = 'desc';

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_posts', 'tb_comments.comment_post_ID = tb_posts.ID', 'left');

		if($this->input->get('filter') != '')
			$this->db->where('tb_comments.comment_approved', $this->input->get('filter'));

		$this->order = $this->input->get('order');

		switch ($this->input->get('order_by')) 
		{
			case 'response_to':
				$this->db->order_by('tb_comments.comment_post_ID', $this->order);
				break;
			case 'submitted':
				$this->db->order_by('tb_comments.comment_date', $this->order);
				break;
			case 'comment_author':
				$this->db->order_by('tb_comments.comment_author', $this->order);
				break;
			default:
				$this->db->order_by('tb_comments.comment_ID', $this->order);
				break;
		}

		if($this->input->get('q') != '')
			$this->db->like('tb_comments.comment_author', $this->input->get('q'))
					->or_like('tb_posts.post_title', $this->input->get('q')); 

		if($type == 'result')
		{
			$result = $this->db->get('tb_comments', $limit, $offset)->result();
		} else {
			$result = $this->db->get('tb_comments')->num_rows();
		}

		return $result; 
	}	

	public function get($param = 0)
	{
		# code...
	}

	/**
	 * Adding post and Comment
	 *
	 * @param Integer (comment_ID) tb_comments
	 * @param Integer (ID) tb_post
	 **/
	public function insert($comment = 0, $post)
	{
		# code...
	}

	public function update($param = 0)
	{
		# code...
	}

	/**
	 * Double delete parent and child
	 *
	 * @param Integer (comment_ID and comment_parent)
	 **/
	public function delete($param = 0)
	{
		# code...
	}

	/**
	 * Count Comments rows by approve
	 *
	 * @param String (comment_approved)
	 * @return Integer
	 **/
	public function count_comment($filter = '')
	{
		if($filter != '')
			$this->db->where('comment_approved', $filter);

		return $this->db->get('tb_comments')->num_rows();
	}
}

/* End of file Mcomment.php */
/* Location: ./application/modules/administrator/models/Mcomment.php */