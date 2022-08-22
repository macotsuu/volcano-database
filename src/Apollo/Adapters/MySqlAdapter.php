<?php

    namespace Apollo\Adapters;

    class MySqlAdapter extends Adapter implements AdapterInterface
    {
        public function connect(array $config): \PDO
        {
            $dsn = $this->getDsn($config);
            $options = $this->getOptions($config);

            $connection = $this->createConnection($dsn, $config, $options);

            return $connection;
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
