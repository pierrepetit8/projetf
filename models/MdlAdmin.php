<?php

/**
 * Created by PhpStorm.
 * User: hupiat
 * Date: 07/12/16
 * Time: 16:25
 */
class MdlAdmin
{
    public function login($login,$password) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $adm = new AdminGateway($con);
        if ($adm->find($login,$password)) {
            $a = new Admin($login,$password);
            return $a;
        }
        return null;
    }

    public static function isAdmin() {
        if (isset($_SESSION['online_state'])) {
            if ($_SESSION['online_state']=='admin')
                return true;
        }
        return false;
    }

}