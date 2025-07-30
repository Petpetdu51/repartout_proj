<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Boutique - Repar'Tout</title>
  <meta name="description" content="Découvrez la boutique Repar'Tout : PC, accessoires et consoles." />
  <link rel="icon" href="assets/images/logo_site.png" sizes="32x32" />
  <link rel="stylesheet" href="assets/styles/main.css" />
  <style>
    .boutique-content {
      max-width: 1100px;
      margin: 60px auto;
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 2px 16px #0002;
      padding: 48px 32px;
      font-family: 'Sora', Arial, sans-serif;
    }
    .boutique-title {
      text-align: center;
      font-family: 'Space Mono', monospace;
      font-size: 2.5rem;
      font-weight: 900;
      color: #8748af;
      margin-bottom: 40px;
      letter-spacing: 2px;
    }
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 36px;
      margin-bottom: 40px;
    }
    .product-card {
      background: #f7f6ff;
      border-radius: 20px;
      box-shadow: 0 2px 8px #0001;
      padding: 28px 20px;
      text-align: center;
      transition: transform 0.2s, box-shadow 0.2s;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }
    .product-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 8px 24px #8748af22;
    }
    .product-img {
      width: 100px;
      height: 100px;
      object-fit: contain;
      margin-bottom: 18px;
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 2px 8px #0001;
    }
    .product-name {
      font-family: 'Space Mono', monospace;
      font-size: 1.25rem;
      font-weight: 700;
      color: #5454d2;
      margin-bottom: 8px;
    }
    .product-desc {
      font-size: 1rem;
      color: #0b303b;
      margin-bottom: 16px;
      min-height: 40px;
    }
    .product-price {
      font-size: 1.15rem;
      font-weight: 700;
      color: #8748af;
      margin-bottom: 18px;
      font-family: 'Space Mono', monospace;
    }
    .product-btn {
      display: inline-block;
      background: #5454d2;
      color: #fff;
      font-weight: 700;
      padding: 12px 32px;
      border-radius: 100px;
      text-decoration: none;
      font-size: 1rem;
      transition: background 0.2s;
      margin-top: auto;
    }
    .product-btn:hover {
      background: #ff9c61;
      color: #fff;
    }
    @media (max-width: 900px) {
      .boutique-content {
        padding: 20px 5vw;
      }
      .boutique-title {
        font-size: 1.5rem;
      }
      .products-grid {
        gap: 20px;
      }
      .product-card {
        padding: 18px 8px;
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
  <div class="tagline">Découvrez notre sélection de produits</div>
  <main>
    <section class="boutique-content">
      <div class="boutique-title">Boutique Repar'Tout</div>
      <div class="products-grid">
        <div class="product-card">
          <img src="assets/images/pc_fixe.png" alt="PC Fixe" class="product-img">
          <div class="product-name">PC Fixe Gamer</div>
          <div class="product-desc">PC monté sur mesure, performant pour le gaming et la bureautique.</div>
          <div class="product-price">à partir de 599€</div>
          <a href="commande.php?type=pc-fixe" class="product-btn">Commander</a>
        </div>
        <div class="product-card">
          <img src="assets/images/pc_portable.png" alt="PC Portable" class="product-img">
          <div class="product-name">PC Portable Pro</div>
          <div class="product-desc">Ordinateur portable fiable, idéal pour le travail et les études.</div>
          <div class="product-price">à partir de 499€</div>
          <a href="commande.php?type=pc-portable" class="product-btn">Commander</a>
        </div>
        <div class="product-card">
          <img src="assets/images/console.png" alt="Console" class="product-img">
          <div class="product-name">Console de jeux</div>
          <div class="product-desc">Consoles récentes et rétro, testées et garanties.</div>
          <div class="product-price">à partir de 149€</div>
          <a href="commande.php?type=console" class="product-btn">Commander</a>
        </div>
        <div class="product-card">
          <img src="assets/images/accessoire.png" alt="Accessoires" class="product-img">
          <div class="product-name">Accessoires PC</div>
          <div class="product-desc">Souris, claviers, casques, tapis et autres accessoires de qualité.</div>
          <div class="product-price">dès 19,99€</div>
          <a href="commande.php?type=accessoire" class="product-btn">Commander</a>
        </div>
        <div class="product-card">
          <img src="assets/images/upgrade.png" alt="Upgrade" class="product-img">
          <div class="product-name">Kit Upgrade</div>
          <div class="product-desc">Boostez votre PC avec nos kits RAM, SSD, GPU adaptés.</div>
          <div class="product-price">dès 49,99€</div>
          <a href="commande.php?type=upgrade" class="product-btn">Commander</a>
        </div>
      </div>
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
