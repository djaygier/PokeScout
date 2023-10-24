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
    $items = $_POST['items'];
    $sql = "INSERT INTO bestellingen (items) VALUES ('$items')";
    $ret = $db->exec($sql);



}
header("Location: ../cart.html");
exit;
?>