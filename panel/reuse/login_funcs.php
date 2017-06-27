<?php
    require_once('perusal_sesh.php');
    class CLogin {
        function IsLoginAttempt() {
            return (isset($_POST['u']) && isset($_POST['p']));
        }

        function Login($username, $password) {
            require_once('db.php');
            $user = null;
            try {
                $stmt = $cdb->db->prepare('SELECT userid,hashedpw,salt FROM users WHERE username=?');
                $stmt->execute([$username,]);
                $user = $stmt->fetch();
            }catch(PDOException $e){
                return 2;
            }
            if($user == null) { 
                return 1;
            }
            if(!strcmp($user["hashedpw"], md5($password . $user["salt"]))) {
                $_SESSION['userid'] = $user['userid'];
                return 0;
            }
            return 1;
        }
    }
?>