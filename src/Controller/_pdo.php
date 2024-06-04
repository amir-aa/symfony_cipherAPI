<?php
//define("SALT1","3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ");

$relativePath = 'C:\Users\Amir\Desktop\php_ch\api.db'; //full path required
$absolutePath = realpath($relativePath);
//echo $absolutePath;
if ($absolutePath === false) {
    echo "The path $relativePath does not exist.";
    //exit;
}
if (!defined('DSN')){define("DSN","sqlite:$absolutePath");}


if (!function_exists('getkey')) {
function getkey(string $key):array{
$SALT1="3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ";
try{
$pdo=new PDO(DSN);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result=[];
$select_statement=$pdo->query('select * from apikey where apikey="'.$key.'"');
/*while ($row= $select_statement->fetch(PDO::FETCH_ASSOC)){
    echo 'NAME '.$row['apikey'].' EMAIL '.$row['ttl'] ;
    echo PHP_EOL;
}*/
$result=$select_statement->fetchAll();}
catch(PDOException $e){echo $e->getMessage(); }
return $result;
}}
//var_dump(getkey(hash_pbkdf2('sha256','79b94cf28a80aadbacdb0414dacbc544c380827a187a6f244ec35d0df9739b54','3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ',1100)));