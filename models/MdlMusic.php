<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 30/11/16
 * Time: 16:57
 */
class MdlMusic
{
    public function getAllMusics() {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $m  = new MusicGateway($con);
        $results = $m->findAll();
        return $results;
    }

    public function addMusic(Music $m) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        if (!$this->isValid($m))
            $m = null;
        else {
            $id = $mu->insert($m->getName(), $m->getArtist(), $m->getAlbum(), $m->getDuration(), $m->getUpload());
            $m->setId($id);
        }
        return $m;
    }

    private function isValid(Music $m) {
        if ($m->getName()==null || $m->getArtist()==null || $m->getAlbum()==null || $m->getDuration()==null || $m->getUpload()==null)
            return false;
        else
            return true;
    }

    public function getMusic($id) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        $results = $mu->findBy($id);
        foreach ($results as $music) {
            $m = new Music($music[1],$music[2],$music[3],$music[4],$music[5]);
            $m->setId($music[0]);
            $m->setPRates($music[6]);
            $m->setNRates($music[7]);
            $m->setNeuRates($music[8]);
        }
        return $m;
    }

    public function deleteMusic($id) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        if ($mu->delete($id))
            return true;
        return false;
    }

    public function incrementPositive($music) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        $nb = $music->getPRates()+1;
        $mu->setRatePos($music->getId(),$nb);
    }

    public function incrementNegative($music) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        $nb = $music->getNRates()+1;
        $mu->setRateNeg($music->getId(),$nb);
    }

    public function incrementNeutral($music) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $mu = new MusicGateway($con);
        $nb = $music->getNeuRates()+1;
        $mu->setRateNeu($music->getId(),$nb);
    }
}