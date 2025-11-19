<?php
/**
 * ============================================
 * PAGE DE CONTACT - FRONTEND PUBLIC
 * ============================================
 * 
 * Cette page affiche le formulaire de contact et traite
 * les soumissions pour enregistrer les messages dans la base de données.
 * 
 * @package Orüme
 * @version 1.0.0
 */

// Charger le bootstrap de l'application
require_once __DIR__ . '/bootstrap.php';

use Orüme\Controllers\ContactController;

// Traiter la soumission du formulaire si méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ContactController();
    $controller->submit();
    exit; // Le contrôleur gère la redirection
}

// Afficher la page de contact
$controller = new ContactController();
$controller->index();
exit; // Ne pas exécuter le code HTML ci-dessous si le contrôleur gère l'affichage

// Code HTML (sera utilisé si le contrôleur ne gère pas l'affichage)
?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'partials/head.php'; ?>

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
                <h3>Obtenez votre <span>devis aujourd'hui</span></h3>
                
                <!-- Afficher les messages flash -->
                <?php
                $flashMessages = getFlashMessages();
                foreach ($flashMessages as $flash) {
                    $type = $flash['type'];
                    $message = $flash['message'];
                    $alertClass = $type === 'success' ? 'alert-success' : 'alert-error';
                    echo "<div class='alert {$alertClass}'>{$message}</div>";
                }
                ?>
                
                <form method="POST" action="/contact.php">
                    <!-- Token CSRF pour la sécurité -->
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Votre Nom</label>
                            <input type="text" id="name" name="name" placeholder="Votre nom complet" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" id="subject" name="subject" placeholder="Sujet de votre message" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Votre Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="Votre message" required minlength="10"></textarea>
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
