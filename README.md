# Chat App   
An implementation of a chat application using lavarel framework
Test site - [chikaoffor.com/chatapp](https://chikaoffor.com/chatapp).

## Table of contents
* [General info](#general-info)
<!-- * [Screenshots](#screenshots) -->
* [Technologies](#technologies)
* [Setup](#setup)
* [To-do](#to-do)
* [Status](#status)

## General info
This app is an implementation of the idea of a chat application.

<!-- ## Screenshots
![Example screenshot](./img/screenshot-small.png) -->

## Technologies
* Laravel Framework
* PHP 8
* Bootstrap 5
* Javascript
* jQuery
* Pusher
* Docker
* Kubernetes

## Setup
The easiest way to view and see the functionalities - visit the test site `https://chikaoffor.com/chatapp`

To run on your system via composer:
```
$ git clone https://github.com/chioffor/laravel-chat-application.git
$ cd laravel-chat-application
$ cp .env.example .env    #update environment variables in .env file - database, pusher, broadcast_driver, etc
$ composer install
$ npm install && npm run dev
$ php artisan key:generate
$ php artisan migrate
$ php artisan serve    #On your web browser visit "localhost:8000"
```
    


## To-do
* Refactor 
* Test
* App design

## Status
In Progress :)

