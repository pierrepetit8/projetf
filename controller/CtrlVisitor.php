<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:39
 */
class CtrlVisitor
{

    function __construct($action) {
        global $views;
        try {
            switch($action) {
                case "login_view":
                    $this::loginView();
                    break;
                case "Log in":
                    $this::login();
                    break;
                case 'music_details':
                    $this::musicDetails();
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
            $dataViewError[] = "Unexpected error PDO";
            echo "$e";
            require($views['error']);
        }
        catch (Exception $e2) {
            $dataViewError[] = "Unexpected error (visitor)";
            require($views['error']);
        }
    }

    function login() {
        global $views;
        $validation = new Validate();
        $mdl_u = new MdlUser();
        $mdl_a = new MdlAdmin();
        $login = $validation->sanitizeVar($_GET['log'],'string');
        $password = $validation->sanitizeVar($_GET['pass'],'string');
        $account = $mdl_u->login($login,$password);
        if ($account!=null) {
            $_SESSION['log'] = $login;
            $_SESSION['online_state'] = 'user';
            $this->listMusic();
        }
        else {
            $account = $mdl_a->login($login,$password);
            if ($account!=null) {
                $_SESSION['log'] = $login;
                $_SESSION['online_state'] = 'admin';
                $this->listMusic();
            }
            else {
                $dataViewError[] = "Wrong login or password";
                require($views['error']);
            }
        }
    }

    function loginView() {
        global $views;
        require($views['login']);
    }

    function listMusic() {
        global $views;
        $mdl = new MdlMusic();
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