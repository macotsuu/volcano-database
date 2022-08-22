<?php

    namespace Apollo;

    interface IteratorInterface
    {
        public function count(): int;
        public function current(): mixed;
        public function key(): int;
        public function next(): void;
        public function rewind(): void;
        public function valid(): bool;
        public function at(int $index): mixed;
    }
