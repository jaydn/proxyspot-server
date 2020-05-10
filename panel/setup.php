<?php
    require_once('reuse/db.php');
    echo $cdb->db->exec('CREATE TABLE IF NOT EXISTS `batches` (`userid` int(11) NOT NULL, `batchcode` text NOT NULL, `closed` tinyint(1) DEFAULT NULL, `public` tinyint(1) NOT NULL);');
    echo $cdb->db->exec('CREATE TABLE IF NOT EXISTS `proxies` (`entryip` text NOT NULL, `entryport` text NOT NULL, `entrytype` text NOT NULL, `entrytime` text NOT NULL,`exitip` text NOT NULL,`exittime` text NOT NULL,`batchcode` text NOT NULL);');
    echo $cdb->db->exec('CREATE TABLE IF NOT EXISTS `users` (`userid` int(11) NOT NULL, `username` text NOT NULL, `hashedpw` text NOT NULL);');
    try {
        echo $cdb->db->exec('ALTER TABLE users MODIFY COLUMN userid INT auto_increment PRIMARY KEY;'); 
    } catch(Exception $e) {
        echo 'Error creating primary key probably already exists';
        echo $e->getMessage();
    }

    $hashedpw = password_hash($_GET['p'], PASSWORD_DEFAULT);
    $stmt = $cdb->db->prepare('INSERT INTO users(username,hashedpw) VALUES (?,?)');
    $stmt->execute([$_GET['u'], $hashedpw]);
?>