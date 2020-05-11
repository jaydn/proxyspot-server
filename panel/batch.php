<?php
require_once('reuse/security.php');
require_once('reuse/perusal_sesh.php');
require_once('reuse/db.php');

$batchcode = $_GET['b'];

$owner = $cdb->OwnerOfBatchcode($batchcode) == $_SESSION['userid'];
$public = $cdb->IsPublicBatchcode($batchcode);
$used = $cdb->UsedBatchcode($batchcode);

if (!$used || !($owner || $public)) {
    echo $twig->render("bad_batch.html");
}

if ($used) {
    if ($public || $owner) {
        $stmt = $cdb->db->prepare('SELECT * FROM proxies WHERE batchcode=?');
        $stmt->execute([$batchcode]);

        echo $twig->render("batch.html", [
            "batchcode" => $batchcode,
            "proxies" => $stmt,
            "publicState" => $public ? "public" : "private",
            "owner" => $owner,
        ]);
        /*foreach ($stmt as $row) {
            $differentexit = (strcmp($row['exitip'], $row['entryip']) != 0);
            echo '<tr>' . "\n";
            echo '<td>' . $row['entryip'] . '</td>' . "\n";
            echo '<td>' . $row['entryport'] . '</td>' . "\n";
            echo '<td>' . $row['entrytype'] . '</td>' . "\n";
            echo '<td>';
            if ($differentexit) {
                echo '<span style="background-color:#FF8080;">';
            }
            echo $row['exitip'];
            if ($differentexit) {
                echo '</span>';
            }
            echo '</td>' . "\n";
            echo '</tr>' . "\n";
        }*/
    }
}
?>