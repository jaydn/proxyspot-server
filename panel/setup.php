<?php
    require_once('reuse/db.php');
    echo $cdb->db->exec('CREATE TABLE IF NOT EXISTS `batches` (`userid` int(11) NOT NULL, `batchcode` text NOT NULL, `closed` tinyint(1) DEFAULT NULL, `public` tinyint(1) NOT NULL);');
    echo $cdb->db->exec('CREATE TABLE IF NOT EXISTS `proxies` (`entryip` text NOT NULL, `entryport` text NOT NULL, `entrytype` text NOT NULL, `entrytime` text NOT NULL,`exitip` text NOT NULL,`exittime` text NOT NULL,`batchcode` text NOT NULL);');
    if($cdb->db->exec('CREATE TABLE IF NOT EXISTS `users` (`userid` int(11) NOT NULL, `username` text NOT NULL, `hashedpw` text NOT NULL, `salt` text NOT NULL);') != 0) {
        echo $cdb->db->exec('ALTER TABLE `users` ADD PRIMARY KEY (`userid`);');
    }
?>