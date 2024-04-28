<?php
class DB 
{
    // Aqui é a conexão com o bando de dados, neste caso, o MariaDB -- >
    public static function connect() 
    {
        $host = '127.0.0.1'; // banco de dados rodando localmente através do docker -- > consulte a documentação (README) para saber como instanciar o banco de dados através do docker composer
        $user = 'root'; // usuário do banco de dados
        $password = 'root'; // senha do banco de dados
        $database = 'datafrete'; // nome do banco de dados
        // Note que a porta do banco de dados abaixo é a 3606. Optei por utilizar esta porta pois muitas vezes temos o mysql server rodando localmente tambem, então, para que não haja conflito com o mysql local e o docker, coloquei o MariaDB para rodar na 3606
        return new PDO("mysql:host={$host};dbname={$database};port=3606;charset=UTF8;", $user, $password);
    }
}