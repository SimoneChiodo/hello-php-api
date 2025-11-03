# Progetto PHP: Hello PHP API

## 📖 Descrizione
**Hello PHP API** è una **mini web app** sviluppata in **PHP** che utilizza la **[Dragon Ball API](https://web.dragonball-api.com/)** per mostrare i personaggi della celebre saga.  

L’applicazione visualizza una **griglia di personaggi** con immagine, nome e razza, permettendo inoltre di effettuare ricerche dinamiche per nome e di navigare tra più pagine di risultati.


## 🎯 Obiettivo
Questo progetto nasce come esercizio introduttivo per apprendere i concetti fondamentali di **PHP lato server** e l’interazione con **API REST**.  
L’obiettivo è comprendere come:
- Inviare **richieste HTTP** a un servizio esterno.  
- Gestire l’input utente tramite form HTML e metodo `POST`.  
- Elaborare e visualizzare **dati JSON** provenienti da un’API.  
- Implementare una semplice **paginazione** e **ricerca dinamica**.  
- Strutturare un flusso completo: richiesta → elaborazione → risposta visuale.  


## 🌍 Funzionalità principali
- **Ricerca**  
  L’utente può cercare un personaggio inserendo il nome nel campo di testo.  
  Il backend costruisce automaticamente l’URL per la chiamata API.  
- **Chiamata API**  
  La comunicazione con il servizio remoto avviene tramite `file_get_contents()`, che recupera i dati in formato JSON.  
  Il contenuto viene poi decodificato e trasformato in un array PHP per essere elaborato e mostrato in pagina.  
- **Paginazione**
  Quando non è attiva una ricerca specifica, la pagina mostra 16 personaggi per volta, consentendo di spostarsi avanti e indietro tra i risultati tramite semplici pulsanti di navigazione.  
- **Gestione errori e fallback**
  Se la chiamata API non restituisce dati validi o va in errore, il sistema mostra un messaggio di fallback.  
  Questo assicura una buona esperienza utente anche in caso di errori di rete o risultati vuoti.  


## 🛠️ Tecnologie utilizzate
- **PHP** → linguaggio server-side per richieste API e gestione logica dei dati.  
- **HTML e CSS** → struttura e presentazione della pagina web.  
- **[Dragon Ball API](https://web.dragonball-api.com/)** → sorgente dati pubblica utilizzata per ottenere le informazioni sui personaggi.  
