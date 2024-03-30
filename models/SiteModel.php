<?php

class SiteModel extends DBConnection{
	public $query;
	public $table_name;

	public function __construct()
	{
		parent::__construct();
		$this->query = "";
	}

	public function insert($data)
	{
		// INSERT INTO table_name (column1, column2, column3,...)
		// VALUES (value1, value2, value3,...)

		$this->query .= "INSERT INTO {$this->table_name} (";
		$this->query .= implode(", ", array_keys($data));
		$this->query .= ") VALUES ('";
		$this->query .= implode("', '", array_values($data));
		$this->query .= "');";

		try {
			$this->conn->exec($this->query);
			$sql = $this->query;
			$this->query = "";

			echo "New record created successfully";

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public function select($data = [])
	{
		// SELECT column_name(s) FROM table_name
		$this->query .= "SELECT ";
		$this->query .= implode("', '", array_values($data)) . " ";
		$this->query .= "FROM {$this->table_name} ";

		return $this;
	}

	public function get()
	{
		try {
			$sth = $this->conn->prepare($this->query);
			$sth->execute();

			$result = $sth->fetch(\PDO::FETCH_ASSOC);
			$sql = $this->query;
			$this->query = "";
			return $result;

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public function get_array()
	{
		try {
			$sth = $this->conn->prepare($this->query);
			$sth->execute();

			$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
			$sql = $this->query;
			$this->query = "";
			return $result;

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public function where($data)
	{
		$this->query .= "WHERE ";
		foreach ($data as $field => $value) {
			$this->query .= "{$field} = {$value} ";
		}

		return $this;
	}

	public function delete()
	{
		$this->query = "DELETE FROM {$this->table_name} " . $this->query;

		try {
			$this->conn->exec($this->query);
			$sql = $this->query;
			$this->query = "";

			echo "Record Delete successfully";

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public function update($data)
	{
		$updateQuery = "";

		$updateQuery .= "UPDATE {$this->table_name} SET ";
		foreach ($data as $field => $value) {
			$updateQuery .= "{$field} = '{$value}'";

			if(array_keys($data)[count($data)-1] != $field)
			{
				$updateQuery .= ", ";
			}
			else
			{
				$updateQuery .= " ";
			}

		}

		$this->query = $updateQuery . $this->query;
		try {
			$this->conn->exec($this->query);
			$sql = $this->query;
			$this->query = "";

			echo "Record Updated successfully";

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
}

