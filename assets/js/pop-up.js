document.addEventListener("DOMContentLoaded", function(){

    const modal = document.getElementById('laveraAlertModal');

    if(modal){
        setTimeout(function(){
            modal.remove();
        }, 2200);
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openBtn = document.getElementById("openProfileModal");
    const closeBtn = document.getElementById("closeProfileModal");
    const modal = document.getElementById("profileModal");

    if(openBtn && closeBtn && modal){

        openBtn.addEventListener("click", function(e){
            e.preventDefault();
            modal.classList.add("active");
        });

        closeBtn.addEventListener("click", function(){
            modal.classList.remove("active");
        });

        modal.addEventListener("click", function(e){
            if(e.target === modal){
                modal.classList.remove("active");
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openLogoutModal =
    document.getElementById("openLogoutModal");

    const closeLogoutModal =
    document.getElementById("closeLogoutModal");

    const logoutModal =
    document.getElementById("logoutModal");

    if(openLogoutModal){

        openLogoutModal.addEventListener("click", function(e){

            e.preventDefault();

            logoutModal.classList.add("active");

        });

    }

    if(closeLogoutModal){

        closeLogoutModal.addEventListener("click", function(){

            logoutModal.classList.remove("active");

        });

    }

    if(logoutModal){

        logoutModal.addEventListener("click", function(e){

            if(e.target === logoutModal){

                logoutModal.classList.remove("active");

            }

        });

    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openForgot = document.getElementById("openForgotModal");
    const closeForgot = document.getElementById("closeForgotModal");
    const forgotModal = document.getElementById("forgotModal");

    if(openForgot && closeForgot && forgotModal){

        openForgot.addEventListener("click", function(e){
            e.preventDefault();
            forgotModal.classList.add("active");
        });

        closeForgot.addEventListener("click", function(){
            forgotModal.classList.remove("active");
        });

        forgotModal.addEventListener("click", function(e){
            if(e.target === forgotModal){
                forgotModal.classList.remove("active");
            }
        });
    }

});

setTimeout(function(){
    const modal = document.getElementById('laveraAlertModal');
    if(modal){
        modal.remove();
    }
}, 2200);

const openProdukModal =
    document.getElementById('openProdukModal');

const closeProdukModal =
    document.getElementById('closeProdukModal');

const produkModal =
    document.getElementById('produkModal');

if(openProdukModal){

    openProdukModal.addEventListener('click', function(e){

        e.preventDefault();

        produkModal.classList.add('active');

    });

}

if(closeProdukModal){

    closeProdukModal.addEventListener('click', function(){

        produkModal.classList.remove('active');

    });

}

window.addEventListener('click', function(e){

    if(e.target == produkModal){

        produkModal.classList.remove('active');

    }

});

document.querySelectorAll('.has-submenu').forEach(menu => {
    menu.addEventListener('click', function () {

        const submenu = this.nextElementSibling;

        submenu.classList.toggle('show');

    });
});

const openCustomModal = document.getElementById('openCustomModal');
const closeCustomModal = document.getElementById('closeCustomModal');
const customModal = document.getElementById('customModal');

if(openCustomModal && closeCustomModal && customModal){
    openCustomModal.addEventListener('click', function(e){
        e.preventDefault();
        customModal.classList.add('active');
    });

    closeCustomModal.addEventListener('click', function(){
        customModal.classList.remove('active');
    });

    customModal.addEventListener('click', function(e){
        if(e.target === customModal){
            customModal.classList.remove('active');
        }
    });
}

document.addEventListener("DOMContentLoaded", function(){

    const deleteModal = document.getElementById("deleteModal");
    const closeDeleteModal = document.getElementById("closeDeleteModal");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    document.querySelectorAll(".open-delete-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            confirmDeleteBtn.href = this.dataset.url;
            deleteModal.classList.add("active");
        });
    });

    closeDeleteModal.addEventListener("click", function(){
        deleteModal.classList.remove("active");
    });

    deleteModal.addEventListener("click", function(e){
        if(e.target === deleteModal){
            deleteModal.classList.remove("active");
        }
    });

});

document.addEventListener("DOMContentLoaded", function(){
    const editModal = document.getElementById("editCustomModal");
    const closeEditModal = document.getElementById("closeEditCustomModal");
    document.querySelectorAll(".open-edit-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();
            document.getElementById("edit_id_custom").value =
                this.dataset.id;
            document.getElementById("edit_kategori_custom").value =
                this.dataset.kategori;
            document.getElementById("edit_deskripsi_referensi").value =
                this.dataset.deskripsi;
            document.getElementById("edit_status_custom").value =
                this.dataset.status;
            document.getElementById("old_gambar_referensi").innerText =
                "File lama: " + this.dataset.gambarReferensi;
            document.getElementById("old_gambar_bahan").innerText =
                "File lama: " + this.dataset.gambarBahan;
            editModal.classList.add("active");
        });
    });

    if(closeEditModal){
        closeEditModal.addEventListener("click", function(){
            editModal.classList.remove("active");
        });
    }
    if(editModal){
        editModal.addEventListener("click", function(e){
            if(e.target === editModal){
                editModal.classList.remove("active");
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const editProdukModal = document.getElementById("editProdukModal");
    const closeEditProdukModal = document.getElementById("closeEditProdukModal");

    document.querySelectorAll(".open-edit-produk-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            document.getElementById("edit_id_pakaian_jadi").value = this.dataset.id;
            document.getElementById("edit_nama_pakaian").value = this.dataset.nama;
            document.getElementById("edit_ukuran").value = this.dataset.ukuran;
            document.getElementById("edit_harga").value = this.dataset.harga;
            document.getElementById("edit_stok").value = this.dataset.stok;
            document.getElementById("edit_diskon_produk").value = this.dataset.diskon;
            document.getElementById("edit_status_produk").value = this.dataset.status;
            document.getElementById("edit_detail_model").value = this.dataset.model;
            document.getElementById("edit_detail_bahan").value = this.dataset.bahan;

            document.getElementById("old_foto_1").innerText = "File lama: " + (this.dataset.foto1 || "-");
            document.getElementById("old_foto_2").innerText = "File lama: " + (this.dataset.foto2 || "-");
            document.getElementById("old_foto_3").innerText = "File lama: " + (this.dataset.foto3 || "-");
            document.getElementById("old_foto_4").innerText = "File lama: " + (this.dataset.foto4 || "-");

            editProdukModal.classList.add("active");
        });
    });

    if(closeEditProdukModal){
        closeEditProdukModal.addEventListener("click", function(){
            editProdukModal.classList.remove("active");
        });
    }

    if(editProdukModal){
        editProdukModal.addEventListener("click", function(e){
            if(e.target === editProdukModal){
                editProdukModal.classList.remove("active");
            }
        });
    }

});

document.addEventListener('DOMContentLoaded', function(){

    const searchInput =
        document.getElementById('searchProduk');

    const statusFilter =
        document.getElementById('filterStatus');

    const rows =
        document.querySelectorAll('.produk-row');

    function filterProduk(){

        const keyword =
            searchInput.value.toLowerCase();

        const status =
            statusFilter.value.toLowerCase();

        rows.forEach(row => {

            const text =
                row.textContent.toLowerCase();

            const rowStatus =
                row.dataset.status.toLowerCase();

            const cocokKeyword =
                text.includes(keyword);

            const cocokStatus =
                status === '' ||
                rowStatus === status;

            if(cocokKeyword && cocokStatus){

                row.style.display = '';

            }else{

                row.style.display = 'none';

            }

        });

    }

    searchInput.addEventListener(
        'keyup',
        filterProduk
    );

    statusFilter.addEventListener(
        'change',
        filterProduk
    );

});

document.addEventListener('DOMContentLoaded', function(){

    const searchInput =
        document.getElementById('searchCustom');
    const statusFilter =
        document.getElementById('filterCustomStatus');
    const rows =
        document.querySelectorAll('.produk-row');
    function filterCustom(){
        const keyword =
            searchInput.value.toLowerCase();
        const status =
            statusFilter.value.toLowerCase();
        rows.forEach(row => {
            const text =
                row.textContent.toLowerCase();
            const rowStatus =
                row.dataset.status.toLowerCase();
            const cocokKeyword =
                text.includes(keyword);
            const cocokStatus =
                status === '' ||
                rowStatus === status;
            if(cocokKeyword && cocokStatus){
                row.style.display = '';
            }else{
                row.style.display = 'none';
            }
        });
    }
    searchInput.addEventListener(
        'keyup',
        filterCustom
    );
    statusFilter.addEventListener(
        'change',
        filterCustom
    );
}
);

document.addEventListener("DOMContentLoaded", function(){
    const toggle = document.getElementById("historyToggle");
    const dropdown = document.getElementById("historyDropdown");

    if(toggle && dropdown){
        toggle.addEventListener("click", function(e){
            e.stopPropagation();
            dropdown.classList.toggle("active");
        });

        document.addEventListener("click", function(e){
            if(!dropdown.contains(e.target) && !toggle.contains(e.target)){
                dropdown.classList.remove("active");
            }
        });
    }

    document.querySelectorAll(".history-mini-tab").forEach(function(tab){
        tab.addEventListener("click", function(){
            document.querySelectorAll(".history-mini-tab").forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".history-mini-content").forEach(c => c.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.target).classList.add("active");
        });
    });
});

const closeHistoryDropdown =
    document.getElementById('closeHistoryDropdown');

if(closeHistoryDropdown){
    closeHistoryDropdown.addEventListener('click', function(){
        historyDropdown.classList.remove('active');
    });
}

document.addEventListener("DOMContentLoaded", function(){

    const buttons = document.querySelectorAll(".history-filter-btn");
    const cards = document.querySelectorAll(".history-order-card");

    buttons.forEach(btn => {
        btn.addEventListener("click", function(){

            buttons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            const filter = this.dataset.filter;

            cards.forEach(card => {
                if(filter === "all" || card.dataset.type === filter){
                    card.style.display = "flex";
                }else{
                    card.style.display = "none";
                }
            });

        });
    });

});

document.addEventListener("DOMContentLoaded", function(){

    const buttons = document.querySelectorAll(".history-filter-btn");
    const cards = document.querySelectorAll(".history-order-card");

    const emptyAll = document.getElementById("emptyAll");
    const emptyReady = document.getElementById("emptyReady");
    const emptyCustom = document.getElementById("emptyCustom");

    function hideAllEmpty(){
        emptyAll.classList.remove("show");
        emptyReady.classList.remove("show");
        emptyCustom.classList.remove("show");
    }

    function filterHistory(filter){
        let visibleCount = 0;

        cards.forEach(card => {
            const match = filter === "all" || card.dataset.type === filter;

            if(match){
                card.style.display = "flex";
                visibleCount++;
            }else{
                card.style.display = "none";
            }
        });

        hideAllEmpty();

        if(visibleCount === 0){
            if(filter === "all"){
                emptyAll.classList.add("show");
            }else if(filter === "pakaian_jadi"){
                emptyReady.classList.add("show");
            }else if(filter === "custom"){
                emptyCustom.classList.add("show");
            }
        }
    }

    buttons.forEach(btn => {
        btn.addEventListener("click", function(){
            buttons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            filterHistory(this.dataset.filter);
        });
    });

    filterHistory("all");
});

function filterHistory(filter){

    let visibleCount = 0;

    cards.forEach(card => {

        const type = card.dataset.type;

        if(filter === "all"){

            card.style.display = "flex";
            visibleCount++;

        }else if(type === filter){

            card.style.display = "flex";
            visibleCount++;

        }else{

            card.style.display = "none";

        }

    });

    hideAllEmpty();

    if(visibleCount === 0){

        if(filter === "all"){
            emptyAll.classList.add("show");
        }

        if(filter === "pakaian_jadi"){
            emptyReady.classList.add("show");
        }

        if(filter === "custom"){
            emptyCustom.classList.add("show");
        }
    }
}