<!DOCTYPE HTML>
<html lang="fr">

<?php

session_start();
require_once('config/config.php');
require_once('config/Autoload.php');
require_once('config/Validate.php');
require_once('controller/CtrlFront.php');
require_once('controller/CtrlAdmin.php');
require_once('controller/CtrlUser.php');
require_once('controller/CtrlVisitor.php');
require_once('models/MdlMusic.php');
require_once('models/MdlAdmin.php');
require_once('models/MdlUser.php');
require_once('models/MdlComment.php');
require_once('DAL/Connection.php');
require_once('DAL/MusicGateway.php');
require_once('DAL/UserGateway.php');
require_once('DAL/CommentGateway.php');
require_once('DAL/AdminGateway.php');
require_once('metiers/Admin.php');
require_once('metiers/Music.php');
require_once('metiers/User.php');
require_once('metiers/Comment.php');

Autoload::charger();

new CtrlFront();

?>

</html>
