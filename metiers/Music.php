<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 30/11/16
 * Time: 16:57
 */
class Music
{
    private $id, $name, $artist, $album;
    private $duration, $upload;
    private $p_rates, $n_rates, $neu_rates;

    public function __construct($name,$artist,$album,$duration,$upload)
    {
        $this->name=$name;
        $this->artist=$artist;
        $this->album=$album;
        $this->duration=$duration;
        $this->upload=$upload;
        $this->p_rates=0;
        $this->n_rates=0;
        $this->neu_rates=0;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getAlbum() {
        return $this->album;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getUpload()
    {
        return $this->upload;
    }

    public function getNeuRates()
    {
        return $this->neu_rates;
    }

    public function getNRates()
    {
        return $this->n_rates;
    }

    public function getPRates()
    {
        return $this->p_rates;
    }

    public function setPRates($number) {
        $this->p_rates = $number;
    }

    public function setNeuRates($number) {
        $this->neu_rates = $number;
    }

    public function setNRates($number) {
        $this->n_rates = $number;
    }
}