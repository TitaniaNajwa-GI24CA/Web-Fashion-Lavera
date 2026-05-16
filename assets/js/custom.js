const openFabricPrice = document.getElementById('openFabricPrice');
const fabricPriceModal = document.getElementById('fabricPriceModal');
const closeFabricPrice = document.getElementById('closeFabricPrice');

openFabricPrice.addEventListener('click', function(e){
    e.preventDefault();
    fabricPriceModal.classList.add('active');
});

closeFabricPrice.addEventListener('click', function(){
    fabricPriceModal.classList.remove('active');
});

window.addEventListener('click', function(e){
    if(e.target === fabricPriceModal){
        fabricPriceModal.classList.remove('active');
    }
});