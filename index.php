<?php
  // Input dell'utente
  $search = $_POST['personaggioInput'] ?? '';
  $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

  // Costruzione dell'URL
  if (empty($search)) // Se l'utente NON ha cercato un personaggio
    $url = "https://dragonball-api.com/api/characters?limit=16&page=" . $page;
  else // Se l'utente ha cercato un personaggio
    $url = "https://dragonball-api.com/api/characters?name=" . urlencode($search);

  // Chiamata API
  $response = @file_get_contents($url);
  $characters = [];
  $maxPages = 1;

  // Risposta API
  if ($response !== false) { 
    $data = json_decode($response, true); 
    
    if (is_array($data)) { // Se la risposta è un array
      if (isset($data['items'])) // Array di personaggi
        $characters = $data['items'];
        if (isset($data['meta']['totalPages'])) // Salva le pagine totali
          $maxPages = (int)$data['meta']['totalPages'];
      elseif (isset($data[0])) // Singolo personaggio
        $characters = $data;
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
                  <input type="search" name="personaggioInput" placeholder="Cerca un personaggio..." value="' .htmlspecialchars($search) . '">
                  <button type="submit">Cerca</button>
                </form>'; ?>

    <!-- Linea di TEST, per vedere l'URL a cui è fatta la richiesta -->
    <!-- <?php
      echo '<p>' .htmlspecialchars($url) . '</p>'
    ?> -->

    <!-- Navigazione tra pagine -->
    <?php if (empty($search)): ?> <!-- Mostra la paginazione solo quando NON si cerca un personaggio specifico -->
      <form method="POST" class="text-center mt-2">
        <button type="submit" class="button" name="page" value="<?= max(1, $page - 1) ?>" <?= ($page <= 1) ? 'disabled' : '' ?>>
          ⬅️ Precedente
        </button>

        <span class="mx-2">Pagina <?= $page ?> di <?= $maxPages ?></span>
        
        <button type="submit" class="button" name="page" value="<?= min($maxPages, $page + 1) ?>" <?= ($page >= $maxPages) ? 'disabled' : '' ?>>
          Successiva ➡️
        </button>
      </form>
    <?php endif; ?>
    
    <!-- Griglia dei personaggi -->
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


    <!-- Codice per vedere la risposta API in console -->
    <!-- <script>
      // Trasformo l'array PHP in JSON leggibile da JS
      const characters = <?= json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>;
      
      console.table(characters); // Stampa come tabella nella console
    </script> -->
  </body>
</html>
