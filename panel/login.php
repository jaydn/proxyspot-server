<?php
require_once('reuse/perusal_sesh.php');
require_once('reuse/login_funcs.php');
if (isset($_SESSION['userid'])) {
    header('Location: panel.php');
}
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
            <div class="jumbotron">
                <?php
                $login = new CLogin();
                if ($login->IsLoginAttempt()) {
                    switch ($login->Login($_POST['u'], $_POST['p'])) {
                        case 0:
                            echo $twig->render('login.html');
                            break;
                        case 1:
                            echo $twig->render('login.html', ['errors' => ['Username or password invalid.']]);
                            break;
                        case 2:
                            echo $twig->render('login.html', ['errors' => ['An unknown error has occurred.']]);
                            break;
                    }
                } else {
                    echo $twig->render('login.html');
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>