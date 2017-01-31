<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 30/11/16
 * Time: 17:06
 */
class MusicGateway
{
    private $con;

    public function __construct(Connection $con) {
        $this->con=$con;
    }

    public function insert($name, $artist, $album, $duration, $upload) {
        $query="INSERT INTO music values(null,:name,:artist,:album,:duration,:upload,0,0,0)";
        $this->con->executeQuery($query,array(':name'=>array($name,PDO::PARAM_STR),
            ':artist'=>array($artist,PDO::PARAM_STR),
            ':album'=>array($album,PDO::PARAM_STR),
            ':duration'=>array($duration,PDO::PARAM_INT),
            ':upload'=>array($upload,PDO::PARAM_STR)));
        return $this->con->lastInsertId();
    }

    public function findAll() {
        $query="SELECT * FROM music";
        $this->con->executeQuery($query);
        $results = $this->con->getResults();
        return $results;
    }

    public function findBy($id) {
        $query="SELECT * FROM music WHERE Id=:id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT)));
        $results = $this->con->getResults();
        return $results;
    }

    public function delete($id) {
        $query="DELETE FROM music WHERE Id=:id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT)));
        $results = $this->findBy($id);
        if ($results==null)
            return true;
        return false;
    }

    public function setRatePos($id, $rate) {
        $query="UPDATE music SET p_rates=:rate WHERE Id=:id";
        $this->con->executeQuery($query, array('id'=>array($id, PDO::PARAM_INT),
            'rate'=>array($rate,PDO::PARAM_INT)));
    }

    public function setRateNeg($id, $rate) {
        $query="UPDATE music SET n_rates=:rate WHERE Id=:id";
        $this->con->executeQuery($query, array('id'=>array($id, PDO::PARAM_INT),
            'rate'=>array($rate,PDO::PARAM_INT)));
    }

    public function setRateNeu($id, $rate) {
        $query="UPDATE music SET neu_rates=:rate WHERE Id=:id";
        $this->con->executeQuery($query, array('id'=>array($id, PDO::PARAM_INT),
            'rate'=>array($rate,PDO::PARAM_INT)));
    }
}