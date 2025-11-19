/*  AJOUTER UN SITE PORTFOLIO */



document.addEventListener("DOMContentLoaded", function() {

  const addBtn = document.getElementById("addPortfolioBtn");
  if (!addBtn) {
    console.error("❌ Bouton 'addPortfolioBtn' introuvable dans le DOM.");
    return;
  }

  addBtn.addEventListener("click", () => {
    const clientName = document.getElementById("clientName").value;
    const date = document.getElementById("dateRealisation").value;
    const prix = document.getElementById("prix") ? document.getElementById("prix").value : "N/A";
    const contact = document.getElementById("contact").value;
    const imageInput = document.getElementById("image");

    if (!clientName || !date || !contact || !imageInput.files.length) {
      alert("⚠️ Veuillez remplir tous les champs avant d'ajouter un portfolio.");
      return;
    }

    const imageUrl = URL.createObjectURL(imageInput.files[0]);

    const card = document.createElement("div");
    card.className = "portfolio-card";
    card.innerHTML = `
      <img src="${imageUrl}" alt="Portfolio de ${clientName}" class="portfolio-img">
      <div class="portfolio-info">
        <h3>Client : ${clientName}</h3>
        <p><i class="fa-solid fa-calendar"></i> Date : ${date}</p>
        ${prix !== "N/A" ? `<p><i class="fa-solid fa-dollar-sign"></i> Prix : ${prix} FCFA</p>` : ""}
        <p><i class="fa-solid fa-envelope"></i> Contact : ${contact}</p>
      </div>
    `;

    document.querySelector(".portfolio-grid").appendChild(card);
    document.getElementById("portfolioForm").reset();

    /*
    // Exemple d’envoi vers une base de données
    fetch('ajout_portfolio.php', {
      method: 'POST',
      body: new FormData(document.getElementById('portfolioForm'))
    })
    .then(res => res.text())
    .then(data => console.log('✅ Portfolio ajouté :', data))
    .catch(err => console.error('Erreur :', err));
    */
  });

});
