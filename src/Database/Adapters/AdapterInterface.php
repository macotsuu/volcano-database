<?php

namespace Apollo\Database\Adapters;

use PDO;

interface AdapterInterface
{
    /**
     * Connect to the database
     *
     * @param array $config
     * @return PDO
     */
    public function connect(array $config): PDO;
}
