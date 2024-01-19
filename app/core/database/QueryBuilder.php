<?php

/**
 * Class QueryBuilder
 *
 * Represents a query builder for interacting with a db using PDO (PHP Data Objects).
 */
class QueryBuilder
{
    // @var PDO The PDO database connection instance.
    protected $pdo;

    /**
     * QueryBuilder constructor.
     *
     * @param PDO $pdo The PDO database connection instance.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all rows from the specified table.
     *
     * @param  string $table The name of the table.
     * @return  array An array containing all rows from the table.
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Search for rows in the specified table based on a keyword.
     *
     * @param  string $keyword The search keyword.
     * @param  string $table The name of the table.
     * @return array An array containing the search results.
     */
    public function search($keyword, $table)
    {
        // Implementation for the search method goes here
    }

    /**
     * Find one row in the specified table using an ID.
     *
     * @param string $id The ID of the row to retrieve.
     * @param string $table The name of the table.
     * @return array An array containing the retrieved row.
     */
    public function findOne($id, $table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE id={$id} LIMIT 1");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Insert new data into the specified table.
     *
     * @param string $table The name of the table.
     * @param array $params An associative array of column-value pairs to insert.
     * @return void
     */
    public function insert(string $table, array $params = [])
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES(%s)",
            $table,
            implode(',', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } catch (PDOException $e) {
            die("Whoops!! Something Went Wrong!!!");
        }
    }
}
