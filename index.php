<?php
  $url = "https://dragonball-api.com/api/characters"; // URL dell'API
  $response = file_get_contents($url); // Fa la chiamata HTTP (come “fetch” in JavaScript).
  $data = json_decode($response, true); // Converte il JSON in un array
  $characters = $data["items"]; // Estraggo dall'array i personaggi
?>

<!DOCTYPE html>
<html lang="it">
  <head>
      <meta charset="UTF-8">
      <title>DragonBall Heroes Viewer</title>

      <!-- Custom CSS -->
      <link rel="stylesheet" href="style.css"></link>
    </head>
  <body>
    <h1>Personaggi di Dragon Ball</h1>

    <div class="grid">
      <?php foreach ($characters as $char): ?> <!--  Creo una card per ogni personaggio -->
        <div class="card">
          <img src="<?= htmlspecialchars($char['image']) ?>" alt="<?= htmlspecialchars($char['name']) ?>">
          
          <div class="text-center">
            <div class="name"><?= htmlspecialchars($char['name']) ?></div>
            <div class="race"><?= htmlspecialchars($char['race']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </body>
</html>
