
## Test task

После загрузки проекта:

Docker:
- composer install
- docker-compose build app
- docker-compose up -d
- docker-compose exec app php yii migrate
- docker-compose exec app php rbac/init
- [localhost:8000/](localhost:8000/) GET.


## Доступы
Админ
login: admin
passwd: 12345678

Клиент
login: customer
passwd: 12345678
## Комментарии разработчика:
Прикреплил Postman коллекцию
для начала создадим автора после создания автора добавим жанр и в последнюю очередь создадим книгу

Так как в тестовом задании не было инструкий использовать денормализованную БД или же нормализованную БД.
Остановил выбор на денормализованной БД и поэтому жанры я храню в виде строки

