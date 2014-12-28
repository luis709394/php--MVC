<?php

include_once ("model/Book.php");

class Model {

	//   save the connection variables here
	private static $dbhost='localhost:3306';
	private static $dbuser='root';
	private static $dbpass='lu614000';
	private static $dbname='php_practice';
	private $db;

	public function __construct() {

		try{
		$this->db = new PDO("mysql:host=" . self::$dbhost.";dbname=".self::$dbname, self::$dbuser, self::$dbpass);
		$this->db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(PDOException $ex) {
			echo 'An error occured';
			echo $ex -> getMessage();
		};
	}

	public function getBookList($keyword) {
      if(!$keyword)
	  {
	  	try {

			$stmt = $this->db -> query('SELECT * FROM books');

			# Map results to object
			$result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'Book');

		} catch (PDOException $ex) {
			echo 'An error occured';
			echo $ex -> getMessage();
		}
	  }
	  else {
         // process the incoming parameter $keyword for SQL query
		$search = "%" . $keyword . "%";

		try {

			$sql = "SELECT * FROM books WHERE Title LIKE :search";
			$stmt = $this->db -> prepare($sql);
			$stmt -> bindValue(':search', $search, PDO::PARAM_STR);
			$stmt -> execute();
			# Map results to object
			$result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'Book');

		} catch (PDOException $ex) {
			echo 'An error occured';
			echo $ex -> getMessage();
		}
	  }

		return $result;
	}

	public function getBook($ISBN) {

		try {


			$sql = "SELECT * FROM books WHERE ISBN= :ISBN";

			$stmt = $this->db -> prepare($sql);
			$stmt -> execute(array(':ISBN' => $ISBN));

			# Map results to object
			$result = $stmt -> fetchAll(PDO::FETCH_CLASS, 'Book');

		} catch (PDOException $ex) {
			echo 'An error occured';
			echo $ex -> getMessage();
		}

		return $result[0];
	}


}
