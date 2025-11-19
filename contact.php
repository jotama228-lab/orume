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

// Traiter la soumission du formulaire si méthode POST
$messageFlash = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/partials/connect.php';
    
    // Récupérer et valider les données
    $nom = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sujet = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    $errors = [];
    if (empty($nom)) $errors[] = 'Le nom est requis';
    if (empty($email)) $errors[] = 'L\'email est requis';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'L\'email n\'est pas valide';
    if (empty($sujet)) $errors[] = 'Le sujet est requis';
    if (empty($message)) $errors[] = 'Le message est requis';
    elseif (strlen($message) < 10) $errors[] = 'Le message doit contenir au moins 10 caractères';
    
    // Si pas d'erreurs, sauvegarder
    if (empty($errors) && isset($connect) && $connect) {
        $nom = mysqli_real_escape_string($connect, $nom);
        $email = mysqli_real_escape_string($connect, $email);
        $sujet = mysqli_real_escape_string($connect, $sujet);
        $message = mysqli_real_escape_string($connect, $message);
        
        $query = "INSERT INTO messages (nom, email, sujet, message, statut) VALUES ('$nom', '$email', '$sujet', '$message', 'non_lu')";
        
        if (mysqli_query($connect, $query)) {
            $messageFlash = 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.';
            $messageType = 'success';
            // Réinitialiser les champs
            $nom = $email = $sujet = $message = '';
        } else {
            $messageFlash = 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.';
            $messageType = 'error';
        }
    } else {
        $messageFlash = implode('<br>', $errors);
        $messageType = 'error';
    }
}

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
                <?php if (!empty($messageFlash)): ?>
                    <div class="alert <?php echo $messageType === 'success' ? 'alert-success' : 'alert-error'; ?>" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background: <?php echo $messageType === 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $messageType === 'success' ? '#155724' : '#721c24'; ?>;">
                        <?php echo htmlspecialchars($messageFlash, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="contact.php">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Votre Nom</label>
                            <input type="text" id="name" name="name" placeholder="Votre nom complet" value="<?php echo isset($nom) ? htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="example@gmail.com" value="<?php echo isset($email) ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" id="subject" name="subject" placeholder="Sujet de votre message" value="<?php echo isset($sujet) ? htmlspecialchars($sujet, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Votre Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="Votre message" required minlength="10"><?php echo isset($message) ? htmlspecialchars($message, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
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
