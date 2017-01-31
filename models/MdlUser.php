<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:23
 */
class MdlUser
{
    public function login($login,$password) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $use = new UserGateway($con);
        if ($use->find($login,$password)) {
            $u = new User($login,$password);
            return $u;
        }
        return null;
    }

    public static function isUser() {
        if (isset($_SESSION['online_state'])) {
            if ($_SESSION['online_state']=='user')
                return true;
        }
        return false;
    }
}