<?php
    require_once('reuse/security.php');
    require_once('reuse/perusal_sesh.php');
    require_once('reuse/db.php');

    $username = $cdb->GetUsername($_SESSION['userid']);

    echo $twig->render("panel.html", ["username" => $username])
?>