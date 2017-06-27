# perusal
## version: 2 (prev. animus)

* flexible
* full login system
* light on resources

## asynchronous, in a sense
fire off as many requests as you can with the python client and let the server handle them as they come in. you could run millions through this system with the same memory consumption since all the hard work is done by the backend.

## light
no insane dependencies. should run on vanilla php with the pdo thing.

## i'm pretty bad at php
if things are broken i wouldn't be surprised.
the password hashing is barely safe, and certainly would not hold up to an attacker.

## here's how to create the database
### i'll add a setup script later™
    CREATE TABLE `batches` (`userid` int(11) NOT NULL, `batchcode` text NOT NULL, `closed` tinyint(1) DEFAULT NULL);

    CREATE TABLE `proxies` (`entryip` text NOT NULL, `entryport` text NOT NULL, `entrytype` text NOT NULL, `entrytime` text NOT NULL,`exitip` text NOT NULL, `exittime` text NOT NULL, `batchcode` text NOT NULL);
    
    CREATE TABLE `users` (`userid` int(11) NOT NULL, `username` text NOT NULL, `hashedpw` text NOT NULL, `salt` text NOT NULL);
    ALTER TABLE `users` ADD PRIMARY KEY (`userid`);
    ALTER TABLE `users` MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT AUTO_INCREMENT=2;