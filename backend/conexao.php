<?php

//configurações do banco de dados
 
$host = 'localhost';
$db = 'Rtrips';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
 
$dsn = "mysql:host=$host;dbname=$db;$charset";
 
//criando a conexão com o banco de dados
 
try{
//Essa linha cria
//uma conexão com o banco de dados usando a classe PDO (PHP Data Objects).
$pdo = new PDO($dsn, $user, $pass);
echo "";
}
catch(PDOxception $e){
    echo "Erro ao tentar conectar ao banco de dados!<p>", $e;
}

?>