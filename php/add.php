<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../dbs/database.db');
    }
}

$db = new MyDB();

if (!$db) {
    die("Database connection failed: " . $db->lastErrorMsg());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $datum = $_POST['datum'];
    $url = $_POST['url'];
    $image = $_POST['image'];
    $category = strtolower($_POST['category']);
    $id = rand(1, 100000);

    $sql = "INSERT INTO Projecten (title, desc, datum, url, image, category, id) VALUES ('$title', '$desc', '$datum', '$url', '$image', '$category', '$id')";

    $ret = $db->exec($sql);

}
header("Location: 'https://89987.stu.sd-lab.nl/pages/admin.php'; Refresh:0; ");
exit;
?>