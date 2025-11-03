<?php
  $search = $_POST['personaggioInput'] ?? '';

  $filter = !empty($search) ? $search : 'a';

  $url = "https://dragonball-api.com/api/characters?name=" . urlencode($filter);

  $response = @file_get_contents($url);
  $characters = [];

  if ($response !== false) {
    $data = json_decode($response, true);
    
    if (is_array($data)) {
      if (isset($data[0])) 
        $characters = $data;
      elseif (isset($data['data']) && is_array($data['data'])) 
        $characters = $data['data'];
    }
  }
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
