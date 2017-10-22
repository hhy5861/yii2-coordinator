yii2-coordinator
============================

```php
    'components' => [
        'coordinator' => [
            'class' => 'mike\coordinator\CoordinatorComponent',
            'component' => [
                [
                    'class' => 'mike\coordinator\FunctionCoordinator',
                    'function' => function($i) {
                        return $i % 4;
                    }
                ],
                [
                    'class' => 'mike\coordinator\RedisCoordinator',
                    'hashName' => 'sharding',
                    'connect' => [
                        'class' => 'yii\redis\Connection',
                        'hostname' => '127.0.0.1',
                        'port' => 6379,
                        'database' => 4,
                    ]
                ],
                [
                    'class' => 'mike\coordinator\DbCoordinator',
                    'table' => [
                        'name' => 'sharding',
                        'columnSearch' => 'bucket_id',
                        'columnResult' => 'shard_id'
                    ],
                    'connect' =>[
                        'class' => 'yii\db\Connection',
                        'dsn' => 'mysql:host=localhost;dbname=test',
                        'username' => 'root',
                        'password' => 'root',
                        'charset' => 'utf8',
                    ]
                ]
            ]
        ],
    ]
```
```php
...
$coordinator = \Yii::$app->coordinator;
$shardDb = $coordinator->getShard($db, $keyShard);
...
```
```php
...
'function' => function($i) {
    return $i % 4;
}
...
```

### DbCoordinator
```php
...
'table' => [
    'name' => 'sharding',
    'columnSearch' => 'bucket_id',
    'columnResult' => 'shard_id'
  ],
...  
```

### RedisCoordinator
```php
...
 'hashName' => 'sharding'
...  
```
