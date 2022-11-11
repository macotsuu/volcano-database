<?php

    namespace Volcano\Database;

    use Volcano\Database\Connectors\ConnectorFactory;

    class DatabaseManager
    {
        private array $connections = [];
        private array $configuration = [];
        private ConnectorFactory $factory;

        public function __construct(array $configuration)
        {
            $this->configuration = $configuration;
            $this->factory = new ConnectorFactory();
        }

        public static function i(array $configuration): self
        {
            return new static($configuration);
        }

        /**
         * @var string $name
         * @return Connection
         */
        public function connection(string $name = 'default'): Connection
        {
            if (!isset($this->connections[$name])) {
                $this->connections[$name] = $this->makeConnection(
                    $this->configuration
                );
            }

            return $this->connections[$name];
        }

        public function makeConnection(array $configuration): Connection
        {
            return new Connection(
                $this->factory->make($configuration),
                $configuration
            );
        }
    }
