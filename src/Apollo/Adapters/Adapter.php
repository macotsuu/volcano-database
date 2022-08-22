<?php

    namespace Apollo\Adapters;

    use PDO;
    use PDOException;

    abstract class Adapter
    {
        protected $options = [
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        /**
         * Undocumented function
         *
         * @param string $dsn
         * @param array $config
         * @param array $options
         * @throws PDOException
         * @return PDO
         */
        public function createConnection(string $dsn, array $config, array $options): PDO
        {
            [$username, $password] = [
                $config['username'] ?? null, $config['password'] ?? null
            ];

            try {
                return $this->createPDOConnection($dsn, $username, $password, $options);
            } catch (PDOException $PDOException) {
                throw $PDOException;
            }
        }

        /**
         * @param array $config
         * @return array
         */
        public function getOptions(array $config): array
        {
            $options = $config['options'] ?? [];

            return array_diff_key($this->options, $options) + $options;
        }

        protected function createPDOConnection(string $dsn, string $username, string $password, array $options): PDO
        {
            return new PDO($dsn, $username, $password, $options);
        }
    }
