<?php
require_once('reuse/security.php');
require_once('reuse/perusal_sesh.php');
require_once('reuse/db.php');
?>
<?php
$stmt = $cdb->db->prepare('SELECT batchcode FROM batches WHERE userid=?');
$stmt->execute([$_SESSION['userid']]);

$batches = [];

foreach ($stmt as $row) {
    $batch = $row['batchcode'];
    //TODO: this is pretty filthy lol
    //TODO: 3 years later and this is still pretty filthy
    $stmt = $cdb->db->prepare('SELECT batchcode FROM proxies WHERE batchcode=?');
    $stmt->execute([$batch]);
    $size = $stmt->rowCount();
    array_push($batches, ["code" => $batch, "size" => $size]);
}

echo $twig->render("history.html", ["batches" => $batches]);
?>