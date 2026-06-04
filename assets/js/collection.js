const cards = document.querySelectorAll('.product-card');
const modal = document.getElementById('productModal');
const closeModal = document.querySelector('.close-modal');

const modalImg = document.getElementById('modalImg');
const modalName = document.getElementById('modalName');
const modalPrice = document.getElementById('modalPrice');
const modalMaterial = document.getElementById('modalMaterial');
const modalModel = document.getElementById('modalModel');
const sliderDots = document.getElementById('sliderDots');

const modalDiscountInfo = document.getElementById('modalDiscountInfo');
const stockInfo = document.getElementById('sizeStockInfo');
const orderLink = document.getElementById('orderLink');
const cartLink = document.getElementById('cartLink');

let currentImages = [];
let currentIndex = 0;
let sliderInterval = null;
let selectedProductId = null;

cards.forEach(card => {
    const detailBtn = card.querySelector('.detail-btn');

    detailBtn.addEventListener('click', () => {
        const diskon = parseInt(card.dataset.diskon || 0);
        const ukuranStok = JSON.parse(card.dataset.ukuranStok || "[]");

        currentImages = JSON.parse(card.dataset.imgs);
        currentIndex = 0;

        modalImg.src = currentImages[currentIndex];
        modalName.textContent = card.dataset.name;
        modalPrice.textContent = card.dataset.price;
        modalMaterial.textContent = card.dataset.material;
        modalModel.textContent = card.dataset.model;

        if(diskon > 0){
            modalDiscountInfo.innerHTML = `Diskon tersedia sebesar <b>${diskon}%</b>`;
        }else{
            modalDiscountInfo.innerHTML = `Produk ini tidak memiliki diskon.`;
        }

        stockInfo.innerHTML = 'Pilih ukuran untuk melihat stok.';
        selectedProductId = null;

        orderLink.href = '#';
        cartLink.href = '#';

        document.querySelectorAll('.size-btn').forEach(btnUkuran => {
            btnUkuran.classList.remove('active');

            const dataUkuran = ukuranStok.find(item => item.ukuran === btnUkuran.dataset.size);

            if(dataUkuran){
                btnUkuran.style.display = 'inline-flex';

                btnUkuran.onclick = function(){
                    document.querySelectorAll('.size-btn').forEach(x => {
                        x.classList.remove('active');
                    });

                    this.classList.add('active');

                    selectedProductId = dataUkuran.id_pakaian_jadi;

                    stockInfo.innerHTML =
                        'Stok tersedia : ' + dataUkuran.stok + ' pcs';

                    orderLink.href =
                        baseUrl + 'pesanan/form/' + selectedProductId;

                    cartLink.href =
                        baseUrl + 'keranjang/tambah/' + selectedProductId;
                };

            }else{
                btnUkuran.style.display = 'none';
            }
        });

        createDots();
        updateDots();

        modal.classList.add('active');
        startSlider();
    });
});

orderLink.addEventListener('click', function(e){
    if(!selectedProductId){
        e.preventDefault();
        stockInfo.innerHTML = 'Pilih ukuran terlebih dahulu sebelum memesan.';
    }
});

cartLink.addEventListener('click', function(e){
    if(!selectedProductId){
        e.preventDefault();
        stockInfo.innerHTML = 'Pilih ukuran terlebih dahulu sebelum menambahkan ke keranjang.';
    }
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

    if(currentImages.length <= 1){
        return;
    }

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

    if(currentImages.length <= 1){
        return;
    }

    sliderInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % currentImages.length;
        changeImage();
    }, 2500);
}

function closeProductModal() {
    modal.classList.remove('active');
    clearInterval(sliderInterval);
}

if(closeModal){
    closeModal.onclick = closeProductModal;
}

if(modal){
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProductModal();
        }
    });
}