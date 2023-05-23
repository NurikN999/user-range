## User Ranging Task

#### Документация к API

```
 [POST] /api/register
```

Тело запроса
```json
{
    "firstname": "Test",
    "lastname": "Test",
    "email": "test@gmail.com",
    "password": "testtest",
    "password_confirm": "testtest",
    "rank": 0
}
```

Тело ответа
```json
{
    "firstname": "Test",
    "lastname": "Test",
    "email": "test@gmail.com",
    "rank": "0"
}
```

```
   [POST] /api/login
```
Тело запроса
```json
{
    "email": "test@gmail.com",
    "password": "testtest"
}
```
В ответе придет JWT токен. Можно сохранить, и поставить в заголовок запроса, но я сделал так, чтобы он автоматически сохранялся в куки

```
    [POST] /api/users/{id}/increase-rank
```
Увеличит ранг пользователю, айди которого вы укажете в URL

```
    [POST] /api//api/users/{id}/decrease-rank
```
Уменьшит ранг пользователю, айди которого вы укажете в URL

```
    [POST] /api/users/cache
```
Кэширует всех пользователей из базы данных и сохраняет в REDIS

```
    [GET] /api/users/rank?rank_from=1&rank_to=5
```
Выведет пользователей, у кого рейтинг от 1 до 5 (рейтинг указывается в параметрах)
Тело ответа:
```json

[
    {
        "id": 1,
        "firstname": "Alibek",
        "lastname": "Nurlanov",
        "email": "nurkamal433@gmail.com",
        "password": "$2y$10$YbOrNjKYr/4rkbCFbQCNQ.nXZw1NwJ2KmjaAJMzgiNFS.mRAJuJDu",
        "rank": 4,
        "created_at": "2023-05-23T11:10:25.000000Z",
        "updated_at": "2023-05-23T11:32:20.000000Z"
    },
    {
        "id": 2,
        "firstname": "Nurik",
        "lastname": "Nurkamal",
        "email": "nurkamaln@gmail.com",
        "password": "qwerty123",
        "rank": 3,
        "created_at": "2023-05-23T17:30:21.000000Z",
        "updated_at": "2023-05-23T11:32:02.000000Z"
    },
    {
        "id": 3,
        "firstname": "Alikhan",
        "lastname": "Nurkamal",
        "email": "nurkamala@gmail.com",
        "password": "qwerty1234",
        "rank": 2,
        "created_at": "2023-05-23T17:33:18.000000Z",
        "updated_at": "2023-05-23T11:44:28.000000Z"
    }
]
```
