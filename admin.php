<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PokeScout | Cards</title>

  <link rel="icon" href="media/logo.svg" type="image/svg+xml" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <script src="js/cards.js"></script>
  <script src="js/index.js"></script>

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/cards.css" />
</head>

<body onload="setNewCount(); checkLoginStatus();">
  <main class="column">
    <nav>
      <a href="index.html"><nav-button>Home</nav-button> </a>
      <a href="cards.php"><nav-button>Cards</nav-button></a>
      <img id="logo" src="media/logo.svg" />
      <a href="contact.html"><nav-button>Contact</nav-button></a>
      <a href="cart.html"><nav-button>Cart<count></count></nav-button></a>
    </nav>

    <form action="php/add_product.php" method="post" id="admin-form">
      <input type="text" name="name" placeholder="Naam" />
      <input type="number" name="price" placeholder="Prijs" />
      <input type="text" name="image" placeholder="Image URL" />
      <input type="text" name="language" placeholder="Taal" />
      <input type="text" name="collection" placeholder="Collection" />
      <input type="text" name="desc" placeholder="Desc" />
      <input type="submit" value="Voeg toe">
    </form>

    <cards>
      <?php
      class MyDB extends SQLite3
      {
        function __construct()
        {
          $this->open('dbs/db.db');
        }
      }

      $sql = <<<EOF
        SELECT * from products;
        EOF;

      $db = new MyDB();

      $ret = $db->query($sql);
      while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        echo "<card onclick='document.location = \"card.php?id={$row['id']}\";'>";
        echo "<img loading='lazy' src='{$row['image']}'>";
        echo "<row>";
        echo "<div class='name'>{$row['name']}</div>";
        echo "<div class='set'>Set {$row['collection']}</div>";
        echo "</row>";
        echo "<row>";

        echo "<div class='price'>€{$row['price']}</div>";
        if ($row['language'] == "en") {
          echo "<img loading='lazy' class='flag' src='media/flag.svg'>";
        }
        echo "</row>";
        echo "</card>";
      }
      $db->close();
      ?>
    </cards>

    <footer class="relative">
      © 2023 <a target="_blank" href="https://djay.nl/">Djay.nl</a>, All
      rights reserved.
    </footer>
  </main>
</body>

</html>