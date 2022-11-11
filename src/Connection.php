<?php

namespace Volcano\Database;

use Closure;
use PDO;
use PDOException;
use Volcano\Database\Exceptions\QueryException;

class Connection implements ConnectionInterface
{
    private PDO $connection;

    public function __construct(PDO $pdo, array $config)
    {
        $this->connection = $pdo;
    }

    /**
     * Fetching records from the database
     *
     * @param string $query
     * @param array $bindings
     * @return QueryResult
     */
    public function select(string $query, array $bindings = []): \Iterator
    {
        return $this->run($query, $bindings, function (string $query, array $bindings) {
            $statement = $this->connection->prepare($query);
            $statement->execute($bindings);

            return $statement->getIterator();
        });
    }

    /**
     * Execution of the query
     *
     * @param string $query
     * @param array $bindings
     * @param Closure $callback
     * @return mixed
     */
    private function run(string $query, array $bindings, Closure $callback): mixed
    {
        try {
            $result = $this->runQuery($query, $bindings, $callback);
        } catch (QueryException $exception) {
            throw $exception;
        }

        return $result;
    }

    /**
     * Running SQL query callback
     *
     * @param string $query
     * @param array $bindings
     * @param Closure $callback
     * @return mixed
     * @throws QueryException
     */
    private function runQuery(string $query, array $bindings, Closure $callback): mixed
    {
        try {
            return $callback($query, $bindings);
        } catch (PDOException $exception) {
            throw new QueryException(
                $query,
                $bindings,
                $exception
            );
        }
    }

    /**
     * Inserting a record into the database
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function insert(string $query, array $bindings = []): int
    {
        return $this->run($query, $bindings, function (string $query, array $bindings) {
            $statement = $this->connection->prepare($query);
            $statement->execute($bindings);

            return $statement->rowCount();
        });
    }

    /**
     * Updating records in the database
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function update(string $query, array $bindings = []): int
    {
        return $this->run($query, $bindings, function (string $query, array $bindings) {
            $statement = $this->connection->prepare($query);
            $statement->execute($bindings);

            return $statement->rowCount();
        });
    }

    /**
     * Deleting records from the database
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function delete(string $query, array $bindings = []): int
    {
        return $this->run($query, $bindings, function (string $query, array $bindings) {
            $statement = $this->connection->prepare($query);
            $statement->execute($bindings);

            return $statement->rowCount();
        });
    }
}
