/* POUR LE SCROLLAGE DU MENU */
/* Robuste : attends que le DOM soit prêt */
document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.querySelector('.navbar');
  if (!navbar) {
    console.warn('Navbar introuvable — selector .navbar');
    return;
  }

  let lastScroll = window.pageYOffset || document.documentElement.scrollTop;
  const threshold = 80; // ne cache qu'après ce nombre de px

  // Optionnel : accélération via requestAnimationFrame pour fluidité
  let ticking = false;

  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        const current = window.pageYOffset || document.documentElement.scrollTop;

        if (current > lastScroll && current > threshold) {
          // on descend -> cacher
          navbar.classList.add('hide');
        } else {
          // on monte -> montrer
          navbar.classList.remove('hide');
        }

        lastScroll = current <= 0 ? 0 : current;
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
});




/* PAGE PORTFOLIO FILTRAGE*/
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('.filter-buttons button');
  const items = document.querySelectorAll('.portfolo-grid .item');
  const modal = document.getElementById('imageModal');
  const modalImg = document.querySelector('.modal-image');
  const closeBtn = document.querySelector('.close');
  const nextBtn = document.querySelector('.next');
  const prevBtn = document.querySelector('.prev');

  let currentImages = [];
  let currentIndex = 0;

  // --- FILTRAGE ---
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');
      items.forEach(item => {
        if (filter === 'all' || item.classList.contains(filter)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  // --- OUVERTURE DE LA MODALE ---
  items.forEach((item, index) => {
    item.addEventListener('click', () => {
      const activeFilter = document.querySelector('.filter-buttons .active').dataset.filter;
      currentImages = Array.from(items)
        .filter(i => activeFilter === 'all' || i.classList.contains(activeFilter))
        .map(i => i.querySelector('img').src);

      currentIndex = currentImages.indexOf(item.querySelector('img').src);
      openModal(currentImages[currentIndex]);
    });
  });

  function openModal(src) {
    modal.style.display = 'block';
    modalImg.src = src;
  }

  // --- FERMER MODALE ---
  closeBtn.addEventListener('click', () => modal.style.display = 'none');
  modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });

  // --- NAVIGATION ---
  nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % currentImages.length;
    modalImg.src = currentImages[currentIndex];
  });

  prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
    modalImg.src = currentImages[currentIndex];
  });

  // --- Navigation clavier (facultatif) ---
  document.addEventListener('keydown', e => {
    if (modal.style.display === 'block') {
      if (e.key === 'ArrowRight') nextBtn.click();
      if (e.key === 'ArrowLeft') prevBtn.click();
      if (e.key === 'Escape') closeBtn.click();
    }
  });
});







// PAGE CONTACT----*//
// Ajoute une légère animation de focus sur les champs
const inputs = document.querySelectorAll('input, textarea');
inputs.forEach(input => {
  input.addEventListener('focus', () => {
    input.style.transition = '0.3s';
    input.style.transform = 'scale(1.02)';
  });
  input.addEventListener('blur', () => {
    input.style.transform = 'scale(1)';
  });
});






/* PAGE ACCEUIL PORTFOLIO ANIMATION */
  const images = document.querySelectorAll('.portfolio .card img');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const closeBtn = document.querySelector('.lightbox .close');
  const prevBtn = document.querySelector('.lightbox .prev');
  const nextBtn = document.querySelector('.lightbox .next');
  
  let currentIndex = 0;

  function showImage(index) {
    currentIndex = index;
    lightboxImg.src = images[index].src;
    lightbox.style.display = 'flex';
  }

  images.forEach((img, index) => {
    img.addEventListener('click', () => showImage(index));
  });

  closeBtn.addEventListener('click', () => lightbox.style.display = 'none');
  nextBtn.addEventListener('click', () => showImage((currentIndex + 1) % images.length));
  prevBtn.addEventListener('click', () => showImage((currentIndex - 1 + images.length) % images.length));

  // Fermer avec la touche Échap
  document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") lightbox.style.display = 'none';
    if (e.key === "ArrowRight") nextBtn.click();
    if (e.key === "ArrowLeft") prevBtn.click();
  });


