# meeting-management__backend
Backend для приложения, разворачиваемый на localhost:8080

## Как запустить:
1. Скачать репозиторий
2. В корневой папке репозитория прописать ```docker-compose up --build -d ```
3. Подождать, пока запустится бд

## Как остановить:
```
docker-compose down
```

## Тестовые данные:

Тестовый аккаунт для логина:
```json
{
    "email": "example@gmail.com",
    "password": "my_new_insane_pass"
}
```
