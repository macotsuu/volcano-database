<?php

namespace Apollo\Database;

use Apollo\Database\Adapters\MySqlAdapter;
use Apollo\Database\Exceptions\QueryException;
use Closure;
use Exception;
use PDO;
use PDOException;

class Connection implements ConnectionInterface
{
    private PDO $connection;

    public function __construct(array $config)
    {
        if (empty($config['driver'])) {
            throw new Exception("Please provider a Database Adapter.");
        }

        $driver = match ($config['driver']) {
            'mysql' => new MySqlAdapter()
        };

        $this->connection = $driver->connect($config);
    }

    /**
     * Fetching records from the database
     *
     * @param string $query
     * @param array $bindings
     * @return QueryResult
     */
    public function select(string $query, array $bindings = []): QueryResult
    {
        return $this->run($query, $bindings, function (string $query, array $bindings) {
            $statement = $this->connection->prepare($query);
            $statement->execute($bindings);

            return new QueryResult($statement->fetchAll(PDO::FETCH_OBJ));
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
