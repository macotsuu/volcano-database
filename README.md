
# Apollo
 An object-oriented way to interact with databases using PDO in PHP


## Features

- Multi databases support
- Using an iterator to handle data
- Simple


## Usage/Examples

```php
<?php
    $connection = new \Database\Connection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'apollo'
    ]);

    $users = $connection->select('SELECT `id`, `name` FROM `users`');
    while($users->valid()) {
        $user = $users->current(); // Getting current record. All records are objects!

        print_r("[{$user->id}] -> $user->name" . PHP_EOL);

        $result->next();
    }
?>
```


## Authors

- [@macotsuu](https://www.github.com/macotsuu)


## License

[MIT](LICENSE)

