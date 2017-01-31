<?php

/**
 * Created by PhpStorm.
 * User: hpiat
 * Date: 09/01/2017
 * Time: 12:22
 */
class Comment
{
    private $id, $id_music;
    private $text;

    public function __construct($text,$id_music)
    {
        $this->text = $text;
        $this->id_music = $id_music;
    }

    public function getText() {
        return $this->text;
    }

    public function getIdMusic() {
        return $this->id_music;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}