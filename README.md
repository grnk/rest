# rest

Для развёртывания проекта выполнить в корне проекта `docker compose up -d`

Зайти в контейнер с php `docker exec -it yii2_php bash`, затем перейти в директирию с приложением yii `cd /var/www/yii2-app/`,
выполнить `composer install` и `php init`.

Настроить подключение к базе данных в файле `/var/www/yii2-app/common/config/main-local.php`
```
'db' => [
    'class' => \yii\db\Connection::class
    'dsn' => 'mysql:host=yii2_mysql;dbname=yii2',
    'username' => 'yii2',
    'password' => 'yii2',
    'charset' => 'utf8',
],
```

Выполнить миграции `php yii migrate`

Заполнить таблицы консольной командой `php yii fill`

Rest API

Получить список статей `http://localhost:8085/v1/articles?page=1`

Поиск статей по ФИО Автора, Названию статьи, Категории `http://localhost:8085/v1/articles/search?search=Category_name1`

Получение данных по

id Автора `http://localhost:8085/v1/authors/15`

id Статьи `http://localhost:8085/v1/articles/25`

id Категории `http://localhost:8085/v1/categories/10`
