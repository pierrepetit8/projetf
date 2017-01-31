<?php
/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:48
 */

//Prefixe

$rep=__DIR__.'/../';

//BD
$base='mysql:dbname=umusic;host=127.0.0.1';
$log_db='root';
$pass_db='';

//Vues
$views['error']='./views/Error.php';
$views['home']='./views/Home.php';
$views['login']='./views/Login.php';
$views['add']='./views/Add.php';
$views['details']='./views/Details.php';