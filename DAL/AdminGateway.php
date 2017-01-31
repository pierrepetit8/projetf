<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:26
 */
class AdminGateway
{
    private $con;

    public function __construct(Connection $con) {
        $this->con=$con;
    }

    public function find($login,$password)
    {
        $query = "SELECT * FROM admin WHERE login=:login AND password=:password";
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR),
            ':password' => array($password, PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if ($results != NULL)
            return true;
        else
            return false;
    }
}