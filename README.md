<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Book Store 

This is a simple web application for managing books. This project contains authentication
features (login, register, forgot paswd, etc), list books with search option and more.

### Technologies used
- Laravel (^8.0)
- HTML5 and CSS (Bootstrap 4)
- MySQL 
- PHP 8

### Project development environment
- XAMPP (for MySQL only)
- PhpStorm  2020.3.2
- PHP ARTISAN SERVE (NGINX Macos, Xampp Win10)

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

## Landing page (will add "cards" styling.)
1. List all books
- [x] Books displayed in 5x5 grid (Bootstrap)
- [x] The book has a title with author, cover, and genre
- [x] The book can have multiple authors and genres
- [x] All book covers must have consistent dimensions
- [x] When there are more than 25 books on a page, there will be [next] and [previous] buttons
- [x] Books uploaded in the last week should have something to display that they are [NEW]
- [x] The book may have a discount (by percentage), and I also would like to see that in the listing [10%]

2. Search bar
- [x] When searching for a book it should look for title and author
- [x] Lists them in the same layout as the landing page
- [x] A search bar must have a cookie that tracks the previous search you had

3. Extras
- [x] Menu bar
- [x] Login and registration button

## Login page
- [x] Login page containing email and password
- [x] "Remember me" option
- [x] "Forgot password" option
- [x] Register button

## Registration page
- [x] Log in button
- [x] Fields: email, password, confirm password, date of birth
- [x] Password with "show password" option

## Book page
- [x] Contains description
- [x] Users may leave reviews
- [x] Users may rate the book

## User account
- [x] Change password feature
- [x] Change email feature
- [x] Option to report a book (for reasons like incorrect description, NSFW content, etc). 
- [x] Option to upload a book to the listing, then admin manually confirms if the book should be listed or not
- [x] Area to manage their books
- [x] Review the book (star rating + comments)

## Admin account
- [x] Option to change password
- [x] Reply to user's report
- [x] Manage and update all the books


# Phase 2

## Task 1 (API resourece)
- [x] Api to return all books (only approved). /api/v1/books
- [x] /api/v1/books fields: id, title, cover full url, price, authors and genres
  (as comma-separated)
- [x] Api needs to be written as API resource (routes/api.php)
- [x] Create an endpoint for a single book /api/v1/books/{id} and show the fields the same as in the list but also add Description field. But you need to use the same Laravel API Resource, just with the condition of when to add the description field or not.

## Task 2 (Vue.js)
- [ ] Logged in user can post rating/review, but it needs to be saved immediately on the same page and refresh the list of reviews and the average rating.
- [x] Review api: GET /api/v1/books/{id}/review and POST /api/v1/books/{id}/review
- [x] Review api: GET /api/v1/review and POST /api/v1/review

