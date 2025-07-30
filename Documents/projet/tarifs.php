<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tarifs - Repar'Tout</title>
  <meta name="description" content="Découvrez nos tarifs de réparation et montage informatique." />
  <link rel="icon" href="assets/images/logo_site.png" sizes="32x32" />
  <link rel="stylesheet" href="assets/styles/main.css" />
  <style>
    .tarifs-content {
      max-width: 700px;
      margin: 60px auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 16px #0002;
      padding: 40px 32px;
      font-family: 'Sora', Arial, sans-serif;
    }
    .tarifs-title {
      text-align: center;
      font-family: 'Space Mono', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      color: #8748af;
      margin-bottom: 32px;
      letter-spacing: 2px;
    }
    .tarifs-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 16px;
    }
    .tarifs-table th, .tarifs-table td {
      padding: 16px 18px;
      background: #f7f6ff;
      border-radius: 12px;
      font-size: 1.1rem;
      text-align: left;
    }
    .tarifs-table th {
      background: #5454d2;
      color: #fff;
      font-size: 1.15rem;
      font-weight: 700;
      letter-spacing: 1px;
      border-bottom: 2px solid #8748af;
    }
    .tarifs-table td.price {
      text-align: right;
      font-weight: 700;
      color: #8748af;
      font-family: 'Space Mono', monospace;
    }
    .tarifs-section-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: #5454d2;
      margin: 32px 0 16px 0;
      font-family: 'Space Mono', monospace;
      letter-spacing: 1px;
    }
    @media (max-width: 800px) {
      .tarifs-content {
        padding: 20px 5vw;
      }
      .tarifs-table th, .tarifs-table td {
        padding: 10px 8px;
        font-size: 1rem;
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
  <div class="tagline">Nos Tarifs</div>
  <main>
    <section class="tarifs-content">
      <div class="tarifs-title">Tarifs des Prestations</div>
      <div class="tarifs-section-title">PC Fixes</div>
      <table class="tarifs-table">
        <tr>
          <th>Prestation</th>
          <th class="price">Tarif</th>
        </tr>
        <tr>
          <td>Diagnostique + Entretien</td>
          <td class="price">39,99€</td>
        </tr>
        <tr>
          <td>Mémoire Vive / Ram</td>
          <td class="price">de 29,99€ à 89,99€</td>
        </tr>
        <tr>
          <td>Stockage</td>
          <td class="price">de 29,99€ à 74,99€</td>
        </tr>
      </table>
      <div class="tarifs-section-title">PC Portables</div>
      <table class="tarifs-table">
        <tr>
          <th>Prestation</th>
          <th class="price">Tarif</th>
        </tr>
        <tr>
          <td>Diagnostique + Entretien</td>
          <td class="price">49,99€</td>
        </tr>
        <tr>
          <td>Stockage</td>
          <td class="price">de 29,99€ à 74,99€</td>
        </tr>
        <tr>
          <td>Mémoire Vive / Ram DDR4</td>
          <td class="price">de 39,99€ à 49,99€</td>
        </tr>
        <tr>
          <td>Mémoire Vive / Ram DDR3</td>
          <td class="price">de 19,99€ à 39,99€</td>
        </tr>
      </table>
      <div class="tarifs-section-title">Prestations diverses</div>
      <table class="tarifs-table">
        <tr>
          <th>Prestation</th>
          <th class="price">Tarif</th>
        </tr>
        <tr>
          <td>DEVIS</td>
          <td class="price">GRATUIT</td>
        </tr>
        <tr>
          <td>Installation Windows</td>
          <td class="price">29,99€</td>
        </tr>
        <tr>
          <td>Installation Office</td>
          <td class="price">29,99€</td>
        </tr>
        <tr>
          <td>Installation Périphériques</td>
          <td class="price">29,99€</td>
        </tr>
      </table>
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
</body>
</html>