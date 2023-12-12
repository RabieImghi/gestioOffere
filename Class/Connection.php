<?php
class Connection{
    public static function getConnection(){
        return new PDO("mysql:host=localhost;dbname=gestionoffer","root", "");
    }
}