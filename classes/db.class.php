<?php
class DB 
{
    public static function connect() 
    {
        $host = '127.0.0.1';
        $user = 'root';
        $password = 'root';
        $database = 'datafrete';

        return new PDO("mysql:host={$host};dbname={$database};port=3606;charset=UTF8;", $user, $password);
    }
}