## О проекте

Просто выполненное тестовое задание от ED-IT на Laravel 12 и PHP 8.4

## Деплой проекта

Для деплоя используйте следующую команду в корне проекта:

```
make all
```

В корне проекта содержится Makefile для этого.

Если на вашем устройстве не установлен компилятор g++, то можно вручную задеплоить:

\# Собираем проект

```
docker compose up --build -d --remove-orphans
```

\# Стартуем сборку (на всякий, если какой-то контейнер не запустится при сборке)

```
docker compose up -d
```

\# Копируем .env.example в .env

```
cp .env.example .env
```

\# Устанавливаем зависимости

```
composer install
```

\# Генерим ключ

```
docker compose exec app php artisan key:generate
```

\# Запускаем миграции и выполняем сиды

```
docker compose exec app php artisan migrate:fresh --seed
```

\# Смотрим результат работы команды из ТЗ

```
docker compose exec app php artisan intervals:list --left=1 --right=1000
```

## Результат работы

<div align="center">
    <img src="https://raw.githubusercontent.com/a0xh/ed-it/refs/heads/main/public/images/result.png">
</div>

## Результат тестов

<div align="center">
    <img src="https://raw.githubusercontent.com/a0xh/ed-it/refs/heads/main/public/images/test.png">
</div>

## Результат анализа

<div align="center">
    <img src="https://raw.githubusercontent.com/a0xh/ed-it/refs/heads/main/public/images/analyse.png">
</div>
