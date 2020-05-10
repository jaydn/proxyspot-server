<?php
require_once('reuse/perusal_sesh.php');
require_once('reuse/login_funcs.php');
if (isset($_SESSION['userid'])) {
    header('Location: panel.php');
    die();
}
?>
<?php
$login = new CLogin();
if ($login->IsLoginAttempt()) {
    switch ($login->Login($_POST['u'], $_POST['p'])) {
        case 0:
            header('Location: panel.php');
            die();
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