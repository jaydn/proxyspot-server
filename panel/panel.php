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
                <div class="col-xs-12 col-sm-4">
                    <a href="newbatch.php"><button class="btn btn-primary">Create Batch</button></a>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <a href="history.php"><button class="btn btn-primary">View History</button></a>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <a href="logout.php"><button class="btn btn-primary">Log Out</button></a>
                </div>
                
            </div>
        </div>
   </body>
</html>