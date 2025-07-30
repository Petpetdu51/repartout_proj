<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Commande - Repar'Tout</title>
  <meta name="description" content="Passez votre commande de réparation ou montage informatique." />
  <link rel="icon" href="assets/images/logo_site.png" sizes="32x32" />
  <link rel="stylesheet" href="assets/styles/main.css" />
  <style>
    .commande-content {
      max-width: 700px;
      margin: 60px auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 16px #0002;
      padding: 40px 32px;
      font-family: 'Sora', Arial, sans-serif;
    }
    .commande-title {
      text-align: center;
      font-family: 'Space Mono', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      color: #8748af;
      margin-bottom: 32px;
      letter-spacing: 2px;
    }
    .commande-form label {
      display: block;
      font-weight: 700;
      color: #5454d2;
      margin-bottom: 8px;
      font-family: 'Space Mono', monospace;
      letter-spacing: 1px;
    }
    
    .commande-form input,
    .commande-form select,
    .commande-form textarea {
        width: calc(100% - 4px);
        box-sizing: border-box;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid #c5b4d9;
        border-radius: 12px;
        font-size: 1.1rem;
        font-family: 'Sora', Arial, sans-serif;
        background: #f7f6ff;
        transition: border 0.2s;
    }
    .commande-form input:focus,
    .commande-form select:focus,
    .commande-form textarea:focus {
      border-color: #8748af;
      outline: none;
    }
    .commande-form button {
      display: block;
      width: 100%;
      background: #5454d2;
      color: #fff;
      font-weight: 700;
      padding: 14px 0;
      border-radius: 100px;
      border: none;
      font-size: 1.1rem;
      font-family: 'Space Mono', monospace;
      cursor: pointer;
      transition: background 0.2s;
      margin-top: 12px;
    }
    .commande-form button:hover {
      background: #8748af;
    }
    @media (max-width: 800px) {
      .commande-content {
        padding: 20px 5vw;
      }
      .commande-title {
        font-size: 1.5rem;
      }
      .commande-form input,
      .commande-form select,
      .commande-form textarea {
        font-size: 1rem;
        padding: 10px 8px;
      }
    }
  </style>
</head>
<body>
  <div class="header-spacer"></div>
  <header>
    <div class="logo-title">
      <a href="index.php">
        <img src="assets/images/logo_site.png" alt="Repar'Tout Logo">
      </a>
      <a href="index.php" class="site-title">Repar'Tout</a>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="tarifs.php">Tarifs</a></li>
        <li><a href="commande.php">Commande</a></li>
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="abonnement.php">Abonnement</a></li>
      </ul>
    </nav>
    <!-- header identique avec la vérification $_SESSION['loggedin'] -->
    <nav>
      <ul>
        <?php if (!empty($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
          <li><a href="compte.php" class="btn-profile"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
          <li><a href="logout.php" class="btn-logout">Déconnexion</a></li>
        <?php else: ?>
          <li><a href="login.php" class="btn-login">Se connecter</a></li>
          <li><a href="register.php" class="btn-signup">S'inscrire</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <div class="tagline">Passez votre commande</div>
  <main>
    <section class="commande-content">
      <div class="commande-title">Formulaire de Commande</div>
      <form class="commande-form" action="traitement_commande.php" method="POST">
        <label for="nom">Nom complet</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" required>

        <label for="telephone">Téléphone</label>
        <input type="tel" id="telephone" name="telephone">

        <label for="type-prestation">Type de prestation</label>
        <select id="type-prestation" name="type-prestation" required>
          <option value="">Sélectionnez...</option>
          <option value="pc-fixe">PC Fixe</option>
          <option value="pc-portable">PC Portable</option>
          <option value="console">Console</option>
          <option value="autre">Autre</option>
        </select>

        <label for="details">Détails de la demande</label>
        <textarea id="details" name="details" rows="5" placeholder="Décrivez votre besoin..." required></textarea>

        <button type="submit">Envoyer la commande</button>
      </form>
    </section>
  </main>
  <section class="contact-section">
    <img src="assets/images/logo_site.png" alt="Logo Repar'Tout">
    <h1>Repar'Tout</h1>
    <p>Réparation / Montage / Matériel Informatique</p>
    <div class="contact-buttons">
      <a href="mailto:contact.repartout@gmail.com">contact.repartout@gmail.com</a>
      <a href="tel:0604167355">06.04.16.73.55</a>
      <a href="https://www.instagram.com/repartout51/" target="_blank" rel="noopener">INSTA: repartout51</a>
    </div>
  </section>

  <script>
window.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const type = params.get('type');
  if(type) {
    const select = document.getElementById('type-prestation');
    if(select) {
      for(let option of select.options) {
        if(option.value === type) {
          option.selected = true;
        }
      }
    }
  }
});
</script>

</body>
</html>