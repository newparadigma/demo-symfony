# Test Symfony

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
* Ссылка на админер - веб-интерфейс для ваших бд: [localhost:8080](http://localhost:8080)

## Описание функционала проекта

Проект представляет собой простую систему тестирования, поддерживающую вопросы с нечеткой логикой и возможностью выбора нескольких вариантов ответа.  
Пользователь должен иметь возможность пройти тест от начала до конца и в конце увидеть два списка - вопросы на которые он ответил верно и вопросы, где ответы содержали ошибки.  
Вопросы и ответы показываться в случайном порядке при каждой новой серии тестирования (нереализовано).  
Должна быть возможность пройти тест сколько угодно раз. Каждый результат тестирования сохраняется в БД.

### Пример вопроса с нечеткой логикой

1 + 1 = ?

Ответы

1. **1 неверно**
2. 2
3. 3 - 1
4. 4 - 2
5. **5 - 2 неверно**

Правильным ответом является любая комбинация корректных ответов. Наличие хотя бы одного некорректного ответа считается ошибкой.
Например:

* 2 (верный ответ)
* 2 и 3 (верный ответ)
* 2 и 3 и 4(верный ответ)
* 3 (верный ответ)
* 3 и **1** (неверный ответ)
* 4 и 5 (неверный ответ)
* **5** (неверный ответ)

## Прочее, полезные ссылки

[https://symfony.com/doc/current/best_practices.html](https://symfony.com/doc/current/best_practices.html)
