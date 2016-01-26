<?php
/**
 * Created by PhpStorm.
 * User: Evert
 * Date: 26-Jan-16
 * Time: 18:39
 */
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'udb');
define('DB_USER', 'root');
define('DB_PASS', '');
try {
    $dbh = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
