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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $language = $_POST['language'];
    $collection = $_POST['collection'];
    $desc = $_POST['desc'];
    $id = rand(1231, 4234234234);
    $sql = "INSERT INTO products (name, price, image, language, collection, id, desc) VALUES ('$name', '$price', '$image', '$language', '$collection', '$id', '$desc')";
    $ret = $db->exec($sql);
}
header("Location: ../cards.php");
exit;
?>