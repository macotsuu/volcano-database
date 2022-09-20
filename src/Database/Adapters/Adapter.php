<?php

namespace Apollo\Database\Adapters;

use PDO;
use PDOException;

abstract class Adapter
{
    protected array $options = [
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
     * @return PDO
     * @throws PDOException
     */
    public function createConnection(string $dsn, array $config, array $options): PDO
    {
        [$username, $password] = [
            $config['username'] ?? null, $config['password'] ?? null
        ];

        return $this->createPDOConnection($dsn, $username, $password, $options);
    }

    protected function createPDOConnection(string $dsn, string $username, string $password, array $options): PDO
    {
        return new PDO($dsn, $username, $password, $options);
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
}
