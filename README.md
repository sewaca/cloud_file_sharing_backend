# meeting-management__backend
Backend для приложения, разворачивается на localhost:8080

## Как запустить:
1. Скачать репозиторий
2. В корневой папке репозитория прописать 
```sh
docker-compose up --build -d 
```
3. После окончания билда, будут доступны следующие порты:
    - 8000 для бекенда
    - 3000 для фронтенда

Для запуска без docker контейнера используйте комманду 
```sh
php -S 127.0.0.1:8000 ./server/index.php
```

## Как остановить:
```sh
docker-compose down
```

## Тестовые данные:

Тестовый аккаунт для логина следует зарегистрировать самостоятельно
