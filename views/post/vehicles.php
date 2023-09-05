<?php

use App\Connection;
use App\Model\Vehicle;
use App\Model\Image;

$title = 'Garage Vincent Parrot';

/* Call list of all vehicles ---------------------------------------------------------------------------------------- */
$pdo = Connection::getPDO();
$query = $pdo->query("
  SELECT *
  FROM vehicles
  ORDER BY make");
$vehicles = $query->fetchAll(PDO::FETCH_CLASS, Vehicle::class);

/* Call one image for each vehicle ---------------------------------------------------------------------------------- */
$query = $pdo->query("
  SELECT *
  FROM images
  WHERE image_file_name LIKE '%1.png'
  ");
$firstImagesVehicle = $query->fetchAll(PDO::FETCH_CLASS, Image::class);

for($i = 0; $i < count($firstImagesVehicle); $i++) {
  for($j = 0; $j < count($vehicles); $j++) {
    if($firstImagesVehicle[$i]->getVehicleId() === $vehicles[$j]->getAdNumber()) {
      $vehicleWithImage[$vehicles[$j]->getAdNumber()] = $firstImagesVehicle[$i]->getImageFileName();
    }
  }
}

/* Filtered list of makes ------------------------------------------------------------------------------------------- */
$makes = [];
foreach($vehicles as $vehicle):
  $makes[] = $vehicle->getMake();
endforeach;
$makes = array_unique($makes);
sort($makes);

/* Filtered list of first registrations ----------------------------------------------------------------------------- */
$yearsFirstRegistration = [];
foreach($vehicles as $vehicle):
  $yearsFirstRegistration[] = $vehicle->getFirstRegistration()->format('Y');
endforeach;
$yearsFirstRegistration = array_unique($yearsFirstRegistration);
sort($yearsFirstRegistration);

/* ------------------------------------------------------------------------------------------------------------------ */
$titleVehicle = titleVehicle($vehicle->getMake(), $vehicle->getModel(), $vehicle->getEngineCapacity(), $vehicle->getPower());
?>

<!-- List of vehicles -->
<div class="vehicle-section">
  <h2>Nos Véhicules premium</h2>
  <div class="filter-section">

    <div class="select-filter brand">
      <div class="wrapper">
        <h4>Marque</h4>
        <div class="select-menu">
          <div class="select-btn">
            <span class="sBtn-text">Sélectionnez une marque</span>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <ul class="options">
            <?php foreach($makes as $make): ?>
              <li class="option">
                <span class="option-text">
                  <?= $make ?>
                </span>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="car-filter mileage">
      <div class="wrapper">
        <h4>Kilométrage</h4>
        <div class="gauge-input">
          <div class="field">
            <span>Min</span>
            <input type="number" class="input-min" value="10000">
          </div>
          <div class="separator"> - </div>
          <div class="field">
            <span>Max</span>
            <input type="number" class="input-max" value="99000">
          </div>
        </div>
        <div class="slider">
          <div class="progress"></div>
        </div>
        <div class="range-input">
          <input type="range" class="range-min" min="0" max="99000" value="10000" step="100">
          <input type="range" class="range-max" min="0" max="99000" value="99000" step="100">
        </div>
      </div>
    </div>

    <div class="car-filter price">
      <div class="wrapper">
        <h4>Prix</h4>
        <div class="gauge-input price-gauge">
          <div class="field">
            <span>Min</span>
            <input type="number" class="price-input-min" value="15000">
          </div>
            <div class="separator"> - </div>
          <div class="field">
            <span>Max</span>
            <input type="number" class="price-input-max" value="50000">
          </div>
        </div>
        <div class="slider slider-price">
          <div class="progress progress"></div>
        </div>
        <div class="range-input price-input">
          <input type="range" class="price-range-min" min="0" max="50000" value="15000" step="100">
          <input type="range" class="price-range-max" min="0" max="50000" value="50000" step="100">
        </div>
      </div>
    </div>
    
    <div class="select-filter year">
      <div class="wrapper">
        <h4>Mise en circulation</h4>
        <div class="select-menu">
          <div class="select-btn">
            <span class="sBtn-text">Sélectionnez une année</span>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <ul class="options">
            <?php foreach($yearsFirstRegistration as $year): ?>
              <li class="option">
                <span class="option-text">
                  <?= $year ?>
                </span>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="button-filter-container">
    <button class="reinitialize">RÉINITIALISER</button>
  </div>

  <div class="cards-section">
    <!-- Vehicle cards -->
    <div class="container">
      <?php foreach($vehicles as $vehicle): ?>
        <div class="card">
          <div class="img-container">
            <img src="/images/vehicles/<?= $vehicleWithImage[$vehicle->getAdNumber()] ?>"
              alt="<?= $vehicleWithImage[$vehicle->getAdNumber()] ?>"
              class="cover-img">
          </div>
          <div class="title">
            <div class="target">
              <h4>
                <?= $titleVehicle ?>
              </h4>
            </div>
            <div class="tooltip">
              <h4>
                <?= $titleVehicle ?>
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
</div>