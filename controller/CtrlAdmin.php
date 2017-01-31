<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:39
 */
class CtrlAdmin
{
    function __construct($action) {
        global $views;
        try {
          switch ($action) {
              case 'vote_positive':
                  $this::votePositive();
                  break;
              case 'vote_negative':
                  $this::voteNegative();
                  break;
              case 'vote_neutral':
                  $this::voteNeutral();
                  break;
              case 'add_music':
                  $this::addMusic();
                  break;
              case 'logout':
                  $this::logout();
                  break;
              case 'Add song':
                  $this::addSong();
                  break;
              case 'music_details':
                  $this::musicDetails();
                  break;
              case 'delete_music':
                  $this::delete_music();
                  break;
              case 'Post':
                  $this::postComment();
                  break;
              case 'delete_comment':
                  $this::delete_comment();
                  break;
              case null:
                  $this::listMusic();
                  break;
              default:
                  $dataViewError[] = "Unknowned request";
                  break;
          }
        }
        catch (PDOException $e) {
            $dataViewError[] = "Unexpected Error PDO";
            require($views['error']);
        }
        catch (Exception $e2) {
            $dataViewError[] = "Unexpected error (admin)";
            require($views['error']);
        }
    }

    function delete_comment() {
        global $views;
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_comment'],'int');
        $mdl = new MdlComment();
        if ($mdl->deleteComment($id))
            $this->listMusic();
        else {
            $dataViewError[] = 'Database error: comment impossible to delete';
            require($views['error']);
        }
    }

    function postComment() {
        $mdl = new MdlComment();
        $validation = new Validate();
        $id = $validation->sanitizeVar($_SESSION['id_music'],'int');
        $text = $validation->sanitizeVar($_GET['comment'],'string');
        if ($text!=null) {
            $comment = new Comment($text,$id);
            $mdl->addComment($comment);
        }
        $this->listMusic();
    }

    function addSong() {
        global $views;
        $validation = new Validate();
        $name = $validation->sanitizeVar($_GET['name'],'string');
        $artist = $validation->sanitizeVar($_GET['artist'],'string');
        $album = $validation->sanitizeVar($_GET['album'],'string');
        $duration = $validation->sanitizeVar($_GET['duration'],'int');
        $upload = $_GET['upload'];
        $mdl_m = new MdlMusic();
        $m = new Music($name,$artist,$album,$duration,$upload);
        $m = $mdl_m->addMusic($m);
        if ($m==null) {
            $dataViewError[] = 'All the fields are required';
            require($views['error']);
        }
        else
            $this->listMusic();
    }

    function delete_music() {
        global $views;
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_music'],'int');
        $mdl = new MdlMusic();
        if ($mdl->deleteMusic($id))
            $this->listMusic();
        else {
            $dataViewError[] = 'Database error: music impossible to delete';
            require($views['error']);
        }
    }

    function addMusic() {
        global $views;
        require($views['add']);
    }

    function listMusic() {
        global $views;
        $mdl = new MdlMusic;
        $results = $mdl->getAllMusics();
        require($views['home']);
    }

    function logout() {
        global $views;
        $_SESSION = array();
        session_destroy();
        $this->listMusic();
    }

    function musicDetails() {
        global $views;
        $mdl_m = new MdlMusic();
        $mdl_c = new MdlComment();
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_music'],'int');
        $results_comments = $mdl_c->getAllComments($id);
        $music = $mdl_m->getMusic($id);
        if ($music==null) {
            $dataViewError[] = 'Database error: id music not found';
            require ($views['error']);
        }
        else
            require($views['details']);
    }

    function voteNegative() {
        global $views;
        $mdl = new MdlMusic();
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_music'],'int');
        $music = $mdl->getMusic($id);
        if ($music==null) {
            $dataViewError[] = 'Database error: id music not found';
            require ($views['error']);
        }
        $mdl->incrementNegative($music);
        $this->listMusic();
    }

    function voteNeutral() {
        global $views;
        $mdl = new MdlMusic();
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_music'],'int');
        $music = $mdl->getMusic($id);
        if ($music==null) {
            $dataViewError[] = 'Database error: id music not found';
            require ($views['error']);
        }
        $mdl->incrementNeutral($music);
        $this->listMusic();
    }

    function votePositive() {
        global $views;
        $mdl = new MdlMusic();
        $validation = new Validate();
        $id = $validation->sanitizeVar($_GET['id_music'],'int');
        $music = $mdl->getMusic($id);
        if ($music==null) {
            $dataViewError[] = 'Database error: id music not found';
            require ($views['error']);
        }
        $mdl->incrementPositive($music);
        $this->listMusic();
    }
}