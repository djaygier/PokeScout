<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../dbs/db.db');
    }
}

$sql = <<<EOF
        SELECT * from accounts;
        EOF;

$db = new MyDB();

$loggedIn = False;

$ret = $db->query($sql);
while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    if ($row['username'] == $_POST['username']) {
        if ($row['password'] == $_POST['password']) {
            $loggedIn = True;
        }
    }
}

if ($loggedIn) {
    header("Location: ../admin.php");
} else {
    header("Location: ../cards.php");
}

$db->close();
exit;

?>