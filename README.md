# Проект - тестовое задание

## **Проект имеет APP_SECRET в открытом доступе, если планируете использовать проект в продакшене вам следует сменить его!**

## Инструкция по развертыванию проекта

1. Клонировать репозиторий и установить docker-compose.
2. Создаем конфигурацию docker-compose.yml.

    ```bash
    cp docker-compose-example.yml docker-compose.yml
    ```

3. Запускаем среду разработки:  

    ```bash
    docker-compose up -d
    ```

4. Запускаем миграции и загрузку фикстур:

    ```bash
    docker-compose exec app php bin/console doctrine:migrations:migrate
    docker-compose exec app php bin/console doctrine:fixtures:load
    ```

## Руководство

* Проект по умолчанию доступен по адресу [localhost](http://localhost)
* Ссылка на админер - веб-интерфейс для ваших бд: [localhost:8080](http://localhost:8080/?pgsql=db&username=example&db=example&password=example&ns=public) пароль "example".



## Описание тестового задания

Нужно сделать простую систему тестирования, поддерживающую вопросы с нечеткой логикой и возможностью выбора нескольких вариантов ответа.

### Требования

1. Cсылка на GitHub / Bitbucket с кодом и инструкцией по разворачиванию проекта
2. Проект должен быть обернут в docker
3. Пользователь должен иметь возможность пройти тест от начала до конца и в конце увидеть два списка - вопросы на которые он ответил верно и вопросы, где ответы содержали ошибки.
4. Должна быть возможность пройти тест сколько угодно раз
5. Каждый результат тестирования должен сохраняться в БД (выводить результаты не обязательно)
6. (Не обязательно) И вопросы, и ответы для каждого вопроса должны показываться пользователю в случайном порядке при каждой новой серии тестирования.

### Условия

1. Задание нужно выполнять с использованием Symfony и PostgreSQL
2. Внешний вид не важен, авторизация не нужна, админка не нужна, достаточно разово добавить вопросы с ответами в БД

### Примеры вопросов

#### 1 + 1 = ?

Ответы:

1. 3
2. 2
3. 0

Правильный ответ: 2

#### 2 + 2 = ?

Ответы:

1. 4
2. 3 + 1
3. 10

Правильный ответ: 1 ИЛИ 2 ИЛИ (1 И 2)

## Прочее, полезные ссылки

[https://symfony.com/doc/current/best_practices.html](https://symfony.com/doc/current/best_practices.html)

связь ResultItem -> QuestionAnser
QuestionAnser добавить deleted_at