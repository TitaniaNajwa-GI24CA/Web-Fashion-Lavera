document.addEventListener("DOMContentLoaded", function(){

    const modalAlert = document.getElementById('laveraAlertModal');

    if(modalAlert){
        setTimeout(function(){
            modalAlert.remove();
        }, 2200);
    }

    /* PROFILE MODAL */
    const openBtn = document.getElementById("openProfileModal");
    const closeBtn = document.getElementById("closeProfileModal");
    const profileModal = document.getElementById("profileModal");

    if(openBtn && closeBtn && profileModal){
        openBtn.addEventListener("click", function(e){
            e.preventDefault();
            profileModal.classList.add("active");
        });

        closeBtn.addEventListener("click", function(){
            profileModal.classList.remove("active");
        });

        profileModal.addEventListener("click", function(e){
            if(e.target === profileModal){
                profileModal.classList.remove("active");
            }
        });
    }

    /* LOGOUT MODAL */
    const openLogoutModal = document.getElementById("openLogoutModal");
    const closeLogoutModal = document.getElementById("closeLogoutModal");
    const logoutModal = document.getElementById("logoutModal");

    if(openLogoutModal && logoutModal){
        openLogoutModal.addEventListener("click", function(e){
            e.preventDefault();
            logoutModal.classList.add("active");
        });
    }

    if(closeLogoutModal && logoutModal){
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

    /* FORGOT PASSWORD MODAL */
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

    /* TAMBAH PRODUK MODAL */
    const openProdukModal = document.getElementById('openProdukModal');
    const closeProdukModal = document.getElementById('closeProdukModal');
    const produkModal = document.getElementById('produkModal');

    if(openProdukModal && produkModal){
        openProdukModal.addEventListener('click', function(e){
            e.preventDefault();
            produkModal.classList.add('active');
        });
    }

    if(closeProdukModal && produkModal){
        closeProdukModal.addEventListener('click', function(){
            produkModal.classList.remove('active');
        });
    }

    if(produkModal){
        window.addEventListener('click', function(e){
            if(e.target === produkModal){
                produkModal.classList.remove('active');
            }
        });
    }

    /* SIDEBAR SUBMENU */
    document.querySelectorAll('.has-submenu').forEach(menu => {
        menu.addEventListener('click', function(){
            const submenu = this.nextElementSibling;

            if(submenu){
                submenu.classList.toggle('show');
            }
        });
    });

    /* CUSTOM MODAL */
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

    /* DELETE MODAL */
    const deleteModal = document.getElementById("deleteModal");
    const closeDeleteModal = document.getElementById("closeDeleteModal");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    document.querySelectorAll(".open-delete-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            if(confirmDeleteBtn && deleteModal){
                confirmDeleteBtn.href = this.dataset.url;
                deleteModal.classList.add("active");
            }
        });
    });

    if(closeDeleteModal && deleteModal){
        closeDeleteModal.addEventListener("click", function(){
            deleteModal.classList.remove("active");
        });
    }

    if(deleteModal){
        deleteModal.addEventListener("click", function(e){
            if(e.target === deleteModal){
                deleteModal.classList.remove("active");
            }
        });
    }

    /* EDIT CUSTOM MODAL */
    const editModal = document.getElementById("editCustomModal");
    const closeEditModal = document.getElementById("closeEditCustomModal");

    document.querySelectorAll(".open-edit-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            const idCustom = document.getElementById("edit_id_custom");
            const kategori = document.getElementById("edit_kategori_custom");
            const deskripsi = document.getElementById("edit_deskripsi_referensi");
            const status = document.getElementById("edit_status_custom");
            const oldRef = document.getElementById("old_gambar_referensi");
            const oldBahan = document.getElementById("old_gambar_bahan");

            if(idCustom) idCustom.value = this.dataset.id;
            if(kategori) kategori.value = this.dataset.kategori;
            if(deskripsi) deskripsi.value = this.dataset.deskripsi;
            if(status) status.value = this.dataset.status;
            if(oldRef) oldRef.innerText = "File lama: " + this.dataset.gambarReferensi;
            if(oldBahan) oldBahan.innerText = "File lama: " + this.dataset.gambarBahan;

            if(editModal){
                editModal.classList.add("active");
            }
        });
    });

    if(closeEditModal && editModal){
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

    /* EDIT PRODUK MODAL */
    const editProdukModal = document.getElementById("editProdukModal");
    const closeEditProdukModal = document.getElementById("closeEditProdukModal");

    document.querySelectorAll(".open-edit-produk-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            const fields = {
                edit_id_pakaian_jadi: this.dataset.id,
                edit_nama_pakaian: this.dataset.nama,
                edit_ukuran: this.dataset.ukuran,
                edit_harga: this.dataset.harga,
                edit_stok: this.dataset.stok,
                edit_diskon_produk: this.dataset.diskon,
                edit_status_produk: this.dataset.status,
                edit_detail_model: this.dataset.model,
                edit_detail_bahan: this.dataset.bahan
            };

            Object.keys(fields).forEach(id => {
                const el = document.getElementById(id);
                if(el) el.value = fields[id];
            });

            const oldFoto1 = document.getElementById("old_foto_1");
            const oldFoto2 = document.getElementById("old_foto_2");
            const oldFoto3 = document.getElementById("old_foto_3");
            const oldFoto4 = document.getElementById("old_foto_4");

            if(oldFoto1) oldFoto1.innerText = "File lama: " + (this.dataset.foto1 || "-");
            if(oldFoto2) oldFoto2.innerText = "File lama: " + (this.dataset.foto2 || "-");
            if(oldFoto3) oldFoto3.innerText = "File lama: " + (this.dataset.foto3 || "-");
            if(oldFoto4) oldFoto4.innerText = "File lama: " + (this.dataset.foto4 || "-");

            if(editProdukModal){
                editProdukModal.classList.add("active");
            }
        });
    });

    if(closeEditProdukModal && editProdukModal){
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

    /* FILTER PRODUK */
    const searchInput = document.getElementById('searchProduk');
    const statusFilter = document.getElementById('filterStatus');
    const produkRows = document.querySelectorAll('.produk-row');

    function filterProduk(){
        const keyword = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        produkRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatus = row.dataset.status.toLowerCase();

            const cocokKeyword = text.includes(keyword);
            const cocokStatus = status === '' || rowStatus === status;

            row.style.display = cocokKeyword && cocokStatus ? '' : 'none';
        });
    }

    if(searchInput && statusFilter){
        searchInput.addEventListener('keyup', filterProduk);
        statusFilter.addEventListener('change', filterProduk);
    }

    /* FILTER CUSTOM */
    const searchCustom = document.getElementById('searchCustom');
    const filterCustomStatus = document.getElementById('filterCustomStatus');
    const customRows = document.querySelectorAll('.produk-row');

    function filterCustom(){
        const keyword = searchCustom.value.toLowerCase();
        const status = filterCustomStatus.value.toLowerCase();

        customRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatus = row.dataset.status.toLowerCase();

            const cocokKeyword = text.includes(keyword);
            const cocokStatus = status === '' || rowStatus === status;

            row.style.display = cocokKeyword && cocokStatus ? '' : 'none';
        });
    }

    if(searchCustom && filterCustomStatus){
        searchCustom.addEventListener('keyup', filterCustom);
        filterCustomStatus.addEventListener('change', filterCustom);
    }

    /* HISTORY DROPDOWN */
    const toggle = document.getElementById("historyToggle");
    const dropdown = document.getElementById("historyDropdown");
    const closeHistoryDropdown = document.getElementById('closeHistoryDropdown');

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

    if(closeHistoryDropdown && dropdown){
        closeHistoryDropdown.addEventListener('click', function(){
            dropdown.classList.remove('active');
        });
    }

    document.querySelectorAll(".history-mini-tab").forEach(function(tab){
        tab.addEventListener("click", function(){
            document.querySelectorAll(".history-mini-tab").forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".history-mini-content").forEach(c => c.classList.remove("active"));

            this.classList.add("active");

            const target = document.getElementById(this.dataset.target);
            if(target){
                target.classList.add("active");
            }
        });
    });

    /* RIWAYAT FILTER */
    const historyButtons = document.querySelectorAll(".history-filter-btn");
    const historyCards = document.querySelectorAll(".history-order-card");

    const emptyAll = document.getElementById("emptyAll");
    const emptyReady = document.getElementById("emptyReady");
    const emptyCustom = document.getElementById("emptyCustom");

    function hideAllEmpty(){
        if(emptyAll) emptyAll.classList.remove("show");
        if(emptyReady) emptyReady.classList.remove("show");
        if(emptyCustom) emptyCustom.classList.remove("show");
    }

    function filterHistory(filter){
        let visibleCount = 0;

        historyCards.forEach(card => {
            const type = card.dataset.type;
            const match = filter === "all" || type === filter;

            if(match){
                card.style.display = "flex";
                visibleCount++;
            }else{
                card.style.display = "none";
            }
        });

        hideAllEmpty();

        if(visibleCount === 0){
            if(filter === "all" && emptyAll){
                emptyAll.classList.add("show");
            }

            if(filter === "pakaian_jadi" && emptyReady){
                emptyReady.classList.add("show");
            }

            if(filter === "custom" && emptyCustom){
                emptyCustom.classList.add("show");
            }
        }
    }

    if(historyButtons.length > 0){
        historyButtons.forEach(btn => {
            btn.addEventListener("click", function(){
                historyButtons.forEach(b => b.classList.remove("active"));
                this.classList.add("active");

                filterHistory(this.dataset.filter);
            });
        });

        filterHistory("all");
    }

    /* MODAL STATUS PESANAN */
    const statusPesananModal = document.getElementById("statusPesananModal");
    const closeStatusPesananModal = document.getElementById("closeStatusPesananModal");

    document.querySelectorAll(".open-status-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            const editId = document.getElementById("edit_id_pesanan");
            const editKode = document.getElementById("edit_kode_pesanan");
            const editStatus = document.getElementById("edit_status_pesanan");

            if(editId) editId.value = this.dataset.id;
            if(editKode) editKode.value = this.dataset.kode;
            if(editStatus) editStatus.value = this.dataset.status;

            if(statusPesananModal){
                statusPesananModal.classList.add("active");
            }
        });
    });

    if(closeStatusPesananModal && statusPesananModal){
        closeStatusPesananModal.addEventListener("click", function(){
            statusPesananModal.classList.remove("active");
        });
    }

    if(statusPesananModal){
        statusPesananModal.addEventListener("click", function(e){
            if(e.target === statusPesananModal){
                statusPesananModal.classList.remove("active");
            }
        });
    }

    /* FILTER PESANAN ADMIN */
    const searchPesanan = document.getElementById('searchPesanan');
    const filterStatusPesanan = document.getElementById('filterStatusPesanan');
    const filterBulan = document.getElementById('filterBulan');

    function filterPesanan(){
        const keyword = searchPesanan ? searchPesanan.value.toLowerCase() : '';
        const status = filterStatusPesanan ? filterStatusPesanan.value.toLowerCase() : '';
        const bulan = filterBulan ? filterBulan.value : '';

        document.querySelectorAll('.pesanan-row').forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status;
            const rowBulan = row.dataset.bulan;

            const cocokKeyword = text.includes(keyword);
            const cocokStatus = status === '' || rowStatus === status;
            const cocokBulan = bulan === '' || rowBulan === bulan;

            row.style.display =
                cocokKeyword && cocokStatus && cocokBulan
                    ? ''
                    : 'none';
        });
    }

    if(searchPesanan){
        searchPesanan.addEventListener('keyup', filterPesanan);
    }

    if(filterStatusPesanan){
        filterStatusPesanan.addEventListener('change', filterPesanan);
    }

    if(filterBulan){
        filterBulan.addEventListener('change', filterPesanan);
    }

});

$(document).ready(function(){

    $('.lavera-datatable').each(function(){

        const table = $(this);

        if($.fn.DataTable.isDataTable(this)){
            table.DataTable().destroy();
        }
        const totalData = table.find('tbody tr').length;
        table.DataTable({
            pageLength: 5,
            lengthChange: false,
            ordering: false,
            searching: false,
            info: true,

            drawCallback: function(){
                const current = table.find('tbody tr:visible').length;

                table
                    .closest('.dataTables_wrapper')
                    .find('.dataTables_info')
                    .html(
                        'Menampilkan ' +
                        current +
                        ' data dari ' +
                        totalData +
                        ' data'
                    );
            },

            language: {
                infoEmpty: 'Tidak ada data',
                zeroRecords: 'Data tidak ditemukan',
                paginate: {
                    previous: '‹',
                    next: '›'
                }
            }
        });

    });
});

document.addEventListener("DOMContentLoaded", function(){

    const cashModal = document.getElementById("cashPaymentModal");
    const openCash = document.getElementById("openCashPaymentModal");
    const closeCash = document.getElementById("closeCashPaymentModal");

    if(openCash && cashModal){
        openCash.addEventListener("click", function(e){
            e.preventDefault();
            cashModal.classList.add("active");
        });
    }

    if(closeCash && cashModal){
        closeCash.addEventListener("click", function(){
            cashModal.classList.remove("active");
        });
    }

    const statusModal = document.getElementById("paymentStatusModal");
    const closeStatus = document.getElementById("closePaymentStatusModal");

    document.querySelectorAll(".open-payment-status-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            document.getElementById("edit_id_pembayaran").value = this.dataset.id;
            document.getElementById("edit_kode_pembayaran").value = this.dataset.kode;
            document.getElementById("edit_status_pembayaran").value = this.dataset.status;

            statusModal.classList.add("active");
        });
    });

    if(closeStatus && statusModal){
        closeStatus.addEventListener("click", function(){
            statusModal.classList.remove("active");
        });
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const editRequestModal = document.getElementById("editRequestModal");
    const closeEditRequestModal = document.getElementById("closeEditRequestModal");

    document.querySelectorAll(".open-edit-request-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            const totalRequest = parseInt(this.dataset.totalrequest || 0);

            document.getElementById("edit_id_request").value = this.dataset.id;
            document.getElementById("edit_kode_request").value = this.dataset.kode;
            document.getElementById("edit_customer_request").value = this.dataset.customer;
            document.getElementById("edit_kategori_request").value = this.dataset.kategori;
            document.getElementById("edit_estimasi_harga").value = this.dataset.estimasi;
                let estimasi = parseInt(this.dataset.estimasi || 0);
            document.getElementById("edit_uang_muka").value =
                Math.round(estimasi * 0.5);
            document.getElementById("edit_status_request").value = this.dataset.status;
            const diskonInput = document.getElementById("edit_diskon_custom");
            const discountInfo = document.getElementById("discountInfoText");

            if(totalRequest >= 5){
                diskonInput.value = this.dataset.diskon > 0 ? this.dataset.diskon : 5;
                discountInfo.innerText = "Customer sudah melakukan request custom " + totalRequest + " kali. Diskon dapat diberikan.";
            }else{
                diskonInput.value = this.dataset.diskon || 0;
                discountInfo.innerText = "Riwayat request customer: " + totalRequest + " kali. Diskon default 0%.";
            }

            editRequestModal.classList.add("active");
        });
    });

    if(closeEditRequestModal && editRequestModal){
        closeEditRequestModal.addEventListener("click", function(){
            editRequestModal.classList.remove("active");
        });
    }

    if(editRequestModal){
        editRequestModal.addEventListener("click", function(e){
            if(e.target === editRequestModal){
                editRequestModal.classList.remove("active");
            }
        });
    }

});

const estimasiInput =
    document.getElementById("edit_estimasi_harga");

const uangMukaInput =
    document.getElementById("edit_uang_muka");

if(estimasiInput && uangMukaInput){

    estimasiInput.addEventListener("input", function(){

        let estimasi = parseInt(this.value) || 0;

        uangMukaInput.value =
            Math.round(estimasi * 0.5);

    });

}

document.addEventListener("DOMContentLoaded", function(){

    const customModal = document.getElementById("statusPesananCustomModal");
    const closeCustomModal = document.getElementById("closeStatusPesananCustomModal");

    document.querySelectorAll(".open-status-custom-modal").forEach(function(btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();

            document.getElementById("edit_id_pesanan_custom").value = this.dataset.id;
            document.getElementById("edit_kode_pesanan_custom").value = this.dataset.kode;
            document.getElementById("edit_status_pesanan_custom").value = this.dataset.status;

            customModal.classList.add("active");
        });
    });

    if(closeCustomModal && customModal){
        closeCustomModal.addEventListener("click", function(){
            customModal.classList.remove("active");
        });
    }

    if(customModal){
        customModal.addEventListener("click", function(e){
            if(e.target === customModal){
                customModal.classList.remove("active");
            }
        });
    }

});