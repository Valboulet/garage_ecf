<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style.css" type="text/css">
    <script src="https://kit.fontawesome.com/bfd52b74c7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@300&display=swap"rel="stylesheet">
    <title><?= $title ?></title>
</head>
<body>
  <!-- Menu -->
  <nav class="navigation">
    <div class="navbar">
      <div class="logo-container">
        <img src="/images/newlogo-vparrot-white.png" class="logo" alt="logo">
      </div>
      <div class="nav-links">
        <ul>
          <li><a href="<?= $router->url('home') ?>">Accueil</a></li>
          <li><a href="<?= $router->url('vehicles') ?>">Véhicules</a></li>
          <li><a href="<?= $router->url('contact') ?>">Contact</a></li>
        </ul>
      </div>
      <span class="mobile-menu-icon" id="mobile-menu-icon" alt="menu-mobile"><i class="fa-solid fa-bars"></i></span>
    </div>
  </nav>

  <main>
    <?= $content ?>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-container-top">
      <div class="footer-col">
        <div class="footer-logo-container">
          <img src="/images/newlogo-vparrot-dark.png" class="logo" alt="">
        </div>
      </div>
      <div class="footer-col">
        <h4>Horaires d'ouverture</h4>
        <div class="timetables">
          <div class="day monday">
            <span class="weekday">Lundi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day tuesday">
            <span class="weekday">Mardi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day wednesday">
            <span class="weekday">Mercredi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day thursday">
            <span class="weekday">Jeudi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day friday">
            <span class="weekday">Vendredi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day saturday">
            <span class="weekday">Samedi</span>
            <span class="hours">07:00 - 12:00  -  14:00 - 19:00</span>
          </div>
          <div class="day sunday">
            <span class="weekday">Dimanche et jours fériés</span>
            <span class="hours">FERMÉ</span>
          </div>
        </div>
      </div>
    </div>
    <div class="middleline"></div>
    <div class="footer-container-bottom">
      <div class="footer-col">
        <h4>Liens utiles</h4>
        <ul>
          <li><a href="<?= $router->url('vehicles') ?>">Véhicules</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Atelier</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>À propos</h4>
        <ul>
          <li><a href="<?= $router->url('contact') ?>">Contact</a></li>
          <li><a href="#">Mentions Légales</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Follow us</h4>
        <div class="links">
          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <ul>
          <li><a href="#" class="copyright">© Vincent Parrot 2023</a></li>
          <li><a href="#" class="copyright">Tous droits réservés</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <script src="/assets/script.js"></script>
</body>
</html>