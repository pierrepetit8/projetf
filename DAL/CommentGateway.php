<?php

/**
 * Created by PhpStorm.
 * User: hpiat
 * Date: 09/01/2017
 * Time: 12:25
 */
class CommentGateway
{
    private $con;

    public function __construct(Connection $con) {
        $this->con=$con;
    }

    public function findAll($id) {
        $query="SELECT * FROM comments WHERE Id_music=:id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT)));
        $results = $this->con->getResults();
        return $results;
    }

    public function insert($text,$id_music) {
        $query="INSERT INTO comments values(null,:text,:id_music)";
        $this->con->executeQuery($query,array(':text'=>array($text,PDO::PARAM_STR),
            ':id_music'=>array($id_music,PDO::PARAM_INT)));
        return $this->con->lastInsertId();
    }

    public function findBy($id) {
        $query="SELECT * FROM comments WHERE Id=:id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT)));
        $results = $this->con->getResults();
        return $results;
    }

    public function delete($id) {
        $query="DELETE FROM comments WHERE Id=:id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT)));
        $results = $this->findBy($id);
        if ($results==null)
            return true;
        return false;
    }
}