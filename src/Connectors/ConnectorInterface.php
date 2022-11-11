<?php

namespace Volcano\Database\Connectors;

use PDO;

interface ConnectorInterface
{
    /**
     * Connect to the database
     *
     * @param array $config
     * @return PDO
     */
    public function connect(array $config): PDO;
}
