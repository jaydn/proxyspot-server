<?php
require_once("config.php");

class CPerusalDb {
    function __construct() {
        $dsn = "mysql:host=".PERUSAL_MYSQL_HOST.
        ";dbname=".PERUSAL_MYSQL_DB.
        ";charset=".PERUSAL_MYSQL_CHARSET.
        ";port=".PERUSAL_MYSQL_PORT;

        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->db = new PDO($dsn, PERUSAL_MYSQL_USER, PERUSAL_MYSQL_PASS, $opt);
    }


    
    function AddBatchcode($batchcode, $userid) {
        $this->db->prepare('INSERT INTO batches(batchcode, userid, public) VALUES (?, ?, 0)')->execute([$batchcode, $userid]);
    }

    function UsedBatchcode($batchcode) {
        $stmt = $this->db->prepare('SELECT userid FROM batches WHERE batchcode=?');
        $stmt->execute([$batchcode]);
        return $stmt->rowCount() != 0;
    }
    

    function OwnerOfBatchcode($batchcode) {
        $stmt = $this->db->prepare('SELECT userid FROM batches WHERE batchcode=?');
        $stmt->execute([$batchcode]);
        return $stmt->fetch()['userid'];
    }

    function IsPublicBatchcode($batchcode) {
        $stmt = $this->db->prepare('SELECT public FROM batches WHERE batchcode=?');
        $stmt->execute([$batchcode]);
        return $stmt->fetch()['public'];
    }

    function TogglePublicity($batchcode) {
        return $this->db->prepare('UPDATE batches SET public = !public WHERE batchcode=?')->execute([$batchcode]);
    }

    function GetUsername($userid) {
        $stmt = $this->db->prepare('SELECT username FROM users WHERE userid=?');
        $stmt->execute([$userid]);
        return $stmt->fetch()["username"];
    }

    function HasUser() {
        $stmt = $this->db->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->rowCount() != 0;
    }
}

$cdb = new CPerusalDb();
?>