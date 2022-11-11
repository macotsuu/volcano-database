<?php

namespace Volcano\Database\Connectors;

use PDO;

class MySqlConnector extends Connector implements ConnectorInterface
{
    public function connect(array $config): PDO
    {
        $dsn = $this->getDsn($config);
        $options = $this->getOptions($config);

        return $this->createConnection($dsn, $config, $options);
    }

    /**
     * @param array $config
     * @return string
     */
    private function getDsn(array $config): string
    {
        extract($config, EXTR_SKIP);

        return isset($port)
            ? "mysql:host={$host};port={$port};dbname={$database}"
            : "mysql:host={$host};dbname={$database}";
    }
}
