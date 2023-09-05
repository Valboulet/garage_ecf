<?php

use App\Connection;
use App\Model\Equipment;
use App\Model\Image;
use App\Model\Vehicle;

$title = 'Garage Vincent Parrot';

$adNumberVehicle = (int)$params['ad_number'];
$makeVehicle = $params['make'];

/* Call a vehicle based on its ad_number ---------------------------------------------------------------------------- */
$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM vehicles WHERE ad_number = :ad_number');
$query->execute(['ad_number' => $adNumberVehicle]);
$query->setFetchMode(PDO::FETCH_CLASS, Vehicle::class);
$vehicle = $query->fetch();

/* Check url -------------------------------------------------------------------------------------------------------- */
if ($vehicle === false) {
  throw new Exception("Aucun véhicule ne correspond à ce numéro d'annonce");
}
if (mb_strtolower($vehicle->getMake()) !== $makeVehicle) {
    $url = $router->url('vehicle', [
      'make' => mb_strtolower($vehicle->getMake()),
      'ad_number' => $vehicle->getAdNumber()]);
    http_response_code(301);
    header('Location: ' . $url);
}

/* Call all images of a vehicle based on its ad_number -------------------------------------------------------------- */
$query = $pdo->prepare('
  SELECT id, image_file_name
  FROM images
  WHERE images.vehicle_id = :ad_number
  ');
$query->execute(['ad_number' => $vehicle->getAdNumber()]);
$query->setFetchMode(PDO::FETCH_CLASS, Image::class);
$imagesVehicle = $query->fetchAll();

/* Call id and specification from list of all equipments according to the ad_number --------------------------------- */
$query = $pdo->prepare('
  SELECT eq.specification
  FROM options op
  JOIN equipments eq ON op.equipment_id = eq.id
  WHERE op.vehicle_id = :ad_number
  ');
$query->execute(['ad_number' => $vehicle->getAdNumber()]);
$query->setFetchMode(PDO::FETCH_CLASS, Equipment::class);
$equipments = $query->fetchAll();

/* ------------------------------------------------------------------------------------------------------------------ */
$titleVehicle = titleVehicle($vehicle->getMake(), $vehicle->getModel(), $vehicle->getEngineCapacity(), $vehicle->getPower());
?>

<div class="vehicle-sheet-section">
  <h2 class="vehicle-title"><?= $titleVehicle ?></h2>
  <div class="vehicle-sheet">

    <!-- Vehicle photos -->
    <div class="top-right">
      <div class="main-image-container">
        <img src="/images/vehicles/<?= $imagesVehicle[0]->getImageFileName() ?>"
          alt="<?= $titleVehicle ?>-<?= $imagesVehicle[0]->getId() ?>"
          class="main-image">
      </div>
      <div class="grid-other-images">
        <?php for($i = 1; $i < count($imagesVehicle); $i++) { ?>
          <img src="/images/vehicles/<?= $imagesVehicle[$i]->getImageFileName() ?>"
            alt="<?= $titleVehicle ?>-<?= $imagesVehicle[$i]->getId() ?>"
            class="other-image">
          <?php } ?>
      </div>
    </div>

    <!-- Vehicle features and price card / equipments left side-->
    <div class="top-left vehicle-features">
      <div class="card-sheet">
        <span class="price"><?= $vehicle->getPrice() ?>€</span>
        <div class="details">
          <?= cardElements('Marque', $vehicle->getMake()); ?>
          <?= cardElements('Kilométrage', $vehicle->getMileage() . ' km'); ?>
          <?= cardElements('Modèle', $vehicle->getModel()); ?>
          <?= cardElements('Carburant', $vehicle->getFuelType()); ?>
          <?= cardElements('Carrosserie', $vehicle->getBodyType()); ?>
          <?= cardElements('Puissance', $vehicle->getPower() . ' cv'); ?>
          <?= cardElements('Mise en circulation', $vehicle->getFirstRegistration()->format('d / m / Y')); ?>
          <?= cardElements('Garantie', $vehicle->getWarranty() . ' mois'); ?>
          <?= cardElements('Référence annonce', $vehicle->getAdNumber()); ?>
        </div>
      </div>
      <div class="equipments-container">
        <h3>Équipements</h3>
        <div class="equipment-list">
          <ul>
            <?php foreach($equipments as $equipment): ?>
              <li class="equipment">
                <?= $equipment->getSpecification() ?>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
        <div class="equipment-list-infos">
          <ul>
            <li class="infos">
              Visite sans rendez-vous
            </li>
            <li class="infos">
              Reprise de votre ancien véhicule
            </li>
            <li class="infos">
              Garantie européenne de 12 mois (extensible 24 mois)
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom contact form -->
  <div class="contact-form-container">
    <form action="">
      <h3>Ce véhicule vous intéresse ? Contactez-nous</h3>
      <input type="text" id="name" placeholder="Nom" required>
      <input type="text" id="firstname" placeholder="Prénom" required>
      <input type="email" id="email" placeholder="E-mail" required>
      <input type="text" id="phone" placeholder="Téléphone" required>
      <textarea name="" id="message" rows="4" placeholder="Votre demande"></textarea>
      <button type="submit">ENVOYER</button>
    </form>
  </div>
</div>