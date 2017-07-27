<?php

	
	class QueryBuilder
	{
		protected $pdo ;	
		function __construct(PDO $pdo)
		{
			# code...
			$this->pdo = $pdo;
		}

		/**
		 * select all rows from the table
		 * @param  string $table_name
		 * @return array    
		 */
		public function selectAll($table)
		{
			$statement = $this->pdo->prepare("SELECT * FROM {$table}");
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_CLASS);
		}

		/**
		 * @param  string $keyword [description]
		 * @param  string $table   [description]
		 * @return array          [description]
		 */
		public function search($keyword, $table)
		{

		}

		/**
		 * Find one row using an id|pk
		 * @param  string $id
		 * @param string $table_name
		 * @return array 
		 */
		public function findOne($id, $table)
		{
			$statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE id={$id} LIMIT 1");
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_OBJ);	
		}

		/**
		 * Insert new data into the table
		 * @param  string $table  table name
		 * @param  array  $params [description]
		 * @return [type]         [description]
		 */
		public function insert(string $table, array $params = [])
		{
			$sql = sprintf(
				"INSERT INTO %s (%s) VALUES(%s)",
				$table,
				implode(',', array_keys($params)),
				':'.implode(', :', array_keys($params))
				);

			try {

				$statement = $this->pdo->prepare($sql);
				$statement->execute($params);

			} catch (PDOException $e) {
				die("Whoops!! Something Went Wrong!!!");
			}

		}
	}