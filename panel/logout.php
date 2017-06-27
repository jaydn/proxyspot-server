<?php
    require_once('reuse/perusal_sesh.php');
    $_SESSION = array();
    session_destroy();
    header('Location: /panel');
?>