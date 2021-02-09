<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Book Store 

This is a simple web application for managing books. This project contains authentication
features (login, register, forgot paswd, etc), list books with search option and more.

### Technologies used
- Laravel (^8.0)
- HTML5 and CSS (Bootstrap)
- MySQL 
- PHP 8
- Docker

## Landing page
1. List all books
- [ ] Books displayed in 5x5 grid (Bootstrap)
- [ ] The book has a title with author, cover, and genre
- [ ] The book can have multiple authors and genres
- [ ] All book covers must have consistent dimensions
- [ ] When there are more than 25 books on a page, there will be [next] and [previous] buttons
- [ ] Books uploaded in the last week should have something to display that they are [NEW]
- [ ] The book may have a discount (by percentage), and I also would like to see that in the listing [10%]

2. Search bar
- [ ] When searching for a book it should look for title and author
- [ ] Lists them in the same layout as the landing page
- [ ] A search bar must have a cookie that tracks the previous search you had

3. Extras
- [ ] Menu bar
- [x] Login and registration button

## Login page
- [x] Login page containing email and password
- [x] "Remember me" option
- [x] "Forgot password" option
- [ ] Register button

## Registration page
- [ ] Log in button
- [ ] Fields: email, password, confirm password, date of birth
- [ ] Password with "show password" option

## Book page
- [ ] Contains description
- [ ] Users may leave reviews
- [ ] Users may rate the book

## User account
- [ ] Change password feature
- [ ] Change email
- [ ] Option to report a book (if there are discrepancies between some of the listed books)
- [ ] Option to upload a book to the listing, then admin manually confirms if the book should be listed or not
- [ ] Area to manage their books
- [ ] Review the book (start + comments)

##Admin account
- [ ] Option to change password
- [ ] Reply to user's report
- [ ] Manage and update all the books
