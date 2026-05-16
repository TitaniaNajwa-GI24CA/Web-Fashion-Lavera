const cards = document.querySelectorAll('.product-card');
const modal = document.getElementById('productModal');
const closeModal = document.querySelector('.close-modal');

const modalImg = document.getElementById('modalImg');
const modalName = document.getElementById('modalName');
const modalPrice = document.getElementById('modalPrice');
const modalMaterial = document.getElementById('modalMaterial');
const modalModel = document.getElementById('modalModel');
const sliderDots = document.getElementById('sliderDots');

let currentImages = [];
let currentIndex = 0;
let sliderInterval = null;

cards.forEach(card => {
    const detailBtn = card.querySelector('.detail-btn');

    detailBtn.addEventListener('click', () => {
        currentImages = JSON.parse(card.dataset.imgs);
        currentIndex = 0;

        modalImg.src = currentImages[currentIndex];
        modalName.textContent = card.dataset.name;
        modalPrice.textContent = card.dataset.price;
        modalMaterial.textContent = card.dataset.material;
        modalModel.textContent = card.dataset.model;

        createDots();
        updateDots();

        modal.classList.add('active');
        startSlider();
    });
});

function createDots() {
    sliderDots.innerHTML = '';

    currentImages.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('dot');

        dot.addEventListener('click', () => {
            currentIndex = index;
            changeImage();
            startSlider();
        });

        sliderDots.appendChild(dot);
    });
}

function updateDots() {
    const dots = document.querySelectorAll('.dot');

    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

function changeImage() {
    modalImg.classList.add('fade');

    setTimeout(() => {
        modalImg.src = currentImages[currentIndex];
        modalImg.classList.remove('fade');
        updateDots();
    }, 220);
}

function startSlider() {
    clearInterval(sliderInterval);

    sliderInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % currentImages.length;
        changeImage();
    }, 2500);
}

function closeProductModal() {
    modal.classList.remove('active');
    clearInterval(sliderInterval);
}

closeModal.onclick = closeProductModal;

modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        closeProductModal();
    }
});