<?php
namespace App\Utils;
use PDO;
use PDOException;
use DateTime;
$relativePath = 'C:\Users\Amir\Desktop\php_ch\api.db';
$absolutePath = realpath($relativePath);
//echo $absolutePath;
if ($absolutePath === false) {
    echo "The path $relativePath does not exist.";
    //exit;
}
//echo $relativePath;
if (!defined('DSN')){define("DSN","sqlite:$absolutePath");}


class GlobalFunctions
{
    
    public static function is_key_valid(string $apikey)// -1 =>expired , 0 Not valid, 1 Valid
    {
     
        $SALT1="3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ";
        $hashedkey=hash_pbkdf2('sha256',$apikey,$SALT1,1100);
        try{
        $pdo=new PDO(DSN);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result=[];
        $select_statement=$pdo->query('select * from apikey where apikey="'.$hashedkey.'"');

        $result=$select_statement->fetchAll();}
        catch(PDOException $e){echo $e->getMessage(); }
        if (sizeof($result)>0){
            $now=time();
            $sinc=new DateTime($result[0]["created_time"]);
            $dif=abs($now-$sinc->getTimestamp());
            if ($dif > ($result[0]["ttl"] *3600)){return -1;}
            else{return 1;}}

        return 0;
    }
}