<?php

    namespace Apollo\Adapters;

    interface AdapterInterface
    {
        /**
         * @param array $config
         * @return \PDO
         */
        public function connect(array $config): \PDO;
    }
