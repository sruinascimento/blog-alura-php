<?php

//Aprendendo sobre banco de dados
 //Conectando com o banco de dados, endereco, user, senha, nome da base
function startConnection(): mysqli
{
    $mysql = new mysqli('localhost', 'root', '', 'blog');
 //Definindo o charset da conexão do banco de dados 
    $mysql->set_charset('utf8');
    if ($mysql == FALSE) {
        echo "Erro na conexão" . PHP_EOL;
    }
    return $mysql;
}





 