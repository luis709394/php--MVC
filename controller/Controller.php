<?php

include_once ("model/Model.php");

class Controller {
	public $model;

	public function __construct() {
		$this -> model = new Model();
	}

	/*
	 * test_input trims space before and after the input string to eliminate space input
	 * @para  $data is the text input for keyword
	 */
	public static function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function invoke() {
		// first see if a book has been requested
		if (!isset($_GET['book'])) {

			 // if not, check if a keyword has been submitted to filter the booklist
			 if(!isset($_POST['keyword'])|| $this::test_input($_POST['keyword'])=="")
			 {
			 // if no keyword submitted, get the full booklist
			 $books = $this->model->getBookList(null);
			 include 'view/booklist.php';
			 }
			 else {
			 // if a key word is submitted, filter the booklist
			 $books = $this->model->getBookList($this::test_input($_POST['keyword']));
			 include 'view/booklist.php';
			 }

		} else {
			// show the requested book
			$book = $this -> model -> getBook($_GET['book']);
			include 'view/viewbook.php';
		}
	}

}
