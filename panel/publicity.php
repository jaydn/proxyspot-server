<?php
    require_once('reuse/security.php');
    require_once('reuse/perusal_sesh.php');
    require_once('reuse/db.php');
    if($cdb->OwnerOfBatchcode($_GET['b']) == $_SESSION['userid']) {
        $cdb->TogglePublicity($_GET['b']);
        header('Location: batch.php?b='.$_GET['b']);
    }
?>