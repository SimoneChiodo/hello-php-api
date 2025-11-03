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

    <!-- Ricerca personaggio -->
    <?php echo '<form method="POST" class="text-center">
                  <input type="text" name="personaggioInput" placeholder="Cerca un personaggio..." value="' .htmlspecialchars($search) . '">
                  <button type="submit">Cerca</button>
                </form>'; ?>

    <!-- Linea di TEST, per vedere l'URL a cui è fatta la richiesta -->
    <!-- <?php
      echo '<p>' .htmlspecialchars($url) . '</p>'
    ?> -->
    
    <div class="grid">
      <?php if (!empty($characters) && is_array($characters)): ?> <!-- Se ci sono dei personaggi da mostrare -->
        <?php foreach ($characters as $char): ?> <!-- Per ogni personaggio creo una card -->
          <div class="card">
            <img src="<?= htmlspecialchars($char['image']) ?>" alt="<?= htmlspecialchars($char['name']) ?>">
            
            <div class="text-center">
              <div class="name"><?= htmlspecialchars($char['name']) ?></div>
              <div class="race"><?= htmlspecialchars($char['race']) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?> <!-- Se NON ci sono personaggi -->
        <div class="no-results text-center">
          <p>Nessun personaggio trovato! 😢</p>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
