<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../dbs/db.db');
    }
}

$db = new MyDB();

if (!$db) {
    die("Database connection failed: " . $db->lastErrorMsg());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO accounts (username, password) VALUES ('$username', '$password')";
    $ret = $db->exec($sql);
}
header("Location: ../cards.php");
exit;
?>