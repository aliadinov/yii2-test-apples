### Сетап проекта
```
1. git clone https://github.com/aliadinov/yii2-test-apples
2. composer install
3. php init --env=Development
4. Создать БД yii2apples и прописать ее в common/config/main-local.php
5. php yii migrate
6. Страница будет достуна по урлу http://{{your_backend_url}}
7. Кронтаска: * * * * * php yii apples/mark-rotten
```