ORAD-WEB 2
====

ORAD-WEB - это комплексное web-приложение, которое предостовляет интерфейс для редактирования :
- эфирных топов
- бегущих строк
- фото, используемых в эфире
- курса валют

## Используемые технологии

- [Laravel PHP framework](https://laravel.com/docs)
- [Metronic Bootstrap Admin Dashboard Theme](https://keenthemes.com/metronic/?page=docs)

## Инструкции по сборке

При первой сборке:
```bash
git clone git@github.com:MIR24/orad-web-2.git
cd orad-web-2/
git checkout develop
cp .env.example .env
# Внести настройки в конфигурационный файл .env
composer update
php artisan migrate
php artisan key:generate
npm install
gulp
php artisan serve
```
Увидеть интерфейс можно будет по адресу:
http://127.0.0.1:8000/

Для последующих сборок можно использовать команду:
```bash
git pull && composer update && php artisan migrate && npm install && gulp
```
