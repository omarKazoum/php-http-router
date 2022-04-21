<?php
//add here any routes that you want to handle in your website

Router::get ('/users/',[new UsersController(),'list']);
Router::get('/users/{id}',[new UsersController(),'view']);
Router::get('contacts/{name}',[new UsersController(),'contactslist']);

