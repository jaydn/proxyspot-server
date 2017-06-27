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
            <br>
            <div class="row">
                <h4 class="text-center">welcome, <?php echo $cdb->GetUsername($_SESSION['userid']); ?></h4>
            </div>
            <br>
            <div class="row text-center">
                <table class="table-bordered table-striped" style="width:100%;">
                    <thead>
                        <th>batchcode</th>
                        <th>size</th>
                        <th>view</th>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = $cdb->db->prepare('SELECT batchcode FROM batches WHERE userid=?');
                            $stmt->execute([$_SESSION['userid']]);
                            foreach($stmt as $row) {
                                echo '<tr>'."\n";
                                echo '<td>'.$row['batchcode'].'</td>'."\n";
                                //TODO: this is pretty filthy lol
                                $stmt = $cdb->db->prepare('SELECT batchcode FROM proxies WHERE batchcode=?');
                                $stmt->execute([$row['batchcode']]);
                                echo '<td>'.$stmt->rowCount().'</td>';
                                echo '<td><a href="batch.php?b='.$row['batchcode'].'">view</a></td>'."\n";
                                echo '</tr>'."\n";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
   </body>
</html>