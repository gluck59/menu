<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	/**
	 * @property menuModel
	 */

	public function __construct()
	{
		parent::__construct();
		$this->menuModel = new Menu_model();
	}


	public function index()
	{
		if ($_POST) {
			$action = $_POST['action'];

			switch ($action) {
				case 'addType':
					if ($_POST['type'] != '') self::_addType($_POST);
					break;

				case 'removeType':
					self::_removeType($_POST['id']);
				break;

				case 'editType':
					self::_editType($_POST); // а можно было всегда весь POST целиком передавать
				break;

				// работа с тегами реализована на уровне БД, отдельных методов не требуется

				default:
					break;
			}
		}

		$cookingType = $this->menuModel->getCooking();
		$tags = $this->menuModel->getTags();

		$data['cookingType'] = $cookingType;
		$data['tags'] = $tags;
		$this->load->view('menu', $data);
	}

	// добавляет новый тип кухни
	private function _addType($fields) {
		$this->menuModel->addType($fields);
	}

	// удаляет переданный ID кухни и соотв тэги по cascade
	private function _removeType($id) {
		$this->menuModel->removeType($id);
	}

	// редактирует переданный name кухни по ее ID
	private function _editType($post) {
		$res = $this->menuModel->editType($post);
	}
}
