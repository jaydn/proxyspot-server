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
                            readfile('reuse/login_form/valid_login.html');
                            break;
                        case 1:
                            readfile('reuse/login_form/bad_password.html');
                            readfile('reuse/login_form/login_form.html');
                            break;
                        default:
                            readfile('reuse/login_form/unk_error.html');
                            break;
                    }
                } else {
                    echo $twig->render('test.html', ['name' => 'Fabien']);
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>