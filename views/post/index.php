<?php

use App\Connection;
use App\Model\Service;
use App\Model\Vehicle;
use App\Model\Image;

$title = 'Garage Vincent Parrot';

/* Call list of all services registered in DB ----------------------------------------------------------------------- */
$pdo = Connection::getPDO();
$query = $pdo->query('SELECT id, image_file_name, service_type FROM services');
$services = $query->fetchAll(PDO::FETCH_CLASS, Service::class);

/* Call list of all vehicles ---------------------------------------------------------------------------------------- */
$pdo = Connection::getPDO();
$query = $pdo->query("
  SELECT *
  FROM vehicles
  ORDER BY make");
$vehicles = $query->fetchAll(PDO::FETCH_CLASS, Vehicle::class);

/* Random list of 3 vehicles ---------------------------------------------------------------------------------------- */
$index = array_rand($vehicles, 3);
for($h = 0; $h < count($index); $h++) {
  $randVehicles[] = $vehicles[$index[$h]];
}

/* Call one image for each vehicle ---------------------------------------------------------------------------------- */
$query = $pdo->query("
  SELECT *
  FROM images
  WHERE image_file_name LIKE '%1.png'
  ");
$firstImagesVehicle = $query->fetchAll(PDO::FETCH_CLASS, Image::class);

/* List of image file names with ad number in index ----------------------------------------------------------------- */
for($i = 0; $i < count($firstImagesVehicle); $i++) {
  for($j = 0; $j < count($vehicles); $j++) {
    if($firstImagesVehicle[$i]->getVehicleId() === $vehicles[$j]->getAdNumber()) {
      $vehicleWithImage[$vehicles[$j]->getAdNumber()] = $firstImagesVehicle[$i]->getImageFileName();
    }
  }
}

?>

<header>
<!-- Hero -->
  <div class="hero-section">
    <div class="hero-container">
      <div class="content">
        <h1>Véhicules et services 100% premium</h1>
        <p>Depuis 2010, la garage Vincent Parrot vous offre une vaste sélection de véhicules d'occasion premium certifiés.</p>
        <div class="buttons-container">
          <button class="button1">
            <a href="<?= $router->url('vehicles') ?>">Voir nos Offres</a>
          </button>
          <button class="button2">
            <a href="<?= $router->url('contact') ?>">Contacter l'Atelier</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Services -->

<div class="services-section">
  <h2>Nos Services</h2>
  <div class="services-container">
    <?php foreach($services as $service): ?>
      <div class="service">
        <h4>
          <?= $service->getServiceType() ?>
        </h4>
        <div class="img-container">
          <img src="/images/services/<?= $service->getImageFileName() ?>" alt="<?= $service->getServiceType() ?>">
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<!-- Véhicules -->

<div class="vehicle-section">
  <h2>Nos Dernières Offres</h2>
  <div class="cards-section">
    <!-- Vehicle cards -->
    <div class="container">
      <?php foreach($randVehicles as $vehicle): ?>
        <div class="card">
          <div class="img-container">
            <img src="/images/vehicles/<?= $vehicleWithImage[$vehicle->getAdNumber()] ?>"
              alt="<?= $vehicleWithImage[$vehicle->getAdNumber()] ?>"
              class="cover-img">
          </div>
          <div class="title">
            <div class="target">
              <h4>
                <?= titleVehicle($vehicle->getMake(), $vehicle->getModel(), $vehicle->getEngineCapacity(), $vehicle->getPower()) ?>
              </h4>
            </div>
            <div class="tooltip">
              <h4>
                <?= titleVehicle($vehicle->getMake(), $vehicle->getModel(), $vehicle->getEngineCapacity(), $vehicle->getPower()) ?>
              </h4>
            </div>
          </div>
          <span class="price"><?= $vehicle->getPrice() ?>€</span>
          <div class="details">
            <?= cardElements('Marque', $vehicle->getMake()); ?>
            <?= cardElements('Kilométrage', $vehicle->getMileage() . ' km'); ?>
            <?= cardElements('Modèle', $vehicle->getModel()); ?>
            <?= cardElements('Carburant', $vehicle->getFuelType()); ?>
            <?= cardElements('Puissance', $vehicle->getPower() . ' cv'); ?>
            <?= cardElements('Mise en circulation', $vehicle->getFirstRegistration()->format('d / m / Y')); ?>
          </div>
          <button class="button">
            <a href="<?= $router->url('vehicle', [
                'make' => mb_strtolower($vehicle->getMake()),
                'ad_number' => $vehicle->getAdNumber()]) ?>">
              VOIR PLUS
            </a>
          </button>
        </div>
      <?php endforeach ?>
    </div>    
  </div>
  <div class="button-cards-section-container">
    <button class="button1">
      <a href="<?= $router->url('vehicles') ?>">Voir Tous les Véhicules</a>
    </button>
  </div>
</div>

<!-- Testimonials Section -->

<div class="testimonials">
  <div class="inner">
    <h2>Témoignages</h2>
    <div class="border"></div>

    <div class="row">
      <div class="col">
        <div class="testimonial">
          <div class="name">John Smith</div>
          <div class="stars">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Necessitatibus blanditiis placeat eius, et labore voluptate?
          </p>
        </div>
      </div>
      <div class="col">
        <div class="testimonial">
          <div class="name">Marie Dupont</div>
          <div class="stars">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Necessitatibus blanditiis placeat eius, et labore voluptate?
          </p>
        </div>
      </div>
      <div class="col">
        <div class="testimonial">
          <div class="name">Jean Neige</div>
          <div class="stars">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Necessitatibus blanditiis placeat eius, et labore voluptate?
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Rate and leave a comment Section -->

<div class="rating-section">
  <div class="rating-container">
    <h4>Votre opinion compte !</h4>
    <div class="stars">
      <input type="checkbox" name="rate" id="rate-5" class="rate-5">
      <label for="rate-5" class="fa-solid fa-star"></label>
      <input type="checkbox" name="rate" id="rate-4" class="rate-4">
      <label for="rate-4" class="fa-solid fa-star"></label>
      <input type="checkbox" name="rate" id="rate-3" class="rate-3">
      <label for="rate-3" class="fa-solid fa-star"></label>
      <input type="checkbox" name="rate" id="rate-2" class="rate-2">
      <label for="rate-2" class="fa-solid fa-star"></label>
      <input type="checkbox" name="rate" id="rate-1" class="rate-1">
      <label for="rate-1"class="fa-solid fa-star"></label>
    </div>
    <textarea name="opinion" id="" cols="30" rows="7" placeholder="Décrivez votre expérience..."></textarea>
    <input type="text" class="email" placeholder="Votre e-mail">
    <div class="buttons-container">
      <button type="submit" class="btn submit">Envoyer</button>
      <button type="submit" class="btn cancel">Annuler</button>
      </div>
  </div>
</div>