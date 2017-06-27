<?php
    require_once('reuse/perusal_sesh.php');
    if(isset($_SESSION['userid'])) {
        header('Location: panel.php');
    } else {
        header('Location: login.php');
    }
?>
