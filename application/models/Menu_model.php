<?php
/**
 * Created by IntelliJ IDEA.
 * User: gluck
 * Date: 16.12.2020
 * Time: 17:33
 */

class Menu_model extends CI_Model
{

	public function __construct (){
		parent::__construct ();
		$this->load->database();
	}


	// возвращает все типы кухонь если $cookingId не передан
	// если передать, то возвращает кухню с соотв ID
	public function getCooking($cookingId = null) {
		$where = '';
		if (!is_null($cookingId)) {
			 $where = ' WHERE id = '.$cookingId;
 		}

		$sql = 'SELECT * FROM cooking '.$where;
		//die ($sql);
		return $this->db->query($sql)->result_array();

	}


	// возвращает все теги если $cookingId не передан
	// если передан, то вернет теги, относящиеся к $cookingId
	public function getTags($cookingId = null) {
		$where = '';
		if (!is_null($cookingId)) {
			$where = ' WHERE cookingId = '.$cookingId;
		}

		$sql = 'SELECT * FROM tags '.$where;
		//die ($sql);
		return $this->db->query($sql)->result_array();


		$query = $this->db->get_where('tags', array());
		return $query->row_array();
	}


	// добавляет новый тип кухни
	public function addType($fields) {
		$data = array(
			'name' => $fields['type']
		);
		$this->db->insert('cooking', $data);


		if ($insertId = $this->db->insert_id() AND isset($fields['tags'])) {
			self::addTags($insertId, $fields['tags']);
		}
	}

	// редактирует переданный name кухни по ее ID
	public function editType($fields) {
		$data = array(
			'id' => $fields['id'],
			'name'  => $fields['type'],
		);
		$this->db->replace('cooking', $data);
		if ($insertId = $this->db->insert_id() AND isset($fields['tags'])) {
			self::addTags($insertId, $_POST['tags']);
		}
	}

	// удаляет переданный ID кухни и соотв тэги по cascade
	public function removeType($id = 0) {
		$this->db->where('id', $id);
		$this->db->delete('cooking');
	}

	// дбавляет тэги на переданный ID кухни
	public function addTags($typeId, array $tags) {
		$data = [];
		foreach ($tags as $key => $value) {
			if ($value != '') {
				$data[] = array(
					'cookingId' => $typeId,
					'tag' => $value
				);
			}
		}

		if (sizeof($data) > 0)
			return $this->db->insert_batch('tags', $data);
		else return false;
	}


}
