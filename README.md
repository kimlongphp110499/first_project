# Laravel Back API

This is a RESTful API built with Laravel that provides the backend functionality for an online learning platform. The API has multiple account types: admin, instructors and students.

## Features

- Instructors can create courses and make posts for their courses
- Admin delete courses
- Students can enroll in courses and reply to posts of enrolled courses.
- Students can view their courses enrolled.
- Instructors can delete any reply on their posts.
- Students can delete their own replies on posts.

## Installation

- Clone this repository: `git clone https://github.com/kimlongphp110499/first_project`
- Install dependencies: `composer install`
- Copy the .env.example file to .env and fill in your database credentials
- Generate an app key: `php artisan key:generate`
- Run migrations and seeders: `php artisan migrate`
- Start the server: `php artisan serve`

## Endpoints

The base URL for the API is `http://localhost:8000/api/` with Authorization by JWT Bearer token

| Method | Endpoint | Description | Parameters | Headers |
| ------ | -------- | ----------- | ---------- | ------- |
| POST   | /student/register | Students can register new account | name, email, password, password_confirmation | None |
| POST   | /student/login | Students can login with their account | email, password | None |
| GET    | /student/profile | Students can register new account |  | Student Authorization |
| POST   | /student/refresh | Students can create new access tokens | email, password | Student Authorization |
| POST   | /student/logout | Students logout their account | email, password | Student Authorization |
| POST   | /admin/register | Admins can register new account | name, email, password, password_confirmation | None |
| POST   | /admin/login | Admins can login with their account | email, password | None |
| GET    | /admin/profile | Admins can register new account |  | Admin Authorization |
| POST   | /admin/refresh | Admins can create new access tokens | email, password | Admin Authorization |
| POST   | /admin/logout | Admins logout their account | email, password | Admin Authorization |
| POST   | /instructor/register | Instructors can register new account | name, email, password, password_confirmation | None |
| POST   | /instructor/login | Instructors can login with their account | email, password | None |
| GET    | /instructor/profile | Instructors can register new account |  | Instructor Authorization |
| POST   | /instructor/refresh | Instructors can create new access tokens | email, password | Instructor Authorization |
| POST   | /instructor/logout | Instructors logout their account | email, password | Instructor Authorization |
| POST   | /course/create | Instructors can register new course | name, amount | Instructor Authorization |
| POST   | /courses/enroll | Students can enroll any course | course_id | Student Authorization |
| POST   | /course/delete | Admin can delete any course | course_id | Admin Authorization |
| POST   | /post/create | Instructors can create post for their course | title, content, course_id | Instructor Authorization |
| POST   | /post/show | Students can view post from their enrolled course | post_id | Student Authorization |
| POST   | /reply/create | Students can make a reply to post from their enrolled course | content, post_id | Student Authorization |
| POST   | /reply/delete | Students can delete their reply, Instructor can delete any reply | reply_id | Student or Instructor Authorization |
Student:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture1.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture2.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture3.png)]

Instructor:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture5.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture6.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture7.png)]

Admin:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture8.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture9.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture10.png)]

Course:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture11.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture12.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture13.png)] 

Post:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture14.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture15.png)] 

Reply:
 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture16.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_projectmaster/Picture17.png)]


Student:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture1.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture2.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture3.png)]

Instructor:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture5.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture6.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture7.png)]

Admin:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture8.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture9.png)] 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture10.png)]

Course:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture11.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture12.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture13.png)] 

Post:

![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture14.png)]
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture15.png)] 

Reply:
 
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture16.png)]  
![N|https://raw.githubusercontent.com/kimlongphp110499/first_project/master/Picture17.png)]