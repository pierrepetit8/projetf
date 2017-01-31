<?php

/**
 * Created by PhpStorm.
 * User: hpiat
 * Date: 14/12/2016
 * Time: 10:21
 */
class CtrlFront
{
    function __construct()
    {
        global $views;
        if(isset($_REQUEST['sub']))
            $action = $_REQUEST['sub'];
        else
            $action = null;
        if (isset($_SESSION['online_state']))
            $online_state = $_SESSION['online_state'];
        else
            $online_state = null;
        try {
            switch ($online_state) {
                case 'user':
                    new CtrlUser($action);
                    break;
                case 'admin':
                    new CtrlAdmin($action);
                    break;
                case null:
                    new CtrlVisitor($action);
                    break;
                default:
                    $dataViewError[] = "Session error";
                    require($views['error']);
            }
        }
        catch (PDOException $e) {
            $dataViewError[] = "Unexpected error front";
            require($views['error']);
        }
        catch (Exception $e2) {
            $dataViewError[] = "Unexpected error front";
            require($views['error']);
        }
    }

}