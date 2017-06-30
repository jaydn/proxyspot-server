<?php
    require_once('reuse/security.php');
    require_once('reuse/perusal_sesh.php');
    require_once('reuse/db.php');
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        readfile('reuse/head.html');
    ?>
    
    <body>
        <div class="container">
            <?php
                readfile('reuse/banner.html');
            ?>
            <div class="row text-center">
                <p>
                <?php
                    $batchcode = $_GET['b'];

                    $owner = $cdb->OwnerOfBatchcode($batchcode) == $_SESSION['userid'];
                    $public = $cdb->IsPublicBatchcode($batchcode);
                    $used = $cdb->UsedBatchcode($batchcode);

                    if(!$used || !($owner || $public)) {
                        readfile('reuse/bad_batch.html');
                    }

                    $san_batchcode = htmlspecialchars($batchcode);
                    echo '<p>'.$san_batchcode.'</p>';
                    if($owner) {
                        echo '<a href="publicity.php?b='.$san_batchcode.'"><button>';
                        echo $public ? 'public' : 'private';
                        echo '</button></a>'."\n";
                    }
                ?>
                </p>
            </div>
            <br>
            <div class="row text-center">
                <table style="width:100%" class="table-bordered table-striped">
                    <thead>
                        <th>entry</th>
                        <th>port</th>
                        <th>type</th>
                        <th>exit</th>
                    </thead>
                    <tbody>
                        <?php
                        if($used) {
                            if($public || $owner) {
                                $stmt = $cdb->db->prepare('SELECT * FROM proxies WHERE batchcode=?');
                                $stmt->execute([$batchcode]);
                                foreach($stmt as $row) {
                                    $differentexit = (strcmp($row['exitip'], $row['entryip']) != 0);
                                    echo '<tr>'."\n";
                                    echo '<td>'.$row['entryip'].'</td>'."\n";
                                    echo '<td>'.$row['entryport'].'</td>'."\n";
                                    echo '<td>'.$row['entrytype'].'</td>'."\n";
                                    echo '<td>';
                                    if($differentexit) {
                                        echo '<span style="background-color:#FF8080;">';
                                    }
                                    echo $row['exitip'];
                                    if($differentexit) {
                                        echo '</span>';
                                    }
                                    echo '</td>'."\n";
                                    echo '</tr>'."\n";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
   </body>
</html>