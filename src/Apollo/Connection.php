<?php

    namespace Apollo;

    use PDO;
    use Closure;
    use PDOException;
    use Apollo\Adapters\MySqlAdapter;
    use Apollo\Exceptions\Exceptions\QueryException;

    class Connection implements ConnectionInterface
    {
        private PDO $connection;

        public function __construct(array $config)
        {
            if (empty($config['adapter'])) {
                throw new \Exception("Please provider a Database Adapter.");
            }

            $driver = match ($config['adapter']) {
                'mysql' => new MySqlAdapter()
            };

            $this->connection = $driver->connect($config);
        }

        public function select(string $query, array $bindings): QueryResult
        {
            return $this->run($query, $bindings, function (string $query, array $bindings) {
                $statement = $this->connection->prepare($query);
                $statement->execute($bindings);

                return new QueryResult($statement->fetchAll());
            });
        }

        public function insert(string $query, array $bindings): int
        {
            return $this->run($query, $bindings, function (string $query, array $bindings) {
                $statement = $this->connection->prepare($query);
                $statement->execute($bindings);

                return $statement->rowCount();
            });
        }

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
         * Undocumented function
         *
         * @param string $query
         * @param array $bindings
         * @throws QueryException
         * @return mixed
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
    }
