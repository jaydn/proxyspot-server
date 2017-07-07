<?php
    require_once('reuse/security.php');
    require_once('reuse/perusal_sesh.php');
    require_once('reuse/db.php');

    $batchcode = $_GET['b'];

    $owner = $cdb->OwnerOfBatchcode($batchcode) == $_SESSION['userid'];
    $public = $cdb->IsPublicBatchcode($batchcode);
    $used = $cdb->UsedBatchcode($batchcode);

    if(!$used || !($owner || $public)) {
        die('bad batch');
    }

    $san_batchcode = htmlspecialchars($batchcode);

    if($used) {
        if($public || $owner) {
            $stmt = $cdb->db->prepare('SELECT * FROM proxies WHERE batchcode=?');
            $stmt->execute([$batchcode]);
            foreach($stmt as $row) {
                echo $row['entryip'].':'.$row['entryport'];
            }
        }
    }
?>