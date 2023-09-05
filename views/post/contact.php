<?php
$title = 'Garage Vincent Parrot';
?>

<!-- Formulaire de contact 
A valider avec pattern HTML (voir doc pattern)-->

<div class="contact-form-container">
  <form action="">
    <h3>Contactez-nous</h3>
    <input type="text" id="name" placeholder="Nom" required>
    <input type="text" id="firstname" placeholder="Prénom" required>
    <input type="email" id="email" placeholder="E-mail" required>
    <input type="text" id="phone" placeholder="Téléphone" required>
    <textarea name="" id="message" rows="4" placeholder="Votre demande"></textarea>
    <button type="submit">ENVOYER</button>
  </form>
</div>