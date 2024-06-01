<?php
define("SALT","3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ");

$relativePath = 'api.db';
$absolutePath = realpath($relativePath);
echo $absolutePath;
if ($absolutePath === false) {
    echo "The path $relativePath does not exist.";
    exit;
}
define("DSN","sqlite:$absolutePath");

function getkey(string $key){
try{
$pdo=new PDO(DSN);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result=[];
$select_statement=$pdo->query('select * from apikey where apikey="'.$key.'"');
while ($row= $select_statement->fetch(PDO::FETCH_ASSOC)){
    echo 'NAME '.$row['apikey'].' EMAIL '.$row['ttl'] ;
    echo PHP_EOL;
}}
catch(PDOException $e){echo $e->getMessage(); }
}
getkey('ww');