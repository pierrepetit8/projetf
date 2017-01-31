<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:38
 */
class CtrlUser
{
    function __construct($action) {
        global $views;
        try {
            switch($action) {
                case 'logout':
                    $this::logout();
                    break;
                case 'music_details':
                    $this::musicDetails();
                    break;
                case 'vote_positive':
                    $this::votePositive();
                    break;
                case 'vote_negative':
                    $this::voteNegative();
                    break;
                case 'vote_neutral':
                    $this::voteNeutral();
                    break;
                case 'Post':
                    $this::postComment();
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
            $dataViewError[] = "Unexpected error (user)";
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

    function logout() {
        $_SESSION = array();
        session_destroy();
        $this->listMusic();
    }

    function listMusic() {
        global $views;
        $mdl = new MdlMusic;
        $results = $mdl->getAllMusics();
        require($views['home']);
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
}