<!DOCTYPE html>
<html lang="fr">
 <?php
      include'partials/head.php'
  ?>

    <!-- HERO CONTENT avec seulement une image -->
    <div class="hero-content">
      <img src="assets/img/image-contact.png" alt="Orüme Hero" class="hero-img">
    </div>
  </header>

<section class="contact-section">
  <div class="container">
    <div class="contact-grid">
      <!-- Formulaire -->
      <div class="contact-form">
        <h3>Obtenez votre <span>devis aujourd’hui</span></h3>
        <form>
          <div class="form-row">
            <div class="form-group">
              <label for="name">Votre Nom</label>
              <input type="text" id="name" placeholder="ex: nom@gmail.com">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" placeholder="example@gmail.com">
            </div>
          </div>

          <div class="form-group">
            <label for="subject">Sujet</label>
            <input type="text" id="subject" placeholder="Mail">
          </div>

          <div class="form-group">
            <label for="message">Votre Message</label>
            <textarea id="message" rows="4" placeholder="Votre message"></textarea>
          </div>

          <button type="submit" style="color: #2c5a34;" class="btn-send">Envoyez</button>
        </form>
      </div>

      <!-- Bloc coordonnées -->
      <div class="contact-info">
        <h4>Adresse</h4>
        <p>303 Av. HCD, Horizon Nouveau,<br> Lomé - Adidogomé</p>

        <h4>Contact</h4>
        <p>Téléphone : +228 91 21 60 63<br>E-mail : orumeagency@gmail.com</p>

        <h4>Horaires</h4>
        <p>Lundi au Vendredi : 9h00 - 18h00<br>Samedi : 9h00 - 12h30</p>

        <h4>Suivez-nous</h4>
        <div class="socials">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section qualités -->
<section class="qualities-section">
  <div class="qualities-container">
    <div class="quality">
      <i class="fas fa-calendar-check"></i>
      <p>Nous délivrons dans de brefs délais</p>
    </div>
    <div class="quality">
      <i class="fas fa-users"></i>
      <p>Équipe d’experts et professionnels</p>
    </div>
    <div class="quality">
      <i class="fas fa-comments"></i>
      <p>Nous répondons à vos besoins</p>
    </div>
  </div>
</section>



<?php
      include'partials/footer.php'
  ?>


</body>
</html>
