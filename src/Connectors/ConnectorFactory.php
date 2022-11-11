<?php

    namespace Volcano\Database\Connectors;

    use PDO;

    class ConnectorFactory
    {
        public function make(array $config): PDO
        {
            return $this->createConnector($config)->connect($config);
        }

        public function createConnector(array $config): ConnectorInterface
        {
            if (! isset($config['driver'])) {
                throw new \InvalidArgumentException('A driver must be specified.');
            }

            return match ($config['driver']) {
                'mysql' => new MySqlConnector(),
                default => throw new \InvalidArgumentException("Unsupported driver [{$config['driver']}].")
            };
        }
    }
