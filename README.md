# Chat App
A implementation of a chat app using lavarel framework

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

## Setup
The easiest way to run this project locally is through docker/docker-compose

    Assuming you have `docker` and `docker-compose` installed on your system
    In the directory of your choice.
    You can:
`$ wget https://raw.githubusercontent.com/chioffor/chat-group-app/main/docker-compose.yml`
`$ docker-compose up`
    After services are up and running, open a new terminal and enter
`$ docker exec main php artisan migrate`
    On your web browser visit "localhost:8000"   

Or via composer:
`$ git clone https://github.com/chioffor/chat-group-app.git`
`$ cd chat-group-app`
`$ composer install`
`$ cp .env.example .env` 
    update environment variables in .env file - database, pusher, broadcast_driver, etc
`$ php artisan key:generate`
`$ php artisan migrate`
`$ php artisan serve`
    On your web browser visit "localhost:8000"


## To-do
* Refactor 
* Test
* App design

## Status
As the app is not production-ready :)

