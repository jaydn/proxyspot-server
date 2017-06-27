<?php
    require_once('reuse/security.php');
    require_once('reuse/db.php');

    $userid = $_SESSION['userid'];

    do {
        $batchcode = uniqid();
    } while($cdb->UsedBatchcode($batchcode));

    $cdb->AddBatchcode($batchcode, $userid);

    header("Location: batch.php?b=".$batchcode);
?>