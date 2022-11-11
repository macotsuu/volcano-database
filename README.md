
# volcano\database
 An object-oriented way to interact with databases using PDO in PHP


## Features

- Multi databases support
- Using an iterator to handle data
- Simple

## Requirements

- PHP 8.0 +
- PDO

## Usage/Examples

```php
<?php
    $manager = new \Volcano\Database\DatabaseManager([
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'apollo'
    ]);

    $users = $manager->connection()->select('SELECT name, email FROM users');
    while ($users->valid()) {
        $user = $users->current();

        echo $user->name . PHP_EOL;
        echo $user->email . PHP_EOL;

        $users->next();
    }
    ?>
```


## Authors

- [@macotsuu](https://www.github.com/macotsuu)


## License

[MIT](LICENSE)

