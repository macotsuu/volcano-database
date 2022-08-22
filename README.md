
# Apollo
 An object-oriented way to interact with databases using PDO in PHP


## Features

- Multi databases support
- Using an iterator to handle data
- Simple


## Usage/Examples

```php
<?php
    $connection = new \Apollo\Connection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'database'
    ]);

    $users = $connection->select('SELECT * FROM users');
    while($users->valid()) {
        print_r("Key " . $users->key()) . PHP_EOL;
        print_r("User " . $users->current()) . PHP_EOL;

        $result->next();
    }
?>
```


## Authors

- [@macotsuu](https://www.github.com/macotsuu)


## License

[MIT](LICENSE)

