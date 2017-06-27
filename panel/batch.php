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
                    echo '<p>'.htmlspecialchars($_GET['b']).'</p>';
                    if(!$cdb->UsedBatchcode($_GET['b'])) {
                        readfile('reuse/bad_batch.html');
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
                        if($cdb->UsedBatchcode($_GET['b'])) {
                            $stmt = $cdb->db->prepare('SELECT * FROM proxies WHERE batchcode=?');
                            $stmt->execute([$_GET['b']]);
                            foreach($stmt as $row) {
                                echo '<tr>'."\n";
                                echo '<td>'.$row['entryip'].'</td>'."\n";
                                echo '<td>'.$row['entryport'].'</td>'."\n";
                                echo '<td>'.$row['entrytype'].'</td>'."\n";
                                echo '<td>'.$row['exitip'].'</td>'."\n";
                                echo '</tr>'."\n";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
   </body>
</html>