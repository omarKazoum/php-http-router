<?php
class UsersController{

    public function list(){
        //echo 'this is a list of users';
        include '../views/users_list_view.php';
    }
    public function view($id){
        include '../views/user_details_view.php';
    }
    public function contactslist($name){
        echo 'test contacts name is '.$name;
    }
}