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

  <script src="js/cart.js"></script>

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/card.css" />
</head>

<body>
  <main class="column">
    <nav>
      <a href="index.html"><nav-button>Home</nav-button> </a>
      <a href="cards.php"><nav-button>Cards</nav-button></a>
      <img id="logo" src="media/logo.svg" />
      <nav-button>Contact</nav-button>
      <nav-button>Cart</nav-button>
    </nav>

    <card-view>
      <?php
      class MyDB extends SQLite3
      {
        function __construct()
        {
          $this->open('dbs/db.db');
        }
      }

      $sql = <<<EOF
        SELECT * from products WHERE id={$_GET['id']};
        EOF;

      $db = new MyDB();

      $ret = $db->query($sql);
      while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {

        echo "<row>";
        echo "<column>";

        echo "<img src='media/{$row['image']}'>";

        echo "</column>";

        echo "<column>";

        echo "<div class='name'>{$row['name']}</div>";
        echo "<div class='set'>Set {$row['set']}</div>";
        if ($row['language'] == "en") {
          echo "<img loading='lazy' class='flag' src='media/flag.svg'>";
        }
        echo "<div class='price'>€{$row['price']}</div>";
        echo "<div class='desc'>{$row['desc']}</div>";
        echo "<button onclick='addToCart(\"{$_GET['id']}\");'>Add to cart</button>";

        echo "</column>";
        echo "</row>";

      }
      $db->close();
      ?>
    </card-view>

    <footer class="absolute">
      © 2023 <a target="_blank" href="https://djay.nl/">Djay.nl</a>, All
      rights reserved.
    </footer>
  </main>
</body>

</html>