// --------------- MODIFIER UN PORTFOLIO ---------------
document.addEventListener("DOMContentLoaded", function () {
  const editModal = document.getElementById("editModal");
  const closeEdit = document.querySelector(".close-edit");
  const editForm = document.getElementById("editForm");

  if (!editModal || !editForm) {
    console.error("❌ Le modal ou le formulaire de modification n'existe pas dans le DOM.");
    return;
  }

  // Cache toujours le modal au départ
  editModal.style.display = "none";

  // Variable pour stocker la carte à modifier
  let currentCard = null;

  // Quand on clique sur "Modifier"
  document.querySelectorAll(".btn-edit").forEach((btn) => {
    btn.addEventListener("click", function () {
      const card = this.closest(".portfolio-card");
      if (!card) return;

      currentCard = card;

      // Récupérer les infos
      const name = card.querySelector("h3").textContent.replace("Client : ", "").trim();
      const date = card.querySelector("p:nth-child(2)").textContent.replace("Date : ", "").trim();
      const email = card.querySelector("p:nth-child(3)").textContent.replace("Email : ", "").trim();

      // Remplir le formulaire
      document.getElementById("editClientName").value = name;
      document.getElementById("editDate").value = formatMonthInput(date);
      document.getElementById("editEmail").value = email;

      // Affiche le modal
      editModal.style.display = "flex";
    });
  });

  // Fermer le modal
  closeEdit.addEventListener("click", () => {
    editModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === editModal) {
      editModal.style.display = "none";
    }
  });

  // Soumission du formulaire
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (!currentCard) return;

    const newName = document.getElementById("editClientName").value;
    const newDate = document.getElementById("editDate").value;
    const newEmail = document.getElementById("editEmail").value;
    const newImage = document.getElementById("editImage").files[0];

    currentCard.querySelector("h3").innerHTML = `Client : ${newName}`;
    currentCard.querySelector("p:nth-child(2)").innerHTML = `<i class="fa-solid fa-calendar"></i> Date : ${formatDateDisplay(newDate)}`;
    currentCard.querySelector("p:nth-child(3)").innerHTML = `<i class="fa-solid fa-envelope"></i> Email : ${newEmail}`;

    if (newImage) {
      const reader = new FileReader();
      reader.onload = function (e) {
        currentCard.querySelector(".portfolio-img").src = e.target.result;
      };
      reader.readAsDataURL(newImage);
    }

    editModal.style.display = "none";
  });

  // Fonctions utilitaires
  function formatMonthInput(text) {
    const mois = {
      "Janvier": "01", "Février": "02", "Mars": "03", "Avril": "04", "Mai": "05", "Juin": "06",
      "Juillet": "07", "Août": "08", "Septembre": "09", "Octobre": "10", "Novembre": "11", "Décembre": "12"
    };
    const [m, y] = text.split(" ");
    return y && mois[m] ? `${y}-${mois[m]}` : "";
  }

  function formatDateDisplay(monthVal) {
    const [y, m] = monthVal.split("-");
    const noms = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
    return `${noms[parseInt(m) - 1]} ${y}`;
  }
});
