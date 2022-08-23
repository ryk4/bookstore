# Book Store 

TODO - fix this awful description

This is a simple web application for managing books. This project contains authentication
features (login, register, forgot paswd, etc), list books with search option and more.

### Technologies used
- Laravel 9
- PHP 8
- Vue JS

### Install and run on local
```sh
git clone {projectURL}
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed
php artisan serve
```

### Features
- Full authentication with permission roles
- Service design pattern
- RESTful principles
- TODO Automated Feature tests
- Vue components for some UI interactions

